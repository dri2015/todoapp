<?php
declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\User;
use App\Security\User\UserSecurity;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/login/",
 *     summary="Login user",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string"
 *                 ),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     )
 * )
 *
 * @Route("/login", defaults={"_format": "json"})
 * Class LoginController
 * @package App\Controller\User
 */
class LoginController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     *
     * @param Request $request
     * @param UserSecurity $userSecurity
     * @return Response
     * @throws Exception
     */
    public function login(Request $request, UserSecurity $userSecurity): Response
    {
        $email = $request->get("email");
        $password = $request->get("password");

        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy([
            "email" => $email
        ]);
        if (!($user instanceof User)) {
            throw new Exception('User not found', 204);
        }

        if (!$userSecurity->isPasswordValid($user, $password)) {
            throw new Exception('Bad credentials', 209);
        }

		$token = $userSecurity->getToken($user);

		return $this->json([
            'token' => $token
        ]);
    }
}
