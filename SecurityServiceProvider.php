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

use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Kilip\SanctumORM\Contracts\TokenModelInterface;
use Omed\Laravel\ORM\Resolvers\TargetEntityResolver;
use Omed\Laravel\Security\Controller\AuthController;
use Omed\Laravel\Security\Model\Tokens;

class SecurityServiceProvider extends ServiceProvider
{
    public function boot(Application $app, Repository $config)
    {
        $app->alias(AuthController::class, 'omed.security.controller.auth');

        $this->loadRoutesFrom(__DIR__.'/Resources/routes/api.php');
        $this->resolveTargetEntity();
    }

    public function register()
    {
        $this->registerDoctrine();
    }

    private function resolveTargetEntity()
    {
        /** @var \Omed\Laravel\ORM\Resolvers\TargetEntityResolver $resolver */
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
            'doctrine.managers.omed_security' => [
                'connection' => config('sanctum_orm.doctrine.connection'),
                'dev' => config('app.debug', false),
                'type' => 'annotations',
                'paths' => [
                    __DIR__.'/Model',
                ],
                'proxies' => [
                    'namespace' => false,
                    'path' => storage_path('proxies'),
                    'auto_generate' => false,
                ],
            ],
        ]);
    }
}
