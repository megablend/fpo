<?php 

namespace App\Classes\Facades;

use Illuminate\Support\Facades\Facade;

class Helper extends Facade {
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Helper'; // the IoC binding.
    }
}