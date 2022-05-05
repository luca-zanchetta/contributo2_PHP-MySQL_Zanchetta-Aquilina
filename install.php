<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head></head>

<body>

<?php

mysqli_report(MYSQLI_REPORT_ALL); // Per la gestione delle eccezioni dovute a molteplici insert successive ad ogni installazione del db


// Connessione al server
include("connectionServer.php");

$db_name = "infostud";

// Creazione del db (eventuale)
$queryCreazioneDatabase = "CREATE DATABASE IF NOT EXISTS $db_name";
if (!$resultQ = mysqli_query($mysqliConnection, $queryCreazioneDatabase)) {
    printf("\nERRORE: Creazione del database non riuscita.\n");
    exit();
}
$mysqliConnection->close();


// Collegamento al db
include("connection.php");





//========================= CREAZIONE TABELLE ======================================





$sqlCreate1 = "CREATE TABLE IF NOT EXISTS studente (
    matricola char(7) primary key,
    nome varchar(100) not null,
    cognome varchar(100) not null,
    password varchar(100) not null,
  
    unique(matricola, password)
);";

if($resultQ = mysqli_query($mysqliConnection, $sqlCreate1)) {
    //printf("\nCreazione tabella studente eseguita.\n");
}
else {
    printf("\nERRORE: creazione tabella studente fallita.\n");
    exit();
}



$sqlCreate2 = "CREATE TABLE IF NOT EXISTS colore (
    nome varchar(100) primary key
);";

if($resultQ = mysqli_query($mysqliConnection, $sqlCreate2)) {
    //printf("\nCreazione tabella colore eseguita.\n");
}
else {
    printf("\nERRORE: creazione tabella colore fallita.\n");
    exit();
}



$sqlCreate3 = "CREATE TABLE IF NOT EXISTS corso (
    id serial primary key,
    nome varchar(100) not null,
    descrizione TEXT,
    info_prof TEXT,
    id_colore varchar(100) REFERENCES colore(nome),
  
    unique(nome)
);";

if($resultQ = mysqli_query($mysqliConnection, $sqlCreate3)) {
    //printf("\nCreazione tabella corso eseguita.\n");
}
else {
    printf("\nERRORE: creazione tabella corso fallita.\n");
    exit();
}



$sqlCreate4 = "CREATE TABLE IF NOT EXISTS appello (
    codice char(3) primary key,
    data_appello datetime not null,
    scadenza datetime not null,
    id_corso int REFERENCES corso(id),
  
    unique(codice, data_appello)
);";

if($resultQ = mysqli_query($mysqliConnection, $sqlCreate4)) {
    //printf("\nCreazione tabella appello eseguita.\n");
}
else {
    printf("\nERRORE: creazione tabella appello fallita.\n");
    exit();
}



$sqlCreate5 = "CREATE TABLE IF NOT EXISTS prenotazione_appello (
    id_studente char(7) not null REFERENCES studente(matricola),
    id_appello char(3) not null REFERENCES appello(codice),
    data_prenotazione date not null,
  
    primary key(id_studente, id_appello)
);";

if($resultQ = mysqli_query($mysqliConnection, $sqlCreate5)) {
    //printf("\nCreazione tabella prenotazione_appello eseguita.\n");
}
else {
    printf("\nERRORE: creazione tabella prenotazione_appello fallita.\n");
    exit();
}



$sqlCreate6 = "CREATE TABLE IF NOT EXISTS iscrizione (
    id_studente char(7) not null REFERENCES studente(matricola),
    id_corso int not null REFERENCES corso(id),
    data_iscrizione date not null,
  
    primary key(id_studente, id_corso)
);";

if($resultQ = mysqli_query($mysqliConnection, $sqlCreate6)) {
    //printf("\nCreazione tabella iscrizione eseguita.\n");
}
else {
    printf("\nERRORE: creazione tabella iscrizione fallita.\n");
    exit();
}





//====================== INSERIMENTO DATI ===================================





