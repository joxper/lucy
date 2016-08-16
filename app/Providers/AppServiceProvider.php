<?php

namespace App\Providers;

use Blade;
use Sentinel;
use App\Models\Module;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootModulesMenu();
        $this->bootSkinComposer();
        $this->bootCustomBladeDirectives();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot our custom blade directives.
     * 
     * @return void
     */
    private function bootCustomBladeDirectives()
    {
        // Blade permissions directive for views...
        Blade::directive('access', function ($expression) {
            if (Sentinel::check()) {
                return "<?php if (LucyGuard::hasAccess{$expression}): ?>";
            }

            return;
        });

        Blade::directive('endaccess', function ($expression) {
            if (Sentinel::check()) {
                return "<?php endif; ?>";
            }

            return;
        });
    }

    /**
     * Bootstrap user's layout skin.
     * 
     * @return void
     */
    private function bootSkinComposer()
    {
        view()->composer(['layouts.app', 'docs'], function ($view) {
            $skin = 'blue';

            if ($user = user_info()) {
                $skin = $user->skin;
            }

            $view->withSkin($skin);
        });
    }

    /**
     * Bootstrap modules menu.
     *
     * @return void
     */
    private function bootModulesMenu()
    {
        view()->composer('layouts.modules-menu', function ($view) {
            $view->withCount(Module::count())->withMenus(Module::menus());
        });
    }
}
