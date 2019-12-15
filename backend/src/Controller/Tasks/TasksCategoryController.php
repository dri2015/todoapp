<?php
declare(strict_types=1);

namespace App\Controller\Tasks;

use App\Entity\TaskCategory;
use App\Service\Tasks\TasksCategoryService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

/**
 * @Route("/category", defaults={"_format": "json"})
 * Class TasksCategoryController
 * @package App\Controller\Tasks
 */
class TasksCategoryController extends AbstractController
{
	/**
	 * @Route("/getid/{id}", methods={"GET"})
	 *
	 * @param Request $request
	 * @param TasksCategoryService $service
	 * @return Response
	 * @throws Exception
	 */
	public function getCategory(Request $request, TasksCategoryService $service): Response
	{
		$categoryId = $request->query->get('id');
		if (!$categoryId) {
			throw new Exception('Bad Request', 400);
		}

		$category = $service->getTaskCategory($categoryId);

		return $this->json($category);
	}

	/**
	 * @Route("/create", methods={"PUT"})
	 *
	 * @param Request $request
	 * @param TasksCategoryService $service
	 * @return Response
	 * @throws Exception
	 */
	public function create(Request $request, TasksCategoryService $service): Response
	{
		$name = $request->get("name");
		if (!$name) {
			throw new Exception("Bad Request", 400);
		}
		return $this->json([
			"out" => $service->create($name)
		]);
	}

	/**
	 * @Route("/delete", methods={"DELETE"})
	 *
	 * @param Request $request
	 * @param TasksCategoryService $service
	 * @return void
	 * @throws Exception
	 */
	public function remove(Request $request, TasksCategoryService $service): void
	{
		$id = $request->get('id');
		if (!$id) {
			throw new Exception("Bad Request", 400);
		}
		$service->delete((int)$id);
	}
}
