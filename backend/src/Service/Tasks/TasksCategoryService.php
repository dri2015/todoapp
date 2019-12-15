<?php


namespace App\Service\Tasks;

use App\Entity\TaskCategory;
use App\Repository\TaskCategoryRepository;
use App\Manager\Tasks\TasksCategoryManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Exception;

class TasksCategoryService
{
	/**
	 * @var TasksCategoryManager
	 */
	private TasksCategoryManager $manager;
	/**
	 * @var TaskCategoryRepository
	 */
	private TaskCategoryRepository $repository;

	/**
	 * TasksCategoryService constructor.
	 * @param TasksCategoryManager $manager
	 * @param TaskCategoryRepository $repository
	 */
	public function __construct(TasksCategoryManager $manager, TaskCategoryRepository $repository)
	{
		$this->manager = $manager;
		$this->repository = $repository;
	}

	/**
	 * @param $categoryId
	 * @return array
	 * @throws Exception
	 */
	public function getTaskCategory($categoryId)
	{
		try {
			$category = $this->repository->getCategory($categoryId);
		} catch (NoResultException $e) {
			throw new Exception('Category not found', 204);
		} catch (NonUniqueResultException $e) {
			throw new Exception('Category not found', 204);
		}

		return $this->formatCategory($category);

	}
	/**
	 * @param TaskCategory $category
	 * @return array
	 */
	private function formatCategory(TaskCategory $category)
	{

		return [
			'id' => $category->getId(),
			'name' => $category->getName(),
		];
	}

	/**
	 * @param string $name
	 * @return string
	 */
	public function create(string $name): string
	{
		return $this->manager->create($name);
	}

	/**
	 * @param int $id
	 * @return void
	 * @throws Exception
	 */
	public function delete(int $id): void
	{
		$this->manager->delete($id);
	}
}
