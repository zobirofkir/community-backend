<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class ResetPasswordFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ResetPasswordService';
    }
}