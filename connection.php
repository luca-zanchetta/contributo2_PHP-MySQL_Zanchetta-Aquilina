<?php
#                   Script per la connesione al db

$host = "localhost";
$mysql_user = "admin";
$mysql_pwd = "admin";
$db_name = "infostud";
        
        
$mysqliConnection = new mysqli($host, $mysql_user, $mysql_pwd, $db_name);
if (mysqli_errno($mysqliConnection)) {
    printf("\nERRORE: Connessione al db non riuscita.\n%s\n", mysqli_error($mysqliConnection));
    exit();
}

?>