<?php

mysqli_report(MYSQLI_REPORT_ALL); // Per la gestione delle eccezioni dovute a molteplici insert successive ad ogni installazione del db


// Collegamento al db
#Da completare con il proprio numero
$host = "lweb3";
$mysql_user = "lweb3";
$mysql_pwd = "lweb3";
$db_name = "lweb3";
        
        
$mysqliConnection = new mysqli($host, $mysql_user, $mysql_pwd, $db_name);
if (mysqli_errno($mysqliConnection)) {
    printf("\nERRORE: Connessione al db non riuscita.\n%s\n", mysqli_error($mysqliConnection));
    exit();
}



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


/* EX FILE update-db.php */


// Collegamento al db
include("connection.php");

//modifica del db
$alterTbl = "ALTER TABLE corso 
ADD anno varchar(10), 
ADD curriculum varchar(30), 
ADD semestre varchar(10), 
ADD cfu SMALLINT, 
ADD ssd varchar(15);";

try {
    if(!$resultQ = mysqli_query($mysqliConnection, $alterTbl)) {
        printf("\nERRORE: alterazione tabella corso fallita.\n");
        exit();
    }
}
catch(mysqli_sql_exception $e) {
}


//inserimenti
//basi
$update = "UPDATE corso
set anno='terzo', curriculum='informatica', semestre='primo',cfu=9,ssd='ING-INF',info_prof='Umberto Nanni'
,descrizione='Il corso si propone di insegnare 1. aspetti teorici, consistenti in modelli e linguaggi di basi di dati, 2. metodologie di progetto, che consentiranno allo studente, una volta che siano acquisite, di affrontare e risolvere casi concreti, 3. tecnologie, consistenti in diversi strumenti software usati in modo combinato per la implementazione delle basi di dati, scegliendo strumenti diffusi nelle pratiche aziendali.
Alla fine del corso lo studente sarà in grado di interagire con il destinatario di un’applicazione di basi di dati in modo da sintetizzare correttamente i requisiti e di sviluppare prima il progetto, poi l’applicazione stessa, scegliendo gli strumenti più idonei.'
where id=1;";

if(!$resultQ = mysqli_query($mysqliConnection, $update)) {
    printf("\nERRORE: aggiornamento tabella corso fallito (Basi di dati).\n");
    exit();
}

//RSO
$update = "UPDATE corso
set anno='terzo', curriculum='informatica', semestre='primo',cfu=9,ssd='ING-INF',info_prof='Christian Napoli'
,descrizione='Il corso si propone di fornire le conoscenze essenziali per comprendere il funzionamento di un sistema operativo e quindi alla possiblità di sfruttare e controllare il sottostante sistema di elaborazione in diversi contesti. Vengono inoltre analizzati la programmazione concorrente e la elaborazione in rete, sia come requisito, sia come opportunità per il conseguimento di elevate prestazioni.
Alla fine del corso lo studente sarà in grado di utilizzare in modo consapevole il sistema di elaborazione, sfruttando al meglio le risorse a sua disposizione, sapendo individuare ed eventualmente risolvere i colli di bottiglia che limitano le prestazioni.'
where id=8;";

if(!$resultQ = mysqli_query($mysqliConnection, $update)) {
    printf("\nERRORE: aggiornamento tabella corso fallito (Basi di dati).\n");
    exit();
}

//lwb
$update = "UPDATE corso
set anno='terzo', curriculum='informatica', semestre='secondo',cfu=6,ssd='ING-INF',info_prof='Marco Temperini'
,descrizione='Acquisizione di nozioni fondamentali su
    - presentazione di risorse web,
    - sviluppo di applicazioni web, mediante opportune tecniche e linguaggi di programmazione;
    - rappresentazione e gestione dei dati rilevanti per un\'applicazione web, mediante basi di dati e tecnologia XML
    Messa in pratica delle nozioni sopraelencate, mediante lo svolgimento di una tesina, orientata alla progettazione ed implementazione di una non banale applicazione web.'
where id=2;";

