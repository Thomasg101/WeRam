<?php
session_start();

include 'header.inc';

$logged_in = isset( $_SESSION['UID'] ) ? true : false;

/**
 * Testing Purposes
 * start
 */
$logged_in = true;

// end

if ( !$logged_in ) {
    echo 'Please Log in';
} else {
    $username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : 'john';
    include "/home/droppingfries/public_html/WeRam" . '/templates/post/postCreate.inc';
}

include 'footer.inc';