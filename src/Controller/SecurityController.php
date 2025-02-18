<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\Schema;


#[Route('/api', name: 'app_api_')]
class SecurityController extends AbstractController
{
    public function __construct(private EntityManagerInterface $manager, private SerializerInterface $serializer)
    {
    }

    #[Route('/registration', name: 'registration', methods: 'POST')]

    /**  #[OA\Post(
    *        summary: "Inscription d'un nouvel utilisateur",
    *        requestBody: new OA\RequestBody(
    *            required: true,
    *            description: "Données de l'utilisateur à inscrire",
    *            content: new OA\JsonContent(
    *                type: "object",
    *                properties: [
    *                    new OA\Property(property: "email", type: "string", example: "adresse@email.com"),
    *                    new OA\Property(property: "password", type: "string", example: "Mot de passe")
    *                ]
    *            )
    *        ),
    *        responses: [
    *            new OA\Response(
    *                response: 201,
    *                description: "Utilisateur inscrit avec succès",
    *                content: new OA\JsonContent(
    *                    type: "object",
    *                    properties: [
    *                        new OA\Property(property: "user", type: "string", example: "Nom d'utilisateur"),
    *                        new OA\Property(property: "apiToken", type: "string", example: "31a023e212f116124a36af14ea0c1c3806eb9378"),
    *                        new OA\Property(property: "roles", type: "array", items: new OA\Items(type: "string", example: "ROLE_USER"))
    *                    ]
    *                )
    *            ),
    *            new OA\Response(
    *                response: 400,
    *                description: "Requête invalide (données incorrectes)"
    *            ),
    *            new OA\Response(
    *                response: 409,
    *                description: "Email déjà utilisé"
    *            )
    *        ]
    *    )]
    *    public function register(Request $request): JsonResponse
    *    {
    *        return new JsonResponse([
    *            'user' => 'Nom d\'utilisateur',
    *            'apiToken' => '31a023e212f116124a36af14ea0c1c3806eb9378',
    *            'roles' => ['ROLE_USER']
    *        ], 201);
    *    }
    *}
    */

        public function register(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $user = $this->serializer->deserialize($request->getContent(), User::class, 'json');
        $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
        $user->setCreatedAt(new \DateTimeImmutable());

        $this->manager->persist($user);
        $this->manager->flush();
        return new JsonResponse(
            ['user'  => $user->getUserIdentifier(), 'apiToken' => $user->getApiToken(), 'roles' => $user->getRoles()],
            Response::HTTP_CREATED
        );
    }

#[Route('/login', name: 'login', methods: 'POST')]
public function login(#[CurrentUser()] ?User $user): JsonResponse
{
        if (null === $user) {
            return new JsonResponse(['message' => 'missing credentials',], Response::HTTP_UNAUTHORIZED);
        }

    return new JsonResponse([
        'user'  => $user->getUserIdentifier(),
        'apiToken' => $user->getApiToken(),
        'roles' => $user->getRoles(),
    ]);
}
}