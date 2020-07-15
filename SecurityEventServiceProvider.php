<?php


namespace Omed\Laravel\Security;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;
use Omed\Laravel\Security\Listener\SecurityEventSubscriber;

class SecurityEventServiceProvider extends BaseEventServiceProvider
{
    protected $subscribe = [
        SecurityEventSubscriber::class
    ];
}