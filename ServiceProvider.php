<?php namespace Cysha\Modules\News;

use Illuminate\Foundation\AliasLoader;
use Cysha\Modules\Core\BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        //$this->registerOtherPackages();
    }

    private function registerOtherPackages()
    {
        $serviceProviders = [
            'MaxHoffmann\Parsedown\ParsedownServiceProvider',         # https://github.com/maxhoffmann/parsedown-laravel
        ];

        foreach ($serviceProviders as $sp) {
            $this->app->register($sp);
        }

        $aliases = [
            'Markdown'        => 'MaxHoffmann\Parsedown\ParsedownFacade',
        ];

        foreach ($aliases as $alias => $class) {
            AliasLoader::getInstance()->alias($alias, $class);
        }
    }

}
