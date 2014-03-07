<?php
// checking for non web connection ///////////////////////////////////////////////////////////////
function isMobile(){
    return true;
    $user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
    if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) ) {
        return true;
    } else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) ) {
        return true;
    }
    return false;
}

//after checking for mob or web. Connecting to database accordingly with diff assets loaded respectively///////////////

try
{
    if(isMobile() /*&& !isset($_GET['desktop']))*/||isset($_GET['mobile']))
    {
        define('MOBILE','asd');
        $PATH='admin/';
        if(isset($_GET['q']))
            require_once('assets/serve.php');
        else
        {
            $TITLE="NITTFEST '13";
            $LANGUAGE="English";
        }
        require_once("assets/mobile.php");
        die();
    }
    else
    {
        include "main.php";
    }


}
catch(Exception $e)
{
}
