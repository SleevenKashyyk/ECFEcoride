<?php

namespace App\Controller;

use App\Entity\Role;
use App\Repository\RoleRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/role', name: 'app_api_role_')]
final class RoleController extends AbstractController
{

public function __construct(private EntityManagerInterface $manager, private RoleRepository $repository)
{
}

    #[Route(name: 'new', methods: 'POST')]
    public function new(): Response
    {
        $role = new Role();
        // Tell Doctrine you want to (eventually) save the role (no queries yet)
        $this->manager->persist($role);
        // Actually executes the queries (i.e. the INSERT query)
        $this->manager->flush();
        return $this->json(
            ['message' => "Role resource created with {$role->getId()} id"],
            Response::HTTP_CREATED,
        );
    } 

    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): Response
    {
        $role = $this->repository->findOneBy(['id' => $id]);
        if (!$role) {
            throw $this->createNotFoundException("No Role found for {$id} id");
        }
        return $this->json(
            ['message' => "A Role was found : {$role->getNom()} for {$role->getId()} id"]
        );
    } 

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id): Response
    {
        $role = $this->repository->findOneBy(['id' => $id]);
        if (!$role) {
            throw $this->createNotFoundException("No Role found for {$id} id");
        }
        $this->manager->flush();
        return $this->redirectToRoute('app_api_role_show', ['id' => $role->getId()]);
    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $role = $this->repository->findOneBy(['id' => $id]);
        if (!$role) {
            throw $this->createNotFoundException("No Role found for {$id} id");
        }
        $this->manager->remove($role);
        $this->manager->flush();
        return $this->json(['message' => "Role resource deleted"], Response::HTTP_NO_CONTENT);
    }
}