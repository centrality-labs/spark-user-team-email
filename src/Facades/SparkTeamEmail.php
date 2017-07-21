<?php
namespace ZiNETHQ\SparkTeamEmail\Facades;

use Illuminate\Support\Facades\Facade;
use ZiNETHQ\SparkTeamEmail\SparkTeamEmail as TeamEmail;

class SparkTeamEmail extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return TeamEmail::class;
    }
}
