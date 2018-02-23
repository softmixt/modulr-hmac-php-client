<?php

namespace CrowdProperty\ModulrHmacPhpClient;

use CrowdProperty\ModulrHmacPhpClient\Exception\ConfigException;
use Illuminate\Support\ServiceProvider;

class ModulrServiceProvider extends ServiceProvider
{
    const BASE_URL_SANDBOX = 'https://api-sandbox.modulrfinance.com/api-sandbox';
    const BASE_URL_PRODUCTION = 'https://api.modulrfinance.com/api';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Determine if this is a Lumen application.
     *
     * @return bool
     */
    protected function isLumen()
    {
        return str_contains($this->app->version(), 'Lumen');
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->isLumen()) {
            $this->publishes([
                __DIR__.'/Config/modulr.php' => config_path('modulr.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ModulrApi::class, function () {
            $api = new ModulrApi();

            if (!$env = \Config::get('modulr.environment')) {
                throw new ConfigException('Modulr environment not configured');
            }

            $api->setApiPath($this->getURL($env))
                ->setApiKey(\Config::get('modulr.api_key'))
                ->setHmacSecret(\Config::get('modulr.hmac_secret'))
                ->setDebugMode(\Config::get('modulr.debug'));

            return $api;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ModulrApi::class];
    }

    /**
     * Return the appropriate API URL based on the environment.
     *
     * @param $environment
     *
     * @return string
     */
    public function getURL($environment)
    {
        try {
            return constant('self::BASE_URL_'.strtoupper($environment));
        } catch (\Exception $e) {
            throw new InvalidArgumentException('Modulr environment should be one of "sandbox" or "production"');
        }
    }
}
