<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Repository\MarqueRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/marque', name: 'app_api_marque_')]
final class MarqueController extends AbstractController
{

public function __construct(private EntityManagerInterface $manager, private MarqueRepository $repository)
{
}

    #[Route(name: 'new', methods: 'POST')]
    public function new(): Response
    {
        $marque = new Marque();
        // Tell Doctrine you want to (eventually) save the marque (no queries yet)
        $this->manager->persist($marque);
        // Actually executes the queries (i.e. the INSERT query)
        $this->manager->flush();
        return $this->json(
            ['message' => "Marque resource created with {$marque->getId()} id"],
            Response::HTTP_CREATED,
        );
    } 

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): Response
    {
        $marque = $this->repository->findOneBy(['id' => $id]);
        if (!$marque) {
            throw $this->createNotFoundException("No Marque found for {$id} id");
        }
        return $this->json(
            ['message' => "A Marque was found : {$marque->getNom()} for {$marque->getId()} id"]
        );
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id): Response
    {
        $marque = $this->repository->findOneBy(['id' => $id]);
        if (!$marque) {
            throw $this->createNotFoundException("No Marque found for {$id} id");
        }
        $this->manager->flush();
        return $this->redirectToRoute('app_api_marque_show', ['id' => $marque->getId()]);
    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $marque = $this->repository->findOneBy(['id' => $id]);
        if (!$marque) {
            throw $this->createNotFoundException("No Marque found for {$id} id");
        }
        $this->manager->remove($marque);
        $this->manager->flush();
        return $this->json(['message' => "Marque resource deleted"], Response::HTTP_NO_CONTENT);
    }
}