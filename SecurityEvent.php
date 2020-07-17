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

namespace Omed\Laravel\Security;

class SecurityEvent
{
    public const LOGIN = 'omed.security.login';
    public const LOGOUT = 'omed.security.logout';
}
