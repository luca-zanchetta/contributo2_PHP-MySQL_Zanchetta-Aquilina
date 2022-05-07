# CONTRIBUTO RAPPRESENTATIVO 2 (PHP - MySQL)

Contribuenti:
 1. Luca Zanchetta;
 2. Mattia Aquilina.

---

Indirizzo del repository: https://github.com/luca-zanchetta/contributo2_PHP-MySQL_Zanchetta-Aquilina

Indirizzo web del sito nel server lweb: 
 1. Luca Zanchetta: http://lweb.diag.uniroma1.it/~lweb44/BRIDGE/contributo2_PHP-MySQL_Zanchetta-Aquilina-main/
 2. Mattia Aquilina: 

Prima pagina visitabile: 
 1. Luca Zanchetta: http://lweb.diag.uniroma1.it/~lweb44/BRIDGE/contributo2_PHP-MySQL_Zanchetta-Aquilina-main/login.php
 2. Mattia Aquilina: 

---

# DESCRIZIONE DEL LAVORO SVOLTO

L'idea principale è stata quella di voler creare una variante, senza troppe pretese, del noto portale "Infostud" della Sapienza, che permette agli studenti di prenotarsi agli esami che poi andranno a sostenere. Uno studente, se registrato, può iscriversi ai vari corsi disponibili (ispirazione presa dal nuovo portale Google Classroom); di ogni corso, sono reperibili tutta una serie di informazioni, riguardanti ad esempio gli obiettivi di apprendimento della materia o il docente incaricato. In qualsiasi momento, ogni studente può decidere di cancellare la propria iscrizione ad un corso; ciò, naturalmente, impedirà allo studente stesso la possibilità di prenotare un appello relativo a quello stesso corso. Ogni studente che sia iscritto ad un corso può, per quello stesso corso, prenotare uno o più appelli, in relazione alla disponibilità di questi ultimi. Ogni appello sarà caratterizzato dalla data e dall'ora in cui verrà svolto l'esame, e da una data di scadenza, entro la quale lo studente deve necessariamente prenotarsi. In fase di visualizzazione degli appelli prenotabili, verranno mostrati allo studente solo gli appelli che abbiano scadenza in un momento futuro rispetto alla data e all'ora attuale di visualizzazione. Ogni studente ha inoltre diritto alla visualizzazione di tutti gli appelli prenotati, così come ha diritto alla visualizzazione di tutti i corsi a cui risulta iscritto/a; naturalmente, in fase di iscrizione ad altri corsi, verranno visualizzati solamente i corsi rimanenti a cui lo studente può iscriversi. Il discorso è valido anche per gli appelli. Uno studente che abbia prenotato un appello relativo ad un corso può cancellare la prenotazione del suddetto appello.


Il reale portale "Infostud" implementa anche la memorizzazione degli esami svolti, con relativa votazione, e permette di visualizzare la media aritmetica, la media ponderata e il numero di CFU ottenuti fino a quel momento. Per scelta, abbiamo deciso di evitare queste ultime funzionalità, poiché non sarebbero state un valore aggiunto a livello didattico per quanto riguarda la consegna del presente contributo.

---

Le caratteristiche di PHP (e interazione con il DBMS MySQL) che si sono volute testare (ed implementare) in questo contributo sono state, a grandi linee, le seguenti:

- registrazione, login e logout di un utente, con variabili di sessione (in particolare, per mantenere memoria della sessione attiva, viene utilizzata la matricola, dopo opportuna autenticazione con una password, in quanto caratteristica univoca per ogni studente);

- creazione e connessione ad un database grazie all'interazione con il dbms MySQL (in realtà MariaDB, disponibile con l'applicativo XAMPP; si tratta di una versione OpenSource di MySQL);

- creazione, popolamento e interrogazione di tabelle contenute in un database grazie all'interazione con il dbms MySQL (in realtà MariaDB, disponibile con l'applicativo XAMPP; si tratta di una versione OpenSource di MySQL);

- esecuzione di script PHP nei quali vengono manipolati dati forniti dai risultati di alcune query (punto precedente);

- esecuzione di script PHP con dati passati attraverso delle form, in entrambe le metodologie conosciute (GET e POST);

- esecuzione di script PHP con dati passati attraverso dei campi hidden, utilizzati in particolare nelle recall dello stesso script PHP;

- esecuzione di script PHP per la creazione di pagine web dinamiche, ossia il cui contenuto varia dinamicamente in base alle circostanze e agli eventi (si pensi, ad esempio, all'inserimento di una password errata in fase di login: comparirà un messaggio di errore nella pagina web).

---
