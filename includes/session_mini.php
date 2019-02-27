<?php
session_start();////////

if (empty($_SESSION['user_session']) || $_SESSION['user_session'] != session_id()):
    echo 'Error 0: Your session has expired. Please <a target="_top" href="index.php">login again</a>';
    exit();
endif
?>