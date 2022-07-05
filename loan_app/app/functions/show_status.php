<?php

function status()
{
    if (empty($profile)) {
        $message = "<span class='red'>Not Verified</span>";
    } else {
        $message = "<span class='green'>Verified</span>";
    }

    return $message;
}