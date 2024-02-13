<?php
session_start();
session_destroy();
header('Location: ./back_page/login.php');
exit();
?>
