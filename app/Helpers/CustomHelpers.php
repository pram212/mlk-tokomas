<?php

function moneyToNumeric($money, $thousandSparator)
{
    return str_replace($thousandSparator, '', $money);
}

function formatDateInIndonesian($date, $format = 'd F Y', $locale = 'id')
{
    // Create a Carbon instance
    $carbonDate = \Carbon\Carbon::parse($date);

    // Format the date
    $formattedDate = $carbonDate->format($format);

    // Define month names in Indonesian
    $months = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    // Replace English month names with Indonesian month names
    foreach ($months as $english => $indonesian) {
        $formattedDate = str_replace($english, $indonesian, $formattedDate);
    }

    return $formattedDate;
}

function formatNumber($value, $decimals = 2)
{
    return rtrim(rtrim(number_format($value, $decimals), '0'), '.');
}

function getValueOrFallback($detail, $fallback, $attribute)
{
    return $detail ? $detail->$attribute : $fallback->$attribute;
}
