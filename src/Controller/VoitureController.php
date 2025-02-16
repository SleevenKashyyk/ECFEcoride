<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/voiture', name: 'app_api_voiture_')]
final class VoitureController extends AbstractController
{

public function __construct(private EntityManagerInterface $manager, private VoitureRepository $repository)
{
}

    #[Route(name: 'new', methods: 'POST')]
    public function new(): Response
    {
        $voiture = new Voiture();
        // Tell Doctrine you want to (eventually) save the voiture (no queries yet)
        $this->manager->persist($voiture);
        // Actually executes the queries (i.e. the INSERT query)
        $this->manager->flush();
        return $this->json(
            ['message' => "Voiture resource created with {$voiture->getId()} id"],
            Response::HTTP_CREATED,
        );
    } 

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): Response
    {
        $voiture = $this->repository->findOneBy(['id' => $id]);
        if (!$voiture) {
            throw $this->createNotFoundException("No Voiture found for {$id} id");
        }
        return $this->json(
            ['message' => "A Voiture was found : {$voiture->getNom()} for {$voiture->getId()} id"]
        );
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id): Response
    {
        $voiture = $this->repository->findOneBy(['id' => $id]);
        if (!$voiture) {
            throw $this->createNotFoundException("No Voiture found for {$id} id");
        }
        $this->manager->flush();
        return $this->redirectToRoute('app_api_voiture_show', ['id' => $voiture->getId()]);
    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $voiture = $this->repository->findOneBy(['id' => $id]);
        if (!$voiture) {
            throw $this->createNotFoundException("No Voiture found for {$id} id");
        }
        $this->manager->remove($voiture);
        $this->manager->flush();
        return $this->json(['message' => "Voiture resource deleted"], Response::HTTP_NO_CONTENT);
    }
}