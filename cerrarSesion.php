<?php
session_start();
if (!isset($_SESSION['last_access'])) {
    $_SESSION['last_access'] = 0;
}
header('Location: Logueo.php');
?>
    