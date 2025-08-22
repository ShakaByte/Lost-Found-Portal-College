<?php
session_start();
$_SESSION['check']='hello session';
echo $_SESSION['check'];
?>