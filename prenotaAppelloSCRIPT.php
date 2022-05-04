<?php
    ini_set('display_errors', 0);
    
    // Collegamento al db
    require_once("connection.php");
    
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

    //effettuiamo la prenotazione dell'appello selezionato
    $id_appello = $_GET['appello'];
    try {
        $query_prenota_appello = "INSERT INTO prenotazione_appello VALUES (\"{$_SESSION['matricola']}\", \"{$_GET['appello']}\", current_date())";

        if($mysqliConnection->query($query_prenota_appello) == TRUE) {
            ?>
                <?xml version="1.0" encoding="UTF-8"?>
                <!DOCTYPE html
                PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

                <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

                <head>
                    <title>Successo!</title>
                    <link rel="stylesheet" href="stile-base.css">
                </head>

                <body>
                <div class="header">
                    <div class="nav-left">
                        <div class="nav-logo">
                            <a href="homepage.php">
                                <img src="https://store-images.s-microsoft.com/image/apps.51215.9007199266623456.05e3a154-d5ac-49d8-af6e-ab2f789dc26d.f443b25b-1668-48aa-8137-f8e5609aee45?mode=scale&q=90&h=300&w=300" alt="logo" width="90px">
                            </a>
                        </div>
                        <div class="vertical-bar"></div>
                            <h2>
                                Infostud
                            </h2>
                    </div>
                    <div class="nav-central">
                        <form action="homepage.php" method="GET">
                            <div class="nav-logo">
                                <input type="submit" name="ricerca" value="">
                                <img src="search.png" alt="err" width="20px" style="display: inline-flex;">
                            </div>    
                                <input type="text" name="filtro">              
                        </form>
                    </div>
                    <div class="nav-right">
                        <img src="account.png" alt="dasdas" width="100px">
                    </div>
                </div>
                <div class="central-block">
                    <div class="sidebar">
                        <h5>
                            <a class="opzione" href="prenota-esame_scegli_corso.php">Prenota Esame</a>
                        </h5>
                        <h5>
                            <a class="opzione" href="iscriviti.php">Iscriviti a un corso</a>
                        </h5>
                        <h5>
                            <a class="opzione" href="cancellaIscrizione.php">Cancella iscrizione</a>
                        </h5>
                    </div>
                    <div class="body">
                        <div class="box-avviso">
                            <h1>Prenotazione avvenuta con successo!</h1>
                        </div>
                        <div style="text-align: center;">
                            <?php
                                session_start();
                                if(isset($_SESSION['matricola'])) {
                                    ?>
                                        <form action="homepage.php">
                                        <input class="bottoneHome" type="submit" name="invio" value="Torna alla home">
                                        </form>
                                    <?php
                                }
                                elseif(!isset($_SESSION['matricola'])) {
                                    ?>
                                    <form action="login.php">
                                        <input class="bottoneHome" type="submit" name="invio" value="Torna alla home">
                                    </form>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                </body>
                </html>
            <?php
        }
        else
            echo "Errore nella query di insert su prenotazione appello!";
    }
    catch(mysqli_sql_exception $e){
        echo "Exception nella query di insert su prenotazione appello!";
        printf($e);
    }
?>