<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 15.04.2019
 * Time: 16:23
 */

namespace App;


interface LoggerInterface
{
    public function log($status, $message);
}