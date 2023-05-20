<?php
session_start();
session_unset();
session_destroy();

header('Location: ../../../../WPRG_Project/index.php');
?>