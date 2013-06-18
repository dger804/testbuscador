<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// datos para la coneccion a mysql
        define('DB_SERVER','localhost');
        define('DB_NAME','db');
        define('DB_USER','root');
        define('DB_PASS','');
        /*
        $con = mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die("Fallo");
        mysql_select_db(DB_NAME,$con);
        */
        $con = new PDO('mysql:host=DB_SERVER;db_name=DB_NAME', DB_USER, DB_PASS);
        mysql_select_db(DB_NAME,$con);
        
?>
