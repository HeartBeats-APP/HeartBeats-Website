<?php
session_start();

// Delete user session
session_unset();
session_destroy();

if (session_status() == PHP_SESSION_ACTIVE) {
    echo false;
    return;
}

echo true;

?>

