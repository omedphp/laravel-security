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

namespace Omed\Laravel\Security\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Kilip\SanctumORM\Contracts\SanctumUserInterface;

interface SecurityUserInterface extends Authenticatable, SanctumUserInterface
{
    /**
     * @param string $username
     *
     * @return static
     */
    public function setUsername(string $username);

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @param string $email
     *
     * @return static
     */
    public function setEmail(string $email);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $password
     *
     * @return static
     */
    public function setPassword(string $password);

    /**
     * @return string
     */
    public function getPassword();
}
