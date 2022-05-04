<?php
#                   Script per la connesione al server

$host = "localhost";
$mysql_user = "admin";
$mysql_pwd = "admin";
        
        
$mysqliConnection = new mysqli($host, $mysql_user, $mysql_pwd);
if (mysqli_connect_errno()) {
    printf("\nERRORE: Connessione al server non riuscita.\n%s\n", mysqli_connect_error());
    exit();
}

?>