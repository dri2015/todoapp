<?php
declare(strict_types=1);

namespace App\Manager\User;

use App\Entity\User;
use App\Security\User\UserSecurity;
use Doctrine\ORM\EntityManagerInterface;

class UserManager
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;
	/**
	 * @var UserSecurity
	 */
    private UserSecurity $userSecurity;
    /**
     * UserManager constructor.
     * @param EntityManagerInterface $em
     * @param UserSecurity $userSecurity
     */
    public function __construct(
        EntityManagerInterface $em,
		UserSecurity $userSecurity
    )
    {
        $this->em = $em;
        $this->userSecurity = $userSecurity;
    }

    /**
     * @param string $password
     * @param string $email
     * @return User
     */
    public function create(
        string $email,
        string $password
    ): User {
		$user = new User();
		$user->setEmail($email);
		$encodedPassword = $this->userSecurity->getEncoder($user, $password);
		$user->setPassword($encodedPassword);
		$this->em->persist($user);
		$this->em->flush();
		return $user;
    }

}
