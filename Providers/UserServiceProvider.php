<?php /** @noinspection PhpUndefinedMethodInspection */

namespace Modules\User\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Modules\User\Http\Middleware\Authenticate;
use App\Http\Kernel;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Modules\User\Http\Middleware\EnsureEmailIsVerified;
use Modules\User\Http\Middleware\RedirectIfAuthenticated;
use Modules\User\Models\User;


/**
 *
 */
class UserServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected string $moduleName = 'User';

    /**
     * @var string $moduleNameLower
     */
    protected string $moduleNameLower = 'user';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->bootMacros();
        $this->bootConfigs();
        $this->bootMiddlewares();
    }

    /**
     * @return void
     */
    public function bootConfigs(): void
    {
       $this->overrideAuthenticationConfigs();
       $this->overrideViewConfigs();
    }

    /**
     * @return void
     */
    public function overrideAuthenticationConfigs(): void
    {
        $authConfig = config('auth');
        $authConfig['providers']['users'] = ['driver'=> 'eloquent', 'model'=> User::class];
        $authConfig['guards']['web'] = ['driver'=> 'session', 'provider'=> 'users'];
        config(['auth' => $authConfig]);
    }

    /**
     * @return void
     */
    public function overrideViewConfigs(): void
    {
        $this->overrideModulesLivewireConfigs();
        Paginator::useBootstrap();
        config(['livewire.pagination_theme' => 'bootstrap']);
    }

    /**
     * @return void
     */
    public function overrideModulesLivewireConfigs(): void
    {
        try {
            $modulesLivewireConfigs = config('modules-livewire');
            $modulesLivewireConfigs['namespace'] = "Services\\Web\\Components";
            $modulesLivewireConfigs['view'] = 'Resources/views/components';
            config(['modules-livewire' => $modulesLivewireConfigs]);
        }catch (\Exception $e){}
    }

    /**
     * @return void
     */
    public function bootMacros(): void
    {
        Request::macro('getPaginationCount', function() {
            return match (true){
                ctype_digit($query = $this->query('paginationCount')) && $query <= 1000 => (int) $query,
                default => config('repository.pagination.limit', 50)
            };
        });
    }


    /**
     * @return void
     */
    public function bootMiddlewares(): void
    {
        $this->app['router']->aliasMiddleware('auth', Authenticate::class);
        $this->app['router']->aliasMiddleware('guest', RedirectIfAuthenticated::class);
        $this->app['router']->aliasMiddleware('verified', EnsureEmailIsVerified::class);
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(LivewireServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig(): void
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'Resources/lang'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [];
    }

    /**
     * @return array
     */
    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
