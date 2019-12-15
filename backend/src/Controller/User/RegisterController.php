<?php
declare(strict_types=1);

namespace App\Controller\User;

use App\Security\User\UserSecurity;
use App\Service\User\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;


/**
 * @OA\Post(
 *     path="/register/",
 *     summary="Register user",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string",
 *                 ),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     )
 * )
 * @Route("/register", defaults={"_format": "json"})
 * Class RegisterController
 * @package App\Controller\User
 */
class RegisterController extends AbstractController
{
	/**
	 * @Route("/", methods={"POST"})
	 *
	 * @param Request $request
	 * @param UserService $service
	 * @param UserSecurity $security
	 * @return Response
	 */
    public function register(Request $request, UserService $service, UserSecurity $security): Response
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $user = $service->create($email, $password);
        $token = $security->getToken($user);

        return $this->json([
            'token' => $token
        ]);
    }
}