if(!$resultQ = mysqli_query($mysqliConnection, $update)) {
    printf("\nERRORE: aggiornamento tabella corso fallito (Linguaggi per il Web).\n");
    exit();
}

//tds 
$update = "UPDATE corso
set anno='secondo', curriculum='elettronica', semestre='secondo',cfu=12,ssd='ING-INF/03',info_prof='Paolo di Lorenzo'
,descrizione='generali - Il corso di teoria dei segnali intende fornire al discente le basi del calcolo delle
    probabilità e dell’analisi frequenziale di segnali certi e aleatori, assieme alle sue pratiche
    applicazioni nel contesto del filtraggio, della trasmissione numerica e delle tecniche di
    modulazione analogica.
    specifici - Nello specifico, a seguito del superamento della prova di esame il discente avrà
    acquisito la conoscenza e la comprensione degli aspetti riportati nella parte generale,
    - ivi compresa la loro applicazione ai contesti realizzativi di un sistema di telecomunicazione.
    - Il discente avrà dunque acquisito le competenze necessarie all’analisi frequenziale di
    segnali certi ed aleatori, ed alla loro applicazione nell’ambito delle tecniche di trasmissione
    numerica in banda base e di quelle di modulazione analogica, divenendo in grado di valutare
    la qualità di un sistema di telecomunicazione nei termini del relativo rapporto segnale
    rumore, e dei possibili peggioramenti introdotti dai dispositivi utilizzati e dal mezzo
    trasmissivo adottato.
    - Il superamento della prova di esame attesta il conseguimento da parte del discente di
    capacità critiche e di giudizio a riguardo delle prestazioni di un sistema di
    telecomunicazione, e lo svolgimento dell’elaborato di esame permette di valutare le sue
    capacità di comunicare quanto appreso.
    - Essendo un corso del secondo anno, si avvale delle competenze acquisite nel contesto
    degli insegnamenti di base precedentemente impartiti, innestando su questi una nuova una
    base comune di competenze di cui gli insegnamenti successivi possono trarre vantaggio.
    Per questo motivo si ritiene adeguato il contributo dato dal corso alla capacità del discente di
    proseguire lo studio in modo autonomo.'
where id=3;";

if(!$resultQ = mysqli_query($mysqliConnection, $update)) {
    printf("\nERRORE: aggiornamento tabella corso fallito (Teoria dei Segnali).\n");
    exit();
}

//tdp
$update = "UPDATE corso
set anno='primo', curriculum='informatica', semestre='secondo',cfu=9,ssd='ING-INF/05',info_prof='Marco Temperini',descrizione='Conoscenza elementare dell\'architettura e organizzazione dell\'elaboratore. Sviluppo della capacita\' di definire algoritmi per la risoluzione di problemi. Acquisizione di conoscenze fondamentali sulla programmazione, con il C come linguaggio di riferimento.
Familiarizzazione con la definizione e uso di strutture dati elementari (quali gli array) e meno elementari (come tabelle, liste collegate ed alberi binari).
Sviluppo della capacita\' di applicare le conoscenze menzionate sopra, nella soluzione di problemi di media complessita\', implicanti la selezione e definizione di algoritmi e la programmazione di sistemi software di piccola-media dimensione.'
where id=4;";

if(!$resultQ = mysqli_query($mysqliConnection, $update)) {
    printf("\nERRORE: aggiornamento tabella corso fallito (Tecniche della Programmazione).\n");
    exit();
}

//analisi
$update = "UPDATE corso
set anno='primo', curriculum='informatica', semestre='primo',cfu=9,ssd='MAT/05',info_prof='Alberto Maria Bersani',descrizione='Lo scopo di questo corso è quello di approfondire la comprensione delle idee e delle tecniche di calcolo integrale e calcolo differenziale per funzioni di una variabile. Queste idee e tecniche sono fondamentali per la comprensione degli altri corsi di analisi, di calcolo delle probabilità, della meccanica, della fisica e di molti altri settori della matematica pura e applicata. L\'enfasi è sulla comprensione di concetti fondamentali, sul ragionamento logico, sulla comprensione del testo e sull\'acquisizione di capacità di risolvere problemi concreti.'
where id=5;";

