<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head></head>

<body>

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

    //modifica del db
    $alterTbl = "ALTER TABLE corso 
    ADD anno varchar(10), 
    ADD curriculum varchar(30), 
    ADD semestre varchar(10), 
    ADD cfu SMALLINT, 
    ADD ssd varchar(15);";

    if($resultQ = mysqli_query($mysqliConnection, $alterTbl)) {
        //printf("\nCreazione tabella studente eseguita.\n");
    }
    else {
        printf("\nERRORE: creazione tabella studente fallita.\n");
        exit();
    }
    //inserimenti
    //basi e rsort
    $update = "UPDATE corso
    set anno='terzo', curriculum='informatica', semestre='primo',cfu=9,ssd='ING-INF',info_prof='Umberto Nanni'
    ,descrizione='Il corso si propone di insegnare 1. aspetti teorici, consistenti in modelli e linguaggi di basi di dati, 2. metodologie di progetto, che consentiranno allo studente, una volta che siano acquisite, di affrontare e risolvere casi concreti, 3. tecnologie, consistenti in diversi strumenti software usati in modo combinato per la implementazione delle basi di dati, scegliendo strumenti diffusi nelle pratiche aziendali.
    Alla fine del corso lo studente sarà in grado di interagire con il destinatario di un’applicazione di basi di dati in modo da sintetizzare correttamente i requisiti e di sviluppare prima il progetto, poi l’applicazione stessa, scegliendo gli strumenti più idonei.'
    where id=1 or id=8;";

    if($resultQ = mysqli_query($mysqliConnection, $update)) {
        //printf("\nCreazione tabella studente eseguita.\n");
    }
    else {
        printf("\nERRORE: creazione tabella studente fallita.\n");
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

    if($resultQ = mysqli_query($mysqliConnection, $update)) {
        //printf("\nCreazione tabella studente eseguita.\n");
    }
    else {
        printf("\nERRORE: creazione tabella studente fallita.\n");
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

    if($resultQ = mysqli_query($mysqliConnection, $update)) {
        //printf("\nCreazione tabella studente eseguita.\n");
    }
    else {
        printf("\nERRORE: creazione tabella studente fallita.\n");
        exit();
    }
    //tdp
    $update = "UPDATE corso
    set anno='primo', curriculum='informatica', semestre='secondo',cfu=9,ssd='ING-INF/05',info_prof='Marco Temperini',descrizione='Conoscenza elementare dell\'architettura e organizzazione dell\'elaboratore. Sviluppo della capacita\' di definire algoritmi per la risoluzione di problemi. Acquisizione di conoscenze fondamentali sulla programmazione, con il C come linguaggio di riferimento.
    Familiarizzazione con la definizione e uso di strutture dati elementari (quali gli array) e meno elementari (come tabelle, liste collegate ed alberi binari).
    Sviluppo della capacita\' di applicare le conoscenze menzionate sopra, nella soluzione di problemi di media complessita\', implicanti la selezione e definizione di algoritmi e la programmazione di sistemi software di piccola-media dimensione.'
    where id=4;";

    if($resultQ = mysqli_query($mysqliConnection, $update)) {
        //printf("\nCreazione tabella studente eseguita.\n");
    }
    else {
        printf("\nERRORE: creazione tabella studente fallita.\n");
        exit();
    }
    //analisi
    $update = "UPDATE corso
    set anno='primo', curriculum='informatica', semestre='primo',cfu=9,ssd='MAT/05',info_prof='Alberto Maria Bersani',descrizione='Lo scopo di questo corso è quello di approfondire la comprensione delle idee e delle tecniche di calcolo integrale e calcolo differenziale per funzioni di una variabile. Queste idee e tecniche sono fondamentali per la comprensione degli altri corsi di analisi, di calcolo delle probabilità, della meccanica, della fisica e di molti altri settori della matematica pura e applicata. L\'enfasi è sulla comprensione di concetti fondamentali, sul ragionamento logico, sulla comprensione del testo e sull\'acquisizione di capacità di risolvere problemi concreti.'
    where id=5;";

    if($resultQ = mysqli_query($mysqliConnection, $update)) {
        //printf("\nCreazione tabella studente eseguita.\n");
    }
    else {
        printf("\nERRORE: creazione tabella studente fallita.\n");
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

    if($resultQ = mysqli_query($mysqliConnection, $update)) {
        //printf("\nCreazione tabella studente eseguita.\n");
    }
    else {
        printf("\nERRORE: creazione tabella studente fallita.\n");
        exit();
    }
    //FDA
    $update = "UPDATE corso
    set anno='secondo', curriculum='elettronica', semestre='secondo',cfu=9,ssd='ING-INF/04',info_prof='Paolo di Gianberardino',descrizione='Scopo del corso è introdurre ai concetti di modellistica e ai principali metodi di studio dei sistemi dinamici orientati, con particolare riferimento alla classe dei sistemi lineari e stazionari, a tempo continuo e a tempo discreto, nonché illustrare le principali tecniche di sintesi di sistemi di controllo lineari per sistemi dinamici aventi modello lineare o linearizzabile mediante approssimazione. Le tecniche introdotte si riferiscono sia a sintesi di controllori continui, implementabili mediante semplici architetture elettroniche o elettro-meccaniche, che a controllori numerici ottenuti per via indiretta, ossia mediante approssimazione discreta di controllori continui, e per via diretta, a partire dalla rappresentazione esatta del sistema campionato.
    Gli studenti, al superamento dell\'esame, avranno acquisito sufficienti conoscenze per quanto concerne la modellistica di sistemi fisici da diversi settori disciplinari (elettrico, meccanico, elettronico, economico, ambientale, gestionale, ecc.), con particolare riferimento ai casi lineari e alla approssimazione lineare di sistemi non lineari, la loro analisi dinamica, con caratterizzazione delle evoluzioni libere e forzate, le relazioni ingresso-uscita e i tipi di comportamento, le proprietà strutturali per l\'analisi delle relazioni ingresso-stato-uscita, la stabilità . Essi saranno in grado di ricavare il modello matematico di sistemi fisici da diversi settori disciplinari (elettrico, meccanico, elettronico, economico, ambientale, gestionale, ecc.) nella rappresentazione con lo spazio di stato o come relazione ingresso-uscita; saranno in grado di analizzarne le caratteristiche dinamiche, determinandone il comportamento in funzione degli ingressi e delle condizioni iniziali; sapranno studiarne la stabilità; potranno essere in grado di ricavare informazioni sul comportamento del sistema, effettuare previsioni, identificare parametri, migliorando la conoscenza del sistema modellato. Conosceranno le principali tecniche di sintesi di sistemi di controllo lineari, a tempo continuo e a tempo discreto e sapranno scegliere, in funzione del problema dato, delle informazioni disponibili e delle specifiche poste, la migliore tecnica che consente di giungere alla soluzione più efficiente. Saranno inoltre in grado di predisporre lo schema a blocchi del sistema controllato individuando le grandezze da misurare. In alcuni casi sapranno fare riferimento a schemi realizzativi, analogici o digitali, di implementazione. Essi, inoltre, saranno in grado di: analizzare le specifiche per un sistema di controllo; definire lo schema del controllore, dalla misura all\'azione di controllo; progettare un controllore, secondo la procedura più opportuna in funzione dell\'oggetto e degli obiettivi; scegliere il dominio del tempo più opportuno per una più semplice ed efficace implementazione; effettuare delle simulazioni numeriche per verificare la rispondenza ai requisiti; individuare i dispositivi che possono realizzare il controllore sintetizzato.'
    where id=7;";

    if($resultQ = mysqli_query($mysqliConnection, $update)) {
        //printf("\nCreazione tabella studente eseguita.\n");
    }
    else {
        printf("\nERRORE: creazione tabella studente fallita.\n");
        exit();
    }
    //PDS
    $update = "UPDATE corso
    set anno='secondo', curriculum='informatica', semestre='primo',cfu=9,ssd='ING-INF/05',info_prof='Irene Amerini',descrizione='L\'obiettivo del corso è lo studio e l\'approfondimento degli aspetti fondamentali relativi alla progettazione del software quali la qualità del software; il concetto di modulo e la modularizzazione; la distinzione tra analisi, progetto e realizzazione di applicazioni; la nozione di specifica; ecc. Gli argomenti sono trattati dando enfasi ad aspetti metodologici e ad aspetti sperimentali utilizzando il linguaggio UML per la fase di analisi, e Java per la fase di realizzazione. L’introduzione ad ogni fase del processo di progettazione e realizzazione del software sarà seguita da esercitazioni guidate atte ad applicare in pratica quanto appreso.
    Al termine del corso lo studente avrà acquisito: le competenze di base per lo sviluppo di progetti software anche complessi, familiarità con i principi di base della programmazione orientata agli oggetti, conoscenza del linguaggio Java e di avanzati ambienti di sviluppo.'
    where id=9;";

    if($resultQ = mysqli_query($mysqliConnection, $update)) {
        //printf("\nCreazione tabella studente eseguita.\n");
    }
    else {
        printf("\nERRORE: creazione tabella studente fallita.\n");
        exit();
    }
    //complementi...
    $update = "UPDATE corso
    set anno='terzo', curriculum='informatica-gestionale', semestre='secondo',cfu=6,ssd='ING-IND/35',info_prof='Fulvio Schettino',descrizione='Il corso presenta una panoramica introduttiva della gestione aziendale analizzando i rapporti tra problemi e decisioni delle diverse aree funzionali dell\'impresa (ricerca e sviluppo, progettazione, marketing e vendite, produzione e logistica, gestione delle risorse umane, tecnologiche, informative e finanziarie) e i modi in cui i processi di pianificazione (formulazione di strategie per le unità di business e le funzioni, budgeting, gestione dei processi e delle attività operative) riconducono ad una sintesi coerente con gli obiettivi aziendali i punti di vista che emergono in queste aree.
    Lo studente deve acquisire capacità di analisi qualitativa degli effetti della dotazione di risorse e competenze e della collocazione nel mercato sulla capacità di competere. Deve inoltre essere in grado di utilizzare quantitativamente metodologie e strumenti tipici del budgeting e delle scelte operative.'
    where id=10;";

    if($resultQ = mysqli_query($mysqliConnection, $update)) {
        //printf("\nCreazione tabella studente eseguita.\n");
    }
    else {
        printf("\nERRORE: creazione tabella studente fallita.\n");
        exit();
    }
    mysqli_close($mysqliConnection);
?>
</body></html>