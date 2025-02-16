<?php

namespace App\Controller;

use App\Entity\Parametre;
use App\Repository\ParametreRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/parametre', name: 'app_api_parametre_')]
final class ParametreController extends AbstractController
{

public function __construct(private EntityManagerInterface $manager, private ParametreRepository $repository)
{
}

    #[Route(name: 'new', methods: 'POST')]
    public function new(): Response
    {
        $parametre = new Parametre();
        // Tell Doctrine you want to (eventually) save the parametre (no queries yet)
        $this->manager->persist($parametre);
        // Actually executes the queries (i.e. the INSERT query)
        $this->manager->flush();
        return $this->json(
            ['message' => "Parametre resource created with {$parametre->getId()} id"],
            Response::HTTP_CREATED,
        );
    } 

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): Response
    {
        $parametre = $this->repository->findOneBy(['id' => $id]);
        if (!$parametre) {
            throw $this->createNotFoundException("No Parametre found for {$id} id");
        }
        return $this->json(
            ['message' => "A Parametre was found : {$parametre->getNom()} for {$parametre->getId()} id"]
        );
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id): Response
    {
        $parametre = $this->repository->findOneBy(['id' => $id]);
        if (!$parametre) {
            throw $this->createNotFoundException("No Parametre found for {$id} id");
        }
        $this->manager->flush();
        return $this->redirectToRoute('app_api_parametre_show', ['id' => $parametre->getId()]);
    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $parametre = $this->repository->findOneBy(['id' => $id]);
        if (!$parametre) {
            throw $this->createNotFoundException("No Parametre found for {$id} id");
        }
        $this->manager->remove($parametre);
        $this->manager->flush();
        return $this->json(['message' => "Parametre resource deleted"], Response::HTTP_NO_CONTENT);
    }
}