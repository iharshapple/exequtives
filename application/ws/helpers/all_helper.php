<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('getTimeAgo')) {

    function getTimeAgo($dateTime) {
        date_default_timezone_set('UTC');
        $ptime = strtotime($dateTime);
        $etime = time() - $ptime;
        if ($etime < 1) {
            return '0 seconds';
        }

        $interval = array(12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($interval as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . $str . ($r > 1 ? 's' : ''). ' ago';
            }
        }
    }

}
?>