if(!$resultQ = mysqli_query($mysqliConnection, $update)) {
    printf("\nERRORE: aggiornamento tabella corso fallito (Analisi Matematica).\n");
    exit();
}

//elettronica
$update = "UPDATE corso
set anno='secondo', curriculum='elettronica', semestre='secondo',cfu=9,ssd='ING-INF/01',info_prof='Giuseppe Scotti',descrizione='Il corso intende fornire le conoscenze generali di un sistema elettronico inteso come
    sistema di elaborazione di informazioni. Per i circuiti analogici l’attenzione viene posta sul concetto di guadagno per
    i vari tipi di amplificatori, e sui limiti applicativi dovuti a banda passante, potenza e rumore. Per i circuiti digitali ci si
    concentra sulle porte logiche fondamentali e sulle caratteristiche di robustezza, velocità di elaborazione e consumo
    di potenza.
    Capacità applicative. Gli studenti saranno in grado di analizzare sistemi elettronici semplici e di individuarne il
    comportamento anche in presenza di elementi capacitivi. Saranno inoltre capaci di analizzare i blocchi costitutivi di
    circuiti analogici integrati. Per quanto riguarda i sistemi digitali, gli studenti avranno gli elementi base per
    progettare semplici sistemi digitali a vari livelli di astrazione (gate e circuito) e per identificare la tecnologia
    implementativa più adatta al caso di progetto specifico
    ABILITÀ DI COMUNICAZIONE. L’esame orale verifica lo sviluppo delle abilità comunicative e organizzative.
    CAPACITÀ DI APPRENDERE. La prova scritta verifica la capacità degli studenti di estrarre dai testi di riferimento le
    informazioni necessarie a svolgere un particolare problema di analisi o progetto di circuiti elettronici.'
where id=6;";

if(!$resultQ = mysqli_query($mysqliConnection, $update)) {
    printf("\nERRORE: aggiornamento tabella corso fallito (Elettronica).\n");
    exit();
}

//FDA
$update = "UPDATE corso
set anno='secondo', curriculum='elettronica', semestre='secondo',cfu=9,ssd='ING-INF/04',info_prof='Paolo di Gianberardino',descrizione='Scopo del corso è introdurre ai concetti di modellistica e ai principali metodi di studio dei sistemi dinamici orientati, con particolare riferimento alla classe dei sistemi lineari e stazionari, a tempo continuo e a tempo discreto, nonché illustrare le principali tecniche di sintesi di sistemi di controllo lineari per sistemi dinamici aventi modello lineare o linearizzabile mediante approssimazione. Le tecniche introdotte si riferiscono sia a sintesi di controllori continui, implementabili mediante semplici architetture elettroniche o elettro-meccaniche, che a controllori numerici ottenuti per via indiretta, ossia mediante approssimazione discreta di controllori continui, e per via diretta, a partire dalla rappresentazione esatta del sistema campionato.
Gli studenti, al superamento dell\'esame, avranno acquisito sufficienti conoscenze per quanto concerne la modellistica di sistemi fisici da diversi settori disciplinari (elettrico, meccanico, elettronico, economico, ambientale, gestionale, ecc.), con particolare riferimento ai casi lineari e alla approssimazione lineare di sistemi non lineari, la loro analisi dinamica, con caratterizzazione delle evoluzioni libere e forzate, le relazioni ingresso-uscita e i tipi di comportamento, le proprietà strutturali per l\'analisi delle relazioni ingresso-stato-uscita, la stabilità . Essi saranno in grado di ricavare il modello matematico di sistemi fisici da diversi settori disciplinari (elettrico, meccanico, elettronico, economico, ambientale, gestionale, ecc.) nella rappresentazione con lo spazio di stato o come relazione ingresso-uscita; saranno in grado di analizzarne le caratteristiche dinamiche, determinandone il comportamento in funzione degli ingressi e delle condizioni iniziali; sapranno studiarne la stabilità; potranno essere in grado di ricavare informazioni sul comportamento del sistema, effettuare previsioni, identificare parametri, migliorando la conoscenza del sistema modellato. Conosceranno le principali tecniche di sintesi di sistemi di controllo lineari, a tempo continuo e a tempo discreto e sapranno scegliere, in funzione del problema dato, delle informazioni disponibili e delle specifiche poste, la migliore tecnica che consente di giungere alla soluzione più efficiente. Saranno inoltre in grado di predisporre lo schema a blocchi del sistema controllato individuando le grandezze da misurare. In alcuni casi sapranno fare riferimento a schemi realizzativi, analogici o digitali, di implementazione. Essi, inoltre, saranno in grado di: analizzare le specifiche per un sistema di controllo; definire lo schema del controllore, dalla misura all\'azione di controllo; progettare un controllore, secondo la procedura più opportuna in funzione dell\'oggetto e degli obiettivi; scegliere il dominio del tempo più opportuno per una più semplice ed efficace implementazione; effettuare delle simulazioni numeriche per verificare la rispondenza ai requisiti; individuare i dispositivi che possono realizzare il controllore sintetizzato.'
where id=7;";

