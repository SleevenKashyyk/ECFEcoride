<?php

namespace App\Controller;

use App\Entity\Covoiturage;
use App\Repository\CovoiturageRepository;
use DateTimeImmutable ;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/covoiturage', name: 'app_api_covoiturage_')]
class CovoiturageController extends AbstractController
{
    public function __construct(
    private EntityManagerInterface $manager,
    private CovoiturageRepository $repository,
    private SerializerInterface $serializer,
    private UrlGeneratorInterface $urlGenerator,
){
}

    #[Route(methods: 'POST')]
    public function new(Request $request): JsonResponse
    {
        $covoiturage = $this->serializer->deserialize($request->getContent(), Covoiturage::class, 'json');
        $covoiturage->setCreatedAt(new DateTimeImmutable());

        $this->manager->persist($covoiturage);
        $this->manager->flush();

        $responseData = $this->serializer->serialize($covoiturage, 'json');
        $location = $this->urlGenerator->generate(
            'app_api_covoiturage_show',
            ['id' => $covoiturage->getId()],
            UrlGeneratorInterface::ABSOLUTE_URL,
        );

        return new JsonResponse($responseData, Response::HTTP_CREATED, ["Location" => $location], true);

}

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): JsonResponse
    {
        $covoiturage = $this->repository->findOneBy(['id' => $id]);
        if (!$covoiturage) {
            $responseData = $this->serializer->serialize($covoiturage, 'json');

            return new JsonResponse($responseData, Response::HTTP_OK, [], true);
        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id,Request $request): JsonResponse
    {
        $covoiturage = $this->repository->findOneBy(['id' => $id]);
        if (!$covoiturage) {
            $covoiturage = $this->serializer->deserialize(
                $request->getContent(),
                Covoiturage::class,
                'json',
                [AbstractNormalizer::OBJECT_TO_POPULATE => $covoiturage]
            );
        }
        $this->manager->flush();
        
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);

    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $covoiturage = $this->repository->findOneBy(['id' => $id]);
        if ($covoiturage) {
            $this->manager->remove($covoiturage);
            $this->manager->flush();

            return new JsonResponse(null, Response::HTTP_NO_CONTENT);

        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}