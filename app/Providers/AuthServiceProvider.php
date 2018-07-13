<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\PhoneList;
use App\Policies\PhonePolicy;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        PhoneList::class => PhonePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define(
            'show-phone',
            function ($user) {
                return $user->is_active;
            }
        );

        $gate->define(
            'super-admin',
            function ($user) {
                return $user->roleId === User::SUPER_ADMIN;
            }
        );
    }
}
