<?php 

namespace App\Classes\Facades;

use Illuminate\Support\Facades\Facade;

class Admin extends Facade {
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Admin'; // the IoC binding.
    }
}