if(!$resultQ = mysqli_query($mysqliConnection, $update)) {
    printf("\nERRORE: aggiornamento tabella corso fallito (Fondamenti di Automatica).\n");
    exit();
}

//PDS
$update = "UPDATE corso
set anno='secondo', curriculum='informatica', semestre='primo',cfu=9,ssd='ING-INF/05',info_prof='Irene Amerini',descrizione='L\'obiettivo del corso è lo studio e l\'approfondimento degli aspetti fondamentali relativi alla progettazione del software quali la qualità del software; il concetto di modulo e la modularizzazione; la distinzione tra analisi, progetto e realizzazione di applicazioni; la nozione di specifica; ecc. Gli argomenti sono trattati dando enfasi ad aspetti metodologici e ad aspetti sperimentali utilizzando il linguaggio UML per la fase di analisi, e Java per la fase di realizzazione. L’introduzione ad ogni fase del processo di progettazione e realizzazione del software sarà seguita da esercitazioni guidate atte ad applicare in pratica quanto appreso.
Al termine del corso lo studente avrà acquisito: le competenze di base per lo sviluppo di progetti software anche complessi, familiarità con i principi di base della programmazione orientata agli oggetti, conoscenza del linguaggio Java e di avanzati ambienti di sviluppo.'
where id=9;";

if(!$resultQ = mysqli_query($mysqliConnection, $update)) {
    printf("\nERRORE: aggiornamento tabella corso fallito (Progettazione del Software).\n");
    exit();
}

//CIG
$update = "UPDATE corso
set anno='terzo', curriculum='informatica-gestionale', semestre='secondo',cfu=6,ssd='ING-IND/35',info_prof='Fulvio Schettino',descrizione='Il corso presenta una panoramica introduttiva della gestione aziendale analizzando i rapporti tra problemi e decisioni delle diverse aree funzionali dell\'impresa (ricerca e sviluppo, progettazione, marketing e vendite, produzione e logistica, gestione delle risorse umane, tecnologiche, informative e finanziarie) e i modi in cui i processi di pianificazione (formulazione di strategie per le unità di business e le funzioni, budgeting, gestione dei processi e delle attività operative) riconducono ad una sintesi coerente con gli obiettivi aziendali i punti di vista che emergono in queste aree.
Lo studente deve acquisire capacità di analisi qualitativa degli effetti della dotazione di risorse e competenze e della collocazione nel mercato sulla capacità di competere. Deve inoltre essere in grado di utilizzare quantitativamente metodologie e strumenti tipici del budgeting e delle scelte operative.'
where id=10;";

if(!$resultQ = mysqli_query($mysqliConnection, $update)) {
    printf("\nERRORE: aggiornamento tabella corso fallito (Complementi di Ingegneria Gestionale).\n");
    exit();
}

mysqli_close($mysqliConnection);
?>