<?php

namespace morningtrain\menumanager;

use Illuminate\Support\ServiceProvider;

class menumanagerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        	
		//Include the class
		require_once 'menumanager.php';
	
		//Add alias for the facade.
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
		$loader->alias('Menu', '\morningtrain\menumanager\menumanager');
		
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}