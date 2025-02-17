<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Repository\MarqueRepository;
use DateTimeImmutable ;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/marque', name: 'app_api_marque_')]
class MarqueController extends AbstractController
{
    public function __construct(
    private EntityManagerInterface $manager,
    private MarqueRepository $repository,
    private SerializerInterface $serializer,
    private UrlGeneratorInterface $urlGenerator,
){
}

    #[Route(methods: 'POST')]
    public function new(Request $request): JsonResponse
    {
        $marque = $this->serializer->deserialize($request->getContent(), Marque::class, 'json');
        $marque->setCreatedAt(new DateTimeImmutable());

        $this->manager->persist($marque);
        $this->manager->flush();

        $responseData = $this->serializer->serialize($marque, 'json');
        $location = $this->urlGenerator->generate(
            'app_api_marque_show',
            ['id' => $marque->getId()],
            UrlGeneratorInterface::ABSOLUTE_URL,
        );

        return new JsonResponse($responseData, Response::HTTP_CREATED, ["Location" => $location], true);

}

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): JsonResponse
    {
        $marque = $this->repository->findOneBy(['id' => $id]);
        if (!$marque) {
            $responseData = $this->serializer->serialize($marque, 'json');

            return new JsonResponse($responseData, Response::HTTP_OK, [], true);
        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id,Request $request): JsonResponse
    {
        $marque = $this->repository->findOneBy(['id' => $id]);
        if (!$marque) {
            $marque = $this->serializer->deserialize(
                $request->getContent(),
                Marque::class,
                'json',
                [AbstractNormalizer::OBJECT_TO_POPULATE => $marque]
            );
        }
        $this->manager->flush();
        
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);

    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $marque = $this->repository->findOneBy(['id' => $id]);
        if ($marque) {
            $this->manager->remove($marque);
            $this->manager->flush();

            return new JsonResponse(null, Response::HTTP_NO_CONTENT);

        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}