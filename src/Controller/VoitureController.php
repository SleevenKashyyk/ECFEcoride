<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use DateTimeImmutable ;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/voiture', name: 'app_api_voiture_')]
class VoitureController extends AbstractController
{
    public function __construct(
    private EntityManagerInterface $manager,
    private VoitureRepository $repository,
    private SerializerInterface $serializer,
    private UrlGeneratorInterface $urlGenerator,
){
}

    #[Route(methods: 'POST')]
    public function new(Request $request): JsonResponse
    {
        $voiture = $this->serializer->deserialize($request->getContent(), Voiture::class, 'json');
        $voiture->setCreatedAt(new DateTimeImmutable());

        $this->manager->persist($voiture);
        $this->manager->flush();

        $responseData = $this->serializer->serialize($voiture, 'json');
        $location = $this->urlGenerator->generate(
            'app_api_voiture_show',
            ['id' => $voiture->getId()],
            UrlGeneratorInterface::ABSOLUTE_URL,
        );

        return new JsonResponse($responseData, Response::HTTP_CREATED, ["Location" => $location], true);

}

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): JsonResponse
    {
        $voiture = $this->repository->findOneBy(['id' => $id]);
        if (!$voiture) {
            $responseData = $this->serializer->serialize($voiture, 'json');

            return new JsonResponse($responseData, Response::HTTP_OK, [], true);
        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id,Request $request): JsonResponse
    {
        $voiture = $this->repository->findOneBy(['id' => $id]);
        if (!$voiture) {
            $voiture = $this->serializer->deserialize(
                $request->getContent(),
                Voiture::class,
                'json',
                [AbstractNormalizer::OBJECT_TO_POPULATE => $voiture]
            );
        }
        $this->manager->flush();
        
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);

    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $voiture = $this->repository->findOneBy(['id' => $id]);
        if ($voiture) {
            $this->manager->remove($voiture);
            $this->manager->flush();

            return new JsonResponse(null, Response::HTTP_NO_CONTENT);

        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}