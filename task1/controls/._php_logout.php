<?php
// destroy the session
session_start();

if(session_destroy())
{
header("location:../frontend/html_login.php");}

?>