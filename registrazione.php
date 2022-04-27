<?php

mysqli_report(MYSQLI_REPORT_ALL); // Per la gestione delle eccezioni dovute a molteplici insert successive ad ogni installazione del db

$host = "localhost";
$mysql_user = "admin";
$mysql_pwd = "admin";
$db_name = "infostud";

// Connessione al server

$mysqliConnection = new mysqli($host, $mysql_user, $mysql_pwd, $db_name);
if (mysqli_connect_errno()) {
    printf("\nERRORE: Connessione al server non riuscita.\n%s\n", mysqli_connect_error());
    exit();
}

if(!isset($_POST['matricola']) || !isset($_POST['pwd']) || !isset($_POST['nome']) || !isset($_POST['cognome'])) {
    printf("\nERRORE: problema nell'inserimento dei dati.\n");
    header("login.php");
}
elseif($_POST['matricola'] == "" || $_POST['pwd'] == "" || $_POST['nome'] == "" || $_POST['cognome'] == "") {
    printf("\nERRORE: dati mancanti.\n");
    header("login.php");
}



$sqlInsert = "INSERT INTO studente VALUES
('{$_POST['matricola']}', '{$_POST['nome']}', '{$_POST['cognome']', '{$_POST['pwd']');";
try {
    if($resultQ = mysqli_query($mysqliConnection, $sqlInsert)) {
        echo "
        <?xml version=\"1.0\" encoding=\"UTF-8\"?>
        <!DOCTYPE html
        PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

        <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">

        <head>
            <title>Successo!</title>
            <link rel=\"stylesheet\" href=\"stileLogin.css\">
        </head>

        <body>
        <form action=\"login.php\">
        <div class=\"header\">
            <div class=\"nav-left\">
                <div class=\"nav-logo\">
                    <img src=\"https://store-images.s-microsoft.com/image/apps.51215.9007199266623456.05e3a154-d5ac-49d8-af6e-ab2f789dc26d.f443b25b-1668-48aa-8137-f8e5609aee45?mode=scale&q=90&h=300&w=300\" alt=\"logo\" width=\"100px\">
                </div>
                <div class=\"vertical-bar\"></div>
                    <h2>
                        Infostud
                    </h2>
            </div>
            <div class=\"nav-central\">
                <input type=\"text\" name=\"riceca\" id=\"\">
            </div>
            <div class=\"nav-right\">
                <img src=\"https://w7.pngwing.com/pngs/73/580/png-transparent-arturia-business-logo-musical-instruments-individual-retirement-account-logo-business-sound.png\" alt=\"dasdas\" width=\"100px\">
            </div>
        </div>
        <div class=\"central-block\">
            <div class=\"body\">
                <div class=\"box\">
                    <h1>Inserimento avvenuto con successo!</h1>
                </div>
                <div>
                    <input class=\"bottoneHome\" type=\"submit\" name=\"invio\" value=\"Torna alla home\">
                </div>
            </div>
        </div>

        </form>
        </body>
        </html>
        ";
    }
    else {
        echo "
        <?xml version=\"1.0\" encoding=\"UTF-8\"?>
        <!DOCTYPE html
        PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

        <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">

        <head>
            <title>ERRORE :(</title>
            <link rel=\"stylesheet\" href=\"stileLogin.css\">
        </head>

        <body>
        <form action=\"login.php\">
        <div class=\"header\">
            <div class=\"nav-left\">
                <div class=\"nav-logo\">
                    <img src=\"https://store-images.s-microsoft.com/image/apps.51215.9007199266623456.05e3a154-d5ac-49d8-af6e-ab2f789dc26d.f443b25b-1668-48aa-8137-f8e5609aee45?mode=scale&q=90&h=300&w=300\" alt=\"logo\" width=\"100px\">
                </div>
                <div class=\"vertical-bar\"></div>
                    <h2>
                        Infostud
                    </h2>
            </div>
            <div class=\"nav-central\">
                <input type=\"text\" name=\"riceca\" id=\"\">
            </div>
            <div class=\"nav-right\">
                <img src=\"https://w7.pngwing.com/pngs/73/580/png-transparent-arturia-business-logo-musical-instruments-individual-retirement-account-logo-business-sound.png\" alt=\"dasdas\" width=\"100px\">
            </div>
        </div>
        <div class=\"central-block\">
            <div class=\"body\">
                <div class=\"box\">
                    <h1>ERRORE: Inserimento fallito.</h1>
                </div>
                <div>
                    <input class=\"bottoneHome\" type=\"submit\" name=\"invio\" value=\"Torna alla home\">
                </div>
            </div>
        </div>

        </form>
        </body>
        </html>
        ";
    }
}
catch(mysqli_sql_exception $exception) {
    echo "
        <?xml version=\"1.0\" encoding=\"UTF-8\"?>
        <!DOCTYPE html
        PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

        <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">

        <head>
            <title>ERRORE :(</title>
            <link rel=\"stylesheet\" href=\"stileLogin.css\">
        </head>

        <body>
        <form action=\"login.php\">
        <div class=\"header\">
            <div class=\"nav-left\">
                <div class=\"nav-logo\">
                    <img src=\"https://store-images.s-microsoft.com/image/apps.51215.9007199266623456.05e3a154-d5ac-49d8-af6e-ab2f789dc26d.f443b25b-1668-48aa-8137-f8e5609aee45?mode=scale&q=90&h=300&w=300\" alt=\"logo\" width=\"100px\">
                </div>
                <div class=\"vertical-bar\"></div>
                    <h2>
                        Infostud
                    </h2>
            </div>
            <div class=\"nav-central\">
                <input type=\"text\" name=\"riceca\" id=\"\">
            </div>
            <div class=\"nav-right\">
                <img src=\"https://w7.pngwing.com/pngs/73/580/png-transparent-arturia-business-logo-musical-instruments-individual-retirement-account-logo-business-sound.png\" alt=\"dasdas\" width=\"100px\">
            </div>
        </div>
        <div class=\"central-block\">
            <div class=\"body\">
                <div class=\"box\">
                    <h1>ERRORE: Studente gi&agrave; presente nel db.</h1>
                </div>
                <div>
                    <input class=\"bottoneHome\" type=\"submit\" name=\"invio\" value=\"Torna alla home\">
                </div>
            </div>
        </div>

        </form>
        </body>
        </html>
        ";
}

// Chiusura connessione
mysqli_close($mysqliConnection);
?>