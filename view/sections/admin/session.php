<?php
    session_start();

    //Si l'utilisateur n'est pas connecter $_SESSION["email"] n'existe pas 
    if(!$_SESSION["email"]){
        header(
            "Location:login?error=1&message=" 
            . urlencode($message) . 
            "&title=" . urlencode($title) 
        );
    }
?>