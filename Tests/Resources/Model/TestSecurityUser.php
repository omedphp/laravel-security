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

namespace Omed\Laravel\Security\Tests\Resources\Model;

use Doctrine\ORM\Mapping as ORM;
use Kilip\SanctumORM\Model\SanctumUserTrait;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use LaravelDoctrine\ORM\Notifications\Notifiable;
use Omed\Laravel\Security\Model\SecurityUserInterface;

/**
 * Class TestSecurityUser.
 *
 * @ORM\Entity
 * @ORM\Table(name="security_user")
 */
class TestSecurityUser implements SecurityUserInterface
{
    use Authenticatable;
    use Notifiable;
    use SanctumUserTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $username;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $email;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return static
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return static
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }
}
