<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head></head>

<body>

<?php

mysqli_report(MYSQLI_REPORT_ALL); // Per la gestione delle eccezioni dovute a molteplici insert successive ad ogni installazione del db


// Collegamento al db
include("connection.php");





//========================= DROP TABELLE ======================================





$sqlDrop = "DROP TABLE IF EXISTS studente, colore, corso, appello, iscrizione CASCADE";

if(!$resultQ = mysqli_query($mysqliConnection, $sqlDrop)) {
    printf("\nERRORE: Drop delle tabelle fallita.\n");
    exit();
}

// Chiusura connessione
mysqli_close($mysqliConnection);
?>
</body></html>
