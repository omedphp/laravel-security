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

namespace Omed\Laravel\Security\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Kilip\SanctumORM\Manager\TokenManagerInterface;

class AuthController extends Controller
{
    /**
     * @param Request               $request
     * @param TokenManagerInterface $tokenManager
     *
     * @throws ValidationException when credentials is incorrect
     *
     * @return JsonResponse
     */
    public function login(Request $request, TokenManagerInterface $tokenManager)
    {
        $request->validate([
            'usernameOrEmail' => ['required'],
            'password' => ['required'],
        ]);

        $usernameOrEmail = $request->get('usernameOrEmail');
        $password = $request->get('password');
        $tokenName = $request->get('token_name', 'omed-web');

        $user = $tokenManager->findUserByUsernameOrEmail($usernameOrEmail);

        if (!$user || !Hash::check($password, $user->getPassword())) {
            throw ValidationException::withMessages(['usernameOrEmail' => ['The provided credentials are incorrect.']]);
        }

        $newToken = $tokenManager->createToken($user, $tokenName);

        return response()->json($newToken);
    }
}