$sqlInsert1 = "INSERT INTO colore VALUES
('red'),
('yellow'),
('blue'),
('pink'),
('gray'),
('lightgray'),
('lightpink'),
('lightblue'),
('orange'),
('green'),
('aqua'),
('lightgreen'),
('cyan'),
('lightcyan'),
('turquoise'),
('lightpurple');";

try {
    if($resultQ = mysqli_query($mysqliConnection, $sqlInsert1)) {
        //printf("\nPopolamento tabella colore effettuato con successo.\n");
    }
    else {
        printf("\nERRORE: popolamento tabella colore fallito.\n");
        exit();
    }
}
catch(mysqli_sql_exception $exception) {
}


$sqlInsert2 = "INSERT INTO corso (nome, descrizione, info_prof, id_colore) VALUES
('Basi di Dati', '', '', 'lightblue'),
('Linguaggi per il Web', '', '', 'lightpink'),
('Teoria dei Segnali', '', '', 'yellow'),
('Tecniche della Programmazione', '', '', 'lightcyan'),
('Analisi Matematica', '', '', 'red'),
('Elettronica', '', '', 'green'),
('Fondamenti di Automatica', '', '', 'orange'),
('Reti e Sistemi Operativi', '', '', 'lightpurple'),
('Progettazione del Software', '', '', 'turquoise'),
('Complementi di Ingegneria Gestionale', '', '', 'lightgray');";


try {
    if($resultQ = mysqli_query($mysqliConnection, $sqlInsert2)) {
        //printf("\nPopolamento tabella corso effettuato con successo.\n");
    }
    else {
        printf("\nERRORE: popolamento tabella corso fallito.\n");
        exit();
    }
}
catch(mysqli_sql_exception $exception) {
}




$sqlInsert3 = "INSERT INTO appello VALUES
('BD1', '2022-06-01 15:30:00', '2022-05-31 23:59:59', 1),
('BD2', '2022-07-20 15:30:00', '2022-07-19 23:59:59', 1),
('LW1', '2022-06-20 10:00:00', '2022-06-19 23:59:59', 2),
('LW2', '2022-07-22 10:00:00', '2022-07-21 23:59:59', 2),
('TS1', '2022-06-04 10:00:00', '2022-06-03 23:59:59', 3),
('TS2', '2022-07-01 10:00:00', '2022-06-30 23:59:59', 3),
('TP1', '2022-06-15 15:00:00', '2022-06-14 23:59:59', 4),
('TP2', '2022-07-17 15:00:00', '2022-07-16 23:59:59', 4),
('AM1', '2022-06-07 14:30:00', '2022-06-06 23:59:59', 5),
('AM2', '2022-07-09 14:30:00', '2022-07-08 23:59:59', 5),
('EL1', '2022-06-21 09:30:00', '2022-06-20 23:59:59', 6),
('EL2', '2022-07-27 09:30:00', '2022-07-26 23:59:59', 6),
('FA1', '2022-06-09 11:00:00', '2022-06-08 23:59:59', 7),
('FA2', '2022-07-07 11:00:00', '2022-07-06 23:59:59', 7),
('RS1', '2022-06-29 08:00:00', '2022-06-28 23:59:59', 8),
('RS2', '2022-07-01 08:00:00', '2022-06-30 23:59:59', 8),
('PS1', '2022-06-05 14:00:00', '2022-06-04 23:59:59', 9),
('PS2', '2022-07-13 14:00:00', '2022-07-12 23:59:59', 9),
('CG1', '2022-06-08 12:30:00', '2022-06-07 23:59:59', 10),
('CG2', '2022-07-08 12:30:00', '2022-07-07 23:59:59', 10);";


try {
    if($resultQ = mysqli_query($mysqliConnection, $sqlInsert3)) {
        //printf("\nPopolamento tabella appello effettuato con successo.\n");
    }
    else {
        printf("\nERRORE: popolamento tabella appello fallito.\n");
        exit();
    }
}
catch(mysqli_sql_exception $exception) {
}



// Chiusura connessione
mysqli_close($mysqliConnection);
?>
</body></html>
