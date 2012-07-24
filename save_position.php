<?php
session_start();
$_SESSION["latitud_user"] = $_POST["latitud"];
$_SESSION["longitud_user"] = $_POST["longitud"];
?>