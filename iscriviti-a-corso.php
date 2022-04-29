<?php
    $host = "localhost";
    $mysql_user = "admin";
    $mysql_pwd = "admin";
    $db_name = "infostud";
        
        
    $mysqliConnection = new mysqli($host, $mysql_user, $mysql_pwd, $db_name);
    if (mysqli_errno($mysqliConnection)) {
        printf("\nERRORE: Connessione al db non riuscita.\n%s\n", mysqli_error($mysqliConnection));
        exit();
    }
    
    session_start();
    if($_SESSION['matricola']) {
        $sql_get_student_name = "SELECT nome
        FROM studente
        WHERE matricola = \"{$_SESSION['matricola']}\"
        ";

        if($resultQ = mysqli_query($mysqliConnection, $sql_get_student_name)) {
            $row = mysqli_fetch_array($resultQ);
            if($row) {
                $nome = $row['nome'];
            }
        }
    }else include("login.php");

    //effettuiamo l'iscrizione all'esame
    $nome_esame = $_GET['corso'];
    $query_iscrizione_corso = "INSERT INTO iscrizione VALUES (\"{$_SESSION['matricola']}\",\"{$_GET['corso']}\",".date("Y/m/d").")";

    if($mysqliConnection->query($query_iscrizione_corso) == TRUE)
        include("iscriviti.php");
    else
        echo "error!";
?>