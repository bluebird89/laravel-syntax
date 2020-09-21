<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Team;
use App\Policies\PostPolicy;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Auth::extend('jwt', function($app, $name, array $config) {
//            // 返回一个Illuminate\Contracts\Auth\Guard实例...
//            return new JwtGuard(Auth::createUserProvider($config['provider']));
//        });

        Gate::define('edit-settings', function ($user) {
            return $user->isAdmin;
        });

        Gate::define('update-post', function ($user, $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('update-post', [PostPolicy::class, 'update']);
    }
}
