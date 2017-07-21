<?php
namespace ZiNETHQ\SparkUserTeamEmail\Facades;

use Illuminate\Support\Facades\Facade;
use ZiNETHQ\SparkUserTeamEmail\SparkUserTeamEmail as UserTeamEmail;

class SparkUserTeamEmail extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return UserTeamEmail::class;
    }
}
