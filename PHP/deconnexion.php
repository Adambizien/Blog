<?php
    session_start();//on ouvre une session pour récupérer les données qui sont stockés dedans ou pour en stocker d'autre.
    session_destroy();//on ferme la session.
    header("location:page_daccueil.php");//retoure à la page d'accueil.
    exit();
?>
