<?php 

function moneyToNumeric ($money, $thousandSparator)
{
    return str_replace($thousandSparator, '', $money);
}