<?php

namespace Modules\User\Providers;
use Illuminate\Support\Str;
use Livewire\Livewire;

use Illuminate\Support\ServiceProvider;

class LivewireServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //add livewire components
        [$componentsDir, $namespace] = [module_path('user','Services/Web/Components'), "Modules\\User\\Services\\Web\\Components"];
        collect(scandir($componentsDir))->each(fn($fileName) => $this->loadLivewireComponent($fileName, $namespace));
    }

    protected function loadLivewireComponent(string $fileName, string $namespace): void
    {
        $className = match ($fileName){
            '.','..','.gitkeep' => null,
            default => Str::remove('.php',$fileName)
        };

        !empty($className) and Livewire::component("user::".Str::kebab($className),"$namespace\\$className");
    }
}
