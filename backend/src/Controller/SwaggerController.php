<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

/**
 *  @OA\Info(
 *     version="1.0",
 *     title="Tes Api"
 * )
 * @OA\Server(
 *     url="http://localhost:8090",
 * )
 */
class SwaggerController extends AbstractController {
	/**
	* @Route("/doc-api")
	* Class ApiController
	 * @package App\Controller
	 * @return Response
	*/
	public function index(): Response {
		return $this->render("swagger-ui/index.html.twig");
	}
}
