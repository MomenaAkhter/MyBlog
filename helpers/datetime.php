<?php

function now()
{
    return date('Y-m-d H:i:s');
}

function diff(String $value)
{
    $datetime = new DateTime($value);
    $diff = $datetime->diff(new DateTime('now'));
    $details = array_intersect_key((array)$diff, array_flip(['y', 'm', 'd', 'h', 'i', 's']));

    $year = $details['y'] . ' ' . ($details['y'] > 1 ? 'years' : 'year');
    $month = $details['m'] . ' ' . ($details['m'] > 1 ? 'months' : 'month');
    $day = $details['d'] . ' ' . ($details['d'] > 1 ? 'days' : 'day');
    $hour = $details['h'] . ' ' . ($details['h'] > 1 ? 'hours' : 'hour');
    $minute = $details['i'] . ' ' . ($details['i'] > 1 ? 'minutes' : 'minute');
    $second = $details['s'] . ' ' . ($details['s'] > 1 ? 'seconds' : 'second');

    if ($details['y'] > 0)
        return $year;
    else if ($details['m'] > 0)
        return $month;
    else if ($details['d'] > 0)
        return $day . ' ' . $hour;
    else if ($details['h'] > 0)
        return $hour . ' ' . $minute;
    else if ($details['i'] > 0)
        return $minute . ' ' . $second;
    else
        return $second;
}
