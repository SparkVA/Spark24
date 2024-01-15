<?php

namespace Modules\Spark24\Providers;

use App\Contracts\Modules\ServiceProvider;

/**
 * @package $NAMESPACE$
 */
class AppServiceProvider extends ServiceProvider
{
    private $moduleSvc;

    protected $defer = false;

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->moduleSvc = app('App\Services\ModuleService');

        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();

        $this->registerLinks();

        // Uncomment this if you have migrations
        // $this->loadMigrationsFrom(__DIR__ . '/../$MIGRATIONS_PATH$');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }

    /**
     * Add module links here
     */
    public function registerLinks(): void
    {
        // Show this link if logged in
        // $this->moduleSvc->addFrontendLink('Spark24', '/spark24', '', $logged_in=true);

        // Admin links:
        $this->moduleSvc->addAdminLink('Spark24', '/admin/spark24');
    }

    /**
     * Register config.
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('spark24.php'),
        ], 'spark24');

        $this->mergeConfigFrom(__DIR__.'/../Config/config.php', 'spark24');
    }

    /**
     * Register views.
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/spark24');
        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([$sourcePath => $viewPath],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/spark24';
        }, \Config::get('view.paths')), [$sourcePath]), 'spark24');
    }

    /**
     * Register translations.
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/spark24');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'spark24');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'spark24');
        }
    }
}
