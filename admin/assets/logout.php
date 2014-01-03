<?php
if (ini_get("session.use_cookies")) {
    setcookie(session_name(),'!',time()-30000,'/');
}
setcookie('checkdata','!',time()-30000,'/');
setcookie('check','!',time()-30000,'/');
session_start();
session_destroy();
header('Location: ../index.php');
?>
