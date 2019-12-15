<?php

namespace App\Manager\Tasks;

use App\Entity\TaskCategory;
use App\Repository\TaskCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class TasksCategoryManager
{
	/**
	 * @var EntityManagerInterface
	 */
	private EntityManagerInterface $em;
	/**
	 * @var TaskCategoryRepository
	 */
	private TaskCategoryRepository $repository;

	public function __construct(EntityManagerInterface $em, TaskCategoryRepository $repository)
	{
		$this->em = $em;
		$this->repository = $repository;
	}

	/**
	 * @param string $name
	 * @return int
	 */
	public function create(string $name): int
	{
		$category = new TaskCategory();
		$category->setName($name)->setId(2);
		$this->em->persist($category);
		$this->em->flush();
		return $category->getId();
	}

	/**
	 * @param int $id
	 * @throws Exception
	 */
	public function delete(int $id): void
	{
		$category = $this->repository->findOneBy(["id" => $id]);
		if (!$category) {
			throw new Exception('Category not found', 204);
		}
		$this->em->remove($category);
		$this->em->flush();
	}
}
