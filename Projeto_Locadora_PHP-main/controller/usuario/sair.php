<?php
    session_unset();
    session_destroy();
    $_SESSION=[];

    header('Location:../../view/login.php');
?>