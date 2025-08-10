<?php

session_start();

unset($_SESSION['id']);
session_unset();
session_destroy();
echo "Logging out...";
header('Refresh: 3;url=../index.php');
exit();


?>