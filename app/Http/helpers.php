<?php
/**
 * Created by PhpStorm.
 * User: aabraham
 * Date: 23/5/2016
 * Time: 1:30 PM
 */

function esFecha($fecha)
{
    if($fecha != '-0001-11-30 00:00:00.000000'){
        return true;
    } else {
        return false;
    }
}