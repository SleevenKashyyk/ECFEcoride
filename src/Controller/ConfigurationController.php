<?php

namespace App\Controller;

use App\Entity\Configuration;
use App\Repository\ConfigurationRepository;
use DateTimeImmutable ;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/configuration', name: 'app_api_configuration_')]
class ConfigurationController extends AbstractController
{
    public function __construct(
    private EntityManagerInterface $manager,
    private ConfigurationRepository $repository,
    private SerializerInterface $serializer,
    private UrlGeneratorInterface $urlGenerator,
){
}

    #[Route(methods: 'POST')]
    public function new(Request $request): JsonResponse
    {
        $configuration = $this->serializer->deserialize($request->getContent(), Configuration::class, 'json');
        $configuration->setCreatedAt(new DateTimeImmutable());

        $this->manager->persist($configuration);
        $this->manager->flush();

        $responseData = $this->serializer->serialize($configuration, 'json');
        $location = $this->urlGenerator->generate(
            'app_api_configuration_show',
            ['id' => $configuration->getId()],
            UrlGeneratorInterface::ABSOLUTE_URL,
        );

        return new JsonResponse($responseData, Response::HTTP_CREATED, ["Location" => $location], true);

}

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): JsonResponse
    {
        $configuration = $this->repository->findOneBy(['id' => $id]);
        if (!$configuration) {
            $responseData = $this->serializer->serialize($configuration, 'json');

            return new JsonResponse($responseData, Response::HTTP_OK, [], true);
        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id,Request $request): JsonResponse
    {
        $configuration = $this->repository->findOneBy(['id' => $id]);
        if (!$configuration) {
            $configuration = $this->serializer->deserialize(
                $request->getContent(),
                Configuration::class,
                'json',
                [AbstractNormalizer::OBJECT_TO_POPULATE => $configuration]
            );
        }
        $this->manager->flush();
        
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);

    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $configuration = $this->repository->findOneBy(['id' => $id]);
        if ($configuration) {
            $this->manager->remove($configuration);
            $this->manager->flush();

            return new JsonResponse(null, Response::HTTP_NO_CONTENT);

        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}