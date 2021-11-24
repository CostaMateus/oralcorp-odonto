<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBladeExtensions();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    protected function registerBladeExtensions()
    {
        $this->app->afterResolving("blade.compiler", function (BladeCompiler $bladeCompiler) {
            $bladeCompiler->directive("role", function ($arguments) {
                list($role, $guard) = explode(",", $arguments.",");

                return "<?php if(auth({$guard})->check() && auth({$guard})->user()->hasRole({$role})): ?>";
            });
            $bladeCompiler->directive("elserole", function ($arguments) {
                list($role, $guard) = explode(",", $arguments.",");

                return "<?php elseif(auth({$guard})->check() && auth({$guard})->user()->hasRole({$role})): ?>";
            });
            $bladeCompiler->directive("endrole", function () {
                return "<?php endif; ?>";
            });
        });
    }
}
