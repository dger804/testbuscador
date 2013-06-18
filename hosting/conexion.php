<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// datos para la coneccion a mysql
        define('DB_SERVER','sql207.260mb.org');
        define('DB_NAME','mb260_13264639_db');
        define('DB_USER','mb260_13264639');
        define('DB_PASS','abcdabcd10');
        
        $con = mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die("Fallo");
        mysql_select_db(DB_NAME,$con);
        
        /*$con = new PDO('mysql:host=DB_SERVER;db_name=db', DB_USER, DB_PASS) or die("Falló");
        mysql_select_db(DB_NAME,$con);
        */
?>
