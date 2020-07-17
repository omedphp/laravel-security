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

namespace Omed\Laravel\Security\Tests\Controller;

use Omed\Laravel\Security\Testing\AuthTestTrait;
use Omed\Laravel\Security\Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use AuthTestTrait;

    public function testLogin()
    {
        $config = config();
        $this->createUser();
        $response = $this->post(route('omed.security.routes.login'), [
            'usernameOrEmail' => 'test@example.com',
            'password' => 'test',
        ]);

        $response->assertStatus(200);

        $token = $response->json('plainTextToken');
        $this->assertNotNull($token);
    }
}
