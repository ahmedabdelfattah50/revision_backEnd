<?php

    // ====================== Routes #######################
    
    $css_path  = 'layout/CSS/';                  // path of CSS     
    $js_path   = 'layout/JS/';                    // path of JS     
    $imgs_path = 'layout/images/';
    $tmpl      = 'includes/templates/';              // path of template admin    
    $func      = 'includes/functions/';         // path of languages file

    // ====================== Files include #######################

    include 'conection.php';                 // ######## the connection with database ########
    include $func      . "functions.php";           // ======== include the file of functions ======== 
    include $tmpl      . "header.php";              // ======== inclue the header ======== 
    include $tmpl      . "footer.php";              // ======== include the footer ======== 

    if(!isset($noNavbar)) {                // ##### if it has not noNavbar variable it will include the navbar file 
        include $tmpl . "navbar.php";               // ======== inclue the navbar ========    
    }