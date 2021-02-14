<?php

namespace App\Providers;

use App\Podcast;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::defaultView('vendor.pagination.bootstrap-4');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // App Name, from the .env file
        $appName = config('app.name');
        view::share('appName', $appName);
        
        $menuPodcasts = Podcast::all();
        $lddm = Podcast::limit(1)->first();
        view::share('menuPodcasts', $menuPodcasts);
        view::share('lddm', $lddm);
        
        Blade::directive('date', function ($expression) {
            return "<?php echo ($expression)->format('d/m/Y'); ?>";
        });
        Blade::directive('datedit', function ($expression) {
            return "<?php echo ($expression)->format('Y-m-d'); ?>";
        });
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('d/m/Y @ H:i'); ?>";
        });
        Blade::directive('lcfirst', function ($expression) {
            return "<?php echo lcfirst($expression); ?>";
        });
        Blade::directive('ucfirst', function ($expression) {
            return "<?php echo ucfirst($expression); ?>";
        });
        Blade::directive('lowercase', function ($expression) {
            return "<?php echo strtolower($expression); ?>";
        });
        Blade::directive('uppercase', function ($expression) {
            return "<?php echo strtoupper($expression); ?>";
        });
        Blade::directive('slug', function ($expression) {
            return "<?php echo str_replace('-', ' ', $expression); ?>";
        });
        Blade::directive('time', function ($expression) {
            return "<?php echo ($expression)->format('H:i:s'); ?>";
        });
        Blade::directive('year', function ($expression) {
            return "<?php echo ($expression)->format('Y'); ?>";
        });
    }
}
