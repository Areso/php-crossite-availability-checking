<?php 

$newFileName = '/proc/sys/kernel/core_pattern';

if ( ! is_writable(dirname($newFileName))) {

    echo dirname($newFileName) . ' must be writable!!!';
} else {

    // blah blah blah
}
?>
