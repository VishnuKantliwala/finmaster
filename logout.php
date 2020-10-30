<?php
session_start();
unset($_SESSION['userid']);
unset($_SESSION['groupname']);
header("Location:../Home/");

?>
