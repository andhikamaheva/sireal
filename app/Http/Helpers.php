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



function formatDateString($date)
{
    $data = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateString();

    return $data;
}

function statusTable($data)
{
    if ($data == 1) {
        return 'Active';
    } else {
        return 'Not Active';
    }
}
