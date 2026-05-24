<?php
function formatTimeAgo($date) {
    $timestamp = is_numeric($date) ? $date : strtotime($date);
    
    $diffInSeconds = $timestamp - time();
    $isPast = $diffInSeconds < 0; 
    $absDiff = abs($diffInSeconds); 

    $units = [
        "year" => 31536000,
        "month" => 2592000,
        "day" => 86400,
        "hour" => 3600,
        "minute" => 60,
        "second" => 1,
    ];

    foreach ($units as $unitName => $secondsInUnit) {
        if ($absDiff >= $secondsInUnit || $unitName === 'second') {
            $value = floor($absDiff / $secondsInUnit);

            if ($value == 1) {
                if ($unitName === 'day') return $isPast ? "yesterday" : "tomorrow";
                if ($unitName === 'month') return $isPast ? "last month" : "next month";
                if ($unitName === 'year') return $isPast ? "last year" : "next year";
            }

            $unitString = ($value == 1) ? $unitName : $unitName . "s";

            return $isPast ? "$value $unitString ago" : "in $value $unitString";
        }
    }
}
