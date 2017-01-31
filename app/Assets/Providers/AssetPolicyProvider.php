<?php


namespace PN\Assets\Providers;


use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use PN\Assets\Asset;
use PN\Assets\Policies\AssetPolicy;
use PN\Providers\AuthServiceProvider;

class AssetPolicyProvider extends AuthServiceProvider
{
    protected $policies = [
        Asset::class => AssetPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }

}