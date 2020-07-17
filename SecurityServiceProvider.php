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

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Kilip\SanctumORM\Contracts\TokenModelInterface;
use Omed\Laravel\ORM\Resolvers\TargetEntityResolver;
use Omed\Laravel\Security\Controller\AuthController;
use Omed\Laravel\Security\Model\Tokens;

class SecurityServiceProvider extends ServiceProvider
{
    public function boot(Application $app)
    {
        $app->alias(AuthController::class, 'omed.security.controller.auth');

        $this->loadRoutesFrom(__DIR__.'/Resources/routes/api.php');
        $this->resolveTargetEntity();
        $this->registerDoctrine();
    }

    public function register()
    {
    }

    private function resolveTargetEntity()
    {
        /** @var TargetEntityResolver $resolver */
        $resolver = $this->app->get(TargetEntityResolver::class);
        $resolver->addResolveTargetEntity(
            TokenModelInterface::class,
            Tokens::class,
            []
        );
    }

    private function registerDoctrine()
    {
        config([
            'doctrine.managers.default.paths' => array_merge(
                [__DIR__.'/Model'],
                config('doctrine.managers.default.paths', [])
            ),
        ]);
    }
}
