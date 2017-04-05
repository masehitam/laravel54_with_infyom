<?php

namespace Nguonchhay\LaravelMedia;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider {

	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
	    $this->loadViewsFrom(__DIR__ . '/views', 'medias');

	    $this->publishes([
		    __DIR__ . '/views' => base_path('resources/views/nguonchhay-laravel'),
	    ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
	public function register() {
		include __DIR__ . '/routes.php';
		$this->app->make('Nguonchhay\LaravelMedia\MediaController');
	}
}
