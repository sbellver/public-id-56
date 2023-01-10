<?php

namespace Crnkovic\PublicID;

use Illuminate\Support\ServiceProvider;

class PublicIDServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/public-id.php' => config_path('public-id.php'),
        ]);
    }
}
