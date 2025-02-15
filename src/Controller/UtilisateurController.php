<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/utilisateur', name: 'app_api_utilisateur_')]
final class UtilisateurController extends AbstractController
{

public function __construct(private EntityManagerInterface $manager, private UtilisateurRepository $repository)
{
}

    #[Route(methods: 'POST')]
    public function new(): Response
    {
        $utilisateur = new Utilisateur();
        $utilisateur->setName('Quai Antique');
        $utilisateur->setDescription('Cette qualité et ce goût par le chef Arnaud MICHANT.');
        $utilisateur->setCreatedAt(new DateTimeImmutable());
        // Tell Doctrine you want to (eventually) save the utilisateur (no queries yet)
        $this->manager->persist($utilisateur);
        // Actually executes the queries (i.e. the INSERT query)
        $this->manager->flush();
        return $this->json(
            ['message' => "Utilisateur resource created with {$utilisateur->getId()} id"],
            Response::HTTP_CREATED,
        );
    } 

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): Response
    {
        $Utilisateur = $this->repository->findOneBy(['id' => $id]);
        if (!$utilisateur) {
            throw $this->createNotFoundException("No Utilisateur found for {$id} id");
        }
        return $this->json(
            ['message' => "A Utilisateur was found : {$utilisateur->getName()} for {$utilisateur->getId()} id"]
        );
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id): Response
    {
        $utilisateur = $this->repository->findOneBy(['id' => $id]);
        if (!$utilisateur) {
            throw $this->createNotFoundException("No Utilisateur found for {$id} id");
        }
        $utilisateur->setName('Utilisateur name updated');
        $this->manager->flush();
        return $this->redirectToRoute('app_api_utilisateur_show', ['id' => $utilisateur->getId()]);
    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $utilisateur = $this->repository->findOneBy(['id' => $id]);
        if (!$utilisateur) {
            throw $this->createNotFoundException("No Utilisateur found for {$id} id");
        }
        $this->manager->remove($utilisateur);
        $this->manager->flush();
        return $this->json(['message' => "Utilisateur resource deleted"], Response::HTTP_NO_CONTENT);
    }
}