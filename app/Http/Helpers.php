<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this templates file, choose Tools | Templates
 * and open the templates in the editor.
 */

/**
 * Description of helpers
 *
 * @author Syiewa
 */
function setActive($route, $class = 'active')
{
    $exp        = explode('.', $route);
    $array      = array_splice($exp, 0, 2);
    $expRoute   = explode('.', Route::currentRouteName());
    $arrayRoute = array_splice($expRoute, 0, 2);
    $diff       = array_diff($array, $arrayRoute);

    return (count($diff) == 0) ? $class : '';
}

/*function setActiveParent($route, $class = 'active')
{
    $exp        = explode('.', $route);
    $array      = array_splice($exp, 0, 2);
    $expRoute   = explode('.', Route::currentRouteName());
    $arrayRoute = array_splice($expRoute, 0, 2);
    $diff       = array_diff($array, $arrayRoute);
    return (count($diff) == 0) ? $class : '';
}*/

function setActiveSub($route, $class = 'active')
{
    $found = false;

    foreach ($route as $value) {
        if ($value == Route::currentRouteName()) {
            $found = true;

            return $class = 'active';
        }
    }
    if ($found = false) {
        return $class = '';
    }
}


function formatDate($array)
{
    $string = date('Y-m-d', strtotime($array));

    return $string;
}

function statusTable($data)
{
    if ($data == 1) {
        return 'Active';
    } else {
        return 'Not Active';
    }
}
