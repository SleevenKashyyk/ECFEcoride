<?php

namespace App\Controller;

use App\Entity\Covoiturage;
use App\Repository\CovoiturageRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/covoiturage', name: 'app_api_covoiturage_')]
final class CovoiturageController extends AbstractController
{

public function __construct(private EntityManagerInterface $manager, private CovoiturageRepository $repository)
{
}

    #[Route(name: 'new', methods: 'POST')]
    public function new(): Response
    {
        $covoiturage = new Covoiturage();
        // Tell Doctrine you want to (eventually) save the covoiturage (no queries yet)
        $this->manager->persist($covoiturage);
        // Actually executes the queries (i.e. the INSERT query)
        $this->manager->flush();
        return $this->json(
            ['message' => "Covoiturage resource created with {$covoiturage->getId()} id"],
            Response::HTTP_CREATED,
        );
    } 

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): Response
    {
        $covoiturage = $this->repository->findOneBy(['id' => $id]);
        if (!$covoiturage) {
            throw $this->createNotFoundException("No Covoiturage found for {$id} id");
        }
        return $this->json(
            ['message' => "A Covoiturage was found : {$covoiturage->getNom()} for {$covoiturage->getId()} id"]
        );
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id): Response
    {
        $covoiturage = $this->repository->findOneBy(['id' => $id]);
        if (!$covoiturage) {
            throw $this->createNotFoundException("No Covoiturage found for {$id} id");
        }
        $this->manager->flush();
        return $this->redirectToRoute('app_api_covoiturage_show', ['id' => $covoiturage->getId()]);
    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $covoiturage = $this->repository->findOneBy(['id' => $id]);
        if (!$covoiturage) {
            throw $this->createNotFoundException("No Covoiturage found for {$id} id");
        }
        $this->manager->remove($covoiturage);
        $this->manager->flush();
        return $this->json(['message' => "Covoiturage resource deleted"], Response::HTTP_NO_CONTENT);
    }
}