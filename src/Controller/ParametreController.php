<?php

namespace App\Controller;

use App\Entity\Parametre;
use App\Repository\ParametreRepository;
use DateTimeImmutable ;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/parametre', name: 'app_api_parametre_')]
class ParametreController extends AbstractController
{
    public function __construct(
    private EntityManagerInterface $manager,
    private ParametreRepository $repository,
    private SerializerInterface $serializer,
    private UrlGeneratorInterface $urlGenerator,
){
}

    #[Route(methods: 'POST')]
    public function new(Request $request): JsonResponse
    {
        $parametre = $this->serializer->deserialize($request->getContent(), Parametre::class, 'json');
        $parametre->setCreatedAt(new DateTimeImmutable());

        $this->manager->persist($parametre);
        $this->manager->flush();

        $responseData = $this->serializer->serialize($parametre, 'json');
        $location = $this->urlGenerator->generate(
            'app_api_parametre_show',
            ['id' => $parametre->getId()],
            UrlGeneratorInterface::ABSOLUTE_URL,
        );

        return new JsonResponse($responseData, Response::HTTP_CREATED, ["Location" => $location], true);

}

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): JsonResponse
    {
        $parametre = $this->repository->findOneBy(['id' => $id]);
        if (!$parametre) {
            $responseData = $this->serializer->serialize($parametre, 'json');

            return new JsonResponse($responseData, Response::HTTP_OK, [], true);
        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id,Request $request): JsonResponse
    {
        $parametre = $this->repository->findOneBy(['id' => $id]);
        if (!$parametre) {
            $parametre = $this->serializer->deserialize(
                $request->getContent(),
                Parametre::class,
                'json',
                [AbstractNormalizer::OBJECT_TO_POPULATE => $parametre]
            );
        }
        $this->manager->flush();
        
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);

    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $parametre = $this->repository->findOneBy(['id' => $id]);
        if ($parametre) {
            $this->manager->remove($parametre);
            $this->manager->flush();

            return new JsonResponse(null, Response::HTTP_NO_CONTENT);

        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}