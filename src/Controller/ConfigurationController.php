<?php

namespace App\Controller;

use App\Entity\Configuration;
use App\Repository\ConfigurationRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/configuration', name: 'app_api_configuration_')]
final class ConfigurationController extends AbstractController
{

public function __construct(private EntityManagerInterface $manager, private ConfigurationRepository $repository)
{
}

    #[Route(name: 'new', methods: 'POST')]
    public function new(): Response
    {
        $configuration = new Configuration();
        // Tell Doctrine you want to (eventually) save the configuration (no queries yet)
        $this->manager->persist($configuration);
        // Actually executes the queries (i.e. the INSERT query)
        $this->manager->flush();
        return $this->json(
            ['message' => "Configuration resource created with {$configuration->getId()} id"],
            Response::HTTP_CREATED,
        );
    } 

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): Response
    {
        $configuration = $this->repository->findOneBy(['id' => $id]);
        if (!$configuration) {
            throw $this->createNotFoundException("No Configuration found for {$id} id");
        }
        return $this->json(
            ['message' => "A Configuration was found : {$configuration->getNom()} for {$configuration->getId()} id"]
        );
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id): Response
    {
        $configuration = $this->repository->findOneBy(['id' => $id]);
        if (!$configuration) {
            throw $this->createNotFoundException("No Configuration found for {$id} id");
        }
        $this->manager->flush();
        return $this->redirectToRoute('app_api_configuration_show', ['id' => $configuration->getId()]);
    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $configuration = $this->repository->findOneBy(['id' => $id]);
        if (!$configuration) {
            throw $this->createNotFoundException("No Configuration found for {$id} id");
        }
        $this->manager->remove($configuration);
        $this->manager->flush();
        return $this->json(['message' => "Configuration resource deleted"], Response::HTTP_NO_CONTENT);
    }
}