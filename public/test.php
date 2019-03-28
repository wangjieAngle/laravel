<?php
/**
 * Created by PhpStorm.
 * User: clown
 * Date: 2018/8/16
 * Time: 13:17
 */


declare(ticks=1);

function tick_handler()
{
    echo "tick_handler() called\n";
    echo "<br />";
}

register_tick_function('tick_handler');

$a = 1;

if ($a > 0) {
    $a += 2;
    print($a);
    $a += 2;
    print($a);
}
