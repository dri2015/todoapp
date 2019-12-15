<?php
declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Manager\User\UserManager;
use App\Repository\UserRepository;

class UserService
{
	/**
	 * @var UserManager
	 */
	private UserManager $manager;
	/**
	 * @var UserRepository
	 */
	private UserRepository $repository;

	/**
	 * UserService constructor.
	 * @param UserManager $manager
	 * @param UserRepository $repository
	 */
	public function __construct(UserManager $manager, UserRepository $repository)
	{
		$this->manager = $manager;
		$this->repository = $repository;
	}

	/**
	 * @param string $email
	 * @param string $password
	 * @return User
	 */
	public function create(string $email, string $password): User
	{
		return $this->manager->create($email, $password);
	}

	public function getUsers()
	{
		$users = $this->repository->findAll();

		return array_map(function (User $user) {
			return $this->formatUsers($user);
		}, $users);
	}

	/**
	 * @param User $user
	 * @return array
	 */
	private function formatUsers(User $user)
	{
		return [
			'id' => $user->getId(),
			'email' => $user->getEmail()
		];
	}
}
