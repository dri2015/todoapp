<?php


namespace App\Security\User;


use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class UserSecurity
{
	/**
	 * @var JWTTokenManagerInterface
	 */
	private JWTTokenManagerInterface $tokenManager;
	/**
	 * @var TokenStorageInterface
	 */
	private TokenStorageInterface $tokenStorage;
	/**
	 * @var EncoderFactoryInterface
	 */
	private EncoderFactoryInterface $encoderFactory;
	public function __construct(
		JWTTokenManagerInterface $tokenManager,
		TokenStorageInterface $tokenStorage,
		EncoderFactoryInterface $encoderFactory
	)
	{
		$this->tokenManager = $tokenManager;
		$this->tokenStorage = $tokenStorage;
		$this->encoderFactory = $encoderFactory;
	}
	/**
	 * @param User $user
	 * @return string
	 */
	public function getToken(User $user): string
	{
		return $this->tokenManager->create($user);
	}

	/**
	 * @return User|string
	 */
	public function getUser(): ?User
	{
		$token = $this->tokenStorage->getToken();

		if (!($token instanceof TokenInterface)) {
			return null;
		}

		return $token->getUser();
	}

	/**
	 * @param User $user
	 * @param string|null $password
	 * @return bool
	 */
	public function isPasswordValid(User $user, string $password = null): bool
	{
		if (is_null($password)) {
			return false;
		}

		return $this->encoderFactory->getEncoder($user)->isPasswordValid($user->getPassword(), $password, $user->getSalt());
	}

	/**
	 * @param User $user
	 * @param string|null $password
	 * @return string
	 */
	public function getEncoder($user, $password): string {
		return $this->encoderFactory->getEncoder($user)->encodePassword(
			$password, $user->getSalt()
		);
	}
}
