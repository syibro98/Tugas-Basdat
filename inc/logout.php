<?php
@session_start();

session_destroy();

header("location: /Data/login.php");
?>
