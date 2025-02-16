<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Repository\AvisRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/avis', name: 'app_api_avis_')]
final class AvisController extends AbstractController
{

public function __construct(private EntityManagerInterface $manager, private AvisRepository $repository)
{
}

    #[Route(name: 'new', methods: 'POST')]
    public function new(): Response
    {
        $avis = new Avis();
        // Tell Doctrine you want to (eventually) save the avis (no queries yet)
        $this->manager->persist($avis);
        // Actually executes the queries (i.e. the INSERT query)
        $this->manager->flush();
        return $this->json(
            ['message' => "Avis resource created with {$avis->getId()} id"],
            Response::HTTP_CREATED,
        );
    } 

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): Response
    {
        $avis = $this->repository->findOneBy(['id' => $id]);
        if (!$avis) {
            throw $this->createNotFoundException("No Avis found for {$id} id");
        }
        return $this->json(
            ['message' => "A Avis was found : {$avis->getNom()} for {$avis->getId()} id"]
        );
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id): Response
    {
        $avis = $this->repository->findOneBy(['id' => $id]);
        if (!$avis) {
            throw $this->createNotFoundException("No Avis found for {$id} id");
        }
        $this->manager->flush();
        return $this->redirectToRoute('app_api_avis_show', ['id' => $avis->getId()]);
    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $avis = $this->repository->findOneBy(['id' => $id]);
        if (!$avis) {
            throw $this->createNotFoundException("No Avis found for {$id} id");
        }
        $this->manager->remove($avis);
        $this->manager->flush();
        return $this->json(['message' => "Avis resource deleted"], Response::HTTP_NO_CONTENT);
    }
}