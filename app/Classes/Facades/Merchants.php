<?php 

namespace App\Classes\Facades;

use Illuminate\Support\Facades\Facade;

class Merchants extends Facade {
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Merchants'; // the IoC binding.
    }
}