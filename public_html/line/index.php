<?php
session_start();
require_once('LineLogin.php');

if (isset($_SESSION['profile'])) {
    header('location:index.php?route=member/loginline');
} else {
    $line = new LineLogin();
    $link = $line->getLink();
    echo '<a href="', $link, '">Login</a>';
}