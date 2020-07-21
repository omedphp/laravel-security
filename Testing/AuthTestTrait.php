<?php

/*
 * This file is part of the Omed project.
 *
 * (c) Anthonius Munthi <https://itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Omed\Laravel\Security\Testing;

use Doctrine\Persistence\ObjectManager;
use Illuminate\Support\Facades\Hash;
use Kilip\LaravelDoctrine\ORM\Testing\ORMTestTrait;
use Omed\Laravel\Security\Model\SecurityUserInterface;

trait AuthTestTrait
{
    use ORMTestTrait;

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     *
     * @return SecurityUserInterface
     */
    protected function createUser($username = 'test', $password = 'test', $email = 'test@example.com')
    {
        $repository = $this->getRepositoryForUser();

        $user = $repository->findOneBy(['username' => $username]);
        if (null === $user) {
            $class = $this->getUserModel();
            $em = $this->getManagerForUser();
            /** @var SecurityUserInterface $user */
            $user = new $class();
            $user->setUsername('test');
            $user->setEmail('test@example.com');
            $user->setPassword(Hash::make('test'));
            $em->persist($user);
            $em->flush();
        }

        return $user;
    }

    protected function getRepositoryForUser()
    {
        return $this->getRepository($this->getUserModel());
    }

    /**
     * @return ObjectManager
     */
    protected function getManagerForUser()
    {
        return $this->getManagerForClass($this->getUserModel());
    }

    /**
     * @return string
     */
    protected function getUserModel()
    {
        return config('auth.providers.users.model');
    }
}
