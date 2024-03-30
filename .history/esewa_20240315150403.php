<?php
session_start();
require "./includes/head.php";
require './includes/conn.php';

// Redirect to login page if user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: /Plant");
    exit();
}
