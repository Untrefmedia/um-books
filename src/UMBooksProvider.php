<?php

namespace Untrefmedia\UMBooks;

use Auth;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class UMBooksProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $this->publishes([
            __DIR__ . '/config/um-books.php' => config_path('um-books.php')
        ], 'config');

        $this->publishes([
            __DIR__ . '/../publish/public/' => public_path()
        ], 'formulario');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $items = &$event->menu->menu;

            $key_venue         = array_search('Venues', array_column($items, 'text'));
            $submenu_venue     = $items[$key_venue]['submenu'];
            $key_submenu_venue = array_search('Create', array_column($submenu_venue, 'text'));

            $user = Auth::user();

            // Quita del menu del admin el item "Create"
            if (! $user->hasPermissionTo('venue-create')) {
                unset($items[$key_venue]['submenu'][$key_submenu_venue]);
            }

        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require __DIR__ . '/routes/web.php';
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'umbooks');

        $this->mergeConfigFrom(
            __DIR__ . '/config/adminlte.php', 'adminlte'
        );
    }

    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param  string  $path
     * @param  string  $key
     * @return void
     */
    protected function mergeConfigFrom($path, $key)
    {
        $config = $this->app['config']->get($key, []);
        $this->app['config']->set($key, $this->mergeConfig(require $path, $config));
    }

    /**
     * Merges the configs together and takes multi-dimensional arrays into account.
     *
     * @param  array  $original
     * @param  array  $merging
     * @return array
     */
    protected function mergeConfig(array $original, array $merging)
    {
        $array = array_merge($original, $merging);

        foreach ($original as $key => $value) {
            if (! is_array($value)) {
                continue;
            }

            if (! Arr::exists($merging, $key)) {
                continue;
            }

            if (is_numeric($key)) {
                continue;
            }

            $array[$key] = $this->mergeConfig($value, $merging[$key]);
        }

        return $array;
    }

}
