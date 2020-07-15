<?php


namespace Omed\Laravel\Security;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Omed\Laravel\User\Model\User;
use Laravel\Passport\Passport;
use Omed\Laravel\User\Policies\ModelPolicy;

class SecurityServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => ModelPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
    }

    public function register()
    {
        $this->configureAuth();
    }

    private function configureAuth()
    {
        /** @var \Illuminate\Config\Repository $config */
        $config = $this->app['config'];

        $config->set('auth.model', User::class);
        $config->set('auth.defaults.guard', 'api');
        $config->set('auth.guards.api.driver', 'jwt');
        $config->set('auth.providers.users.model', User::class);
        $config->set('auth.providers.users.driver', 'doctrine');
    }

}