<?php
if(isset($_POST['matricola']) && isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['pwd'])) {
    mysqli_report(MYSQLI_REPORT_ALL); // Per la gestione delle eccezioni dovute a molteplici insert successive ad ogni installazione del db

    // Collegamento al db
    include("connection.php");


    /* AGGIUNTA CRIPTAGGIO PASSWORD */
    /* Fonte: https://rosariociaglia.altervista.org/crittografia-e-decrittografia-con-php-come-criptare-e-decriptare-stringhe/ */


    $password = $_POST['pwd']; //password inviata dall'utente da un form con la classica variabile $_POST['password']
    $key_enc = '0274'; //chiave per la crittografia
    $met_enc = 'aes256'; //metodo per la crittografia: aes128, aes192, aes256, blowfish, cast-cbc
    $iv = 'ma1R0ikDD56_hG12'; //una stringa random con 16 caratteri

    //Crittografare la password
    $pass_enc = openssl_encrypt($password, $met_enc, $key_enc, 0, $iv);

    if(isset($_POST['invioReg']) && !($_POST['matricola'] == "" || $_POST['pwd'] == "" || $_POST['nome'] == "" || $_POST['cognome'] == "")) {
        $sqlInsert = "INSERT INTO studente VALUES
        ('{$_POST['matricola']}', '{$_POST['nome']}', '{$_POST['cognome']}', '{$pass_enc}');";
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
                            <a href=\"homepage.php\">
                                <img src=\"https://store-images.s-microsoft.com/image/apps.51215.9007199266623456.05e3a154-d5ac-49d8-af6e-ab2f789dc26d.f443b25b-1668-48aa-8137-f8e5609aee45?mode=scale&q=90&h=300&w=300\" alt=\"logo\" width=\"90px\">
                            </a>
                        </div>
                        <div class=\"vertical-bar\"></div>
                            <h2>
                                Infostud
                            </h2>
                    </div>
                    <div class=\"nav-right\">
                        <img src=\"https://w7.pngwing.com/pngs/73/580/png-transparent-arturia-business-logo-musical-instruments-individual-retirement-account-logo-business-sound.png\" alt=\"dasdas\" width=\"100px\">
                    </div>
                </div>
                <div class=\"central-block\">
                    <div class=\"scroll-root\">
                        <div class=\"scroll-area\"> 
                            <div class=\"body\">
                                <div class=\"box\">
                                    <h1>Inserimento avvenuto con successo!</h1>
                                </div>
                                <div>
                                    <input class=\"bottoneHome\" type=\"submit\" name=\"invio\" value=\"Torna alla home\">
                                </div>
                            </div>
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
                            <a href=\"homepage.php\">
                                <img src=\"https://store-images.s-microsoft.com/image/apps.51215.9007199266623456.05e3a154-d5ac-49d8-af6e-ab2f789dc26d.f443b25b-1668-48aa-8137-f8e5609aee45?mode=scale&q=90&h=300&w=300\" alt=\"logo\" width=\"90px\">
                            </a>
                        </div>
                        <div class=\"vertical-bar\"></div>
                            <h2>
                                Infostud
                            </h2>
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
                            <a href=\"homepage.php\">
                                <img src=\"https://store-images.s-microsoft.com/image/apps.51215.9007199266623456.05e3a154-d5ac-49d8-af6e-ab2f789dc26d.f443b25b-1668-48aa-8137-f8e5609aee45?mode=scale&q=90&h=300&w=300\" alt=\"logo\" width=\"90px\">
                            </a>
                        </div>
                        <div class=\"vertical-bar\"></div>
                            <h2>
                                Infostud
                            </h2>
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
    }
    // Chiusura connessione
    mysqli_close($mysqliConnection);
}
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Registrazione - Infostud</title>
    <link rel="stylesheet" href="stileLogin.css">
</head>

<body>


<div class="header">
    <div class="nav-left">
        <div class="nav-logo">
            <a href="homepage.php">
                <img src="https://store-images.s-microsoft.com/image/apps.51215.9007199266623456.05e3a154-d5ac-49d8-af6e-ab2f789dc26d.f443b25b-1668-48aa-8137-f8e5609aee45?mode=scale&q=90&h=300&w=300" alt="logo" style="width:90px;">
            </a>
        </div>
        <div class="vertical-bar"></div>
            <h2>
                Infostud
            </h2>
    </div>
    <div class="nav-right">
        <img src="account.png" alt="dasdas" style="width: 90px;">
    </div>
</div>
<div class="central-block"> 
    <DIV class="body">
        <h2 class="title">REGISTRATI</h2>   

            <form action="<?php $_SERVER['PHP_SELF']?>" method="post"> 
            <div class="boxRegistrazione">
                <h3>Matricola:</h3>
                <?php
                    if(isset($_POST['matricola'])) {
                        echo "<input class=\"textField\" type=\"text\" name=\"matricola\" value=\"{$_POST['matricola']}\">";
                    }
                    elseif(!isset($_POST['matricola'])) {
                        ?>
                        <input class="textField" type="text" name="matricola">
                        <?php
                    }
                ?>
                <h3>Nome:</h3>
                <?php
                    if(isset($_POST['nome'])) {
                        echo "<input class=\"textField\" type=\"text\" name=\"nome\" value=\"{$_POST['nome']}\">";
                    }
                    elseif(!isset($_POST['nome'])) {
                        ?>
                        <input class="textField" type="text" name="nome">
                        <?php
                    }
                ?>
                <h3>Cognome:</h3>
                <?php
                    if(isset($_POST['cognome'])) {
                        echo "<input class=\"textField\" type=\"text\" name=\"cognome\" value=\"{$_POST['cognome']}\">";
                    }
                    elseif(!isset($_POST['cognome'])) {
                        ?>
                        <input class="textField" type="text" name="cognome">
                        <?php
                    }
                ?>
                <h3>Password:</h3>
                <input class="textField" type="password" name="pwd">
            </div>
            <div>
                <input class="bottoni2" type="submit" name="invioReg" value="REGISTRATI">
            </div>
            </form>
            <?php
                if(isset($_POST['invioReg']) && ($_POST['matricola'] == "" || $_POST['pwd'] == "" || $_POST['nome'] == "" || $_POST['cognome'] == "")) {
                    echo "
                        <div class=\"box3\">
                            <h2 class=\"error\">DATI MANCANTI! Riprovare.</h2>
                        </div>
                    ";
                }
            ?>
    </div>
</div>

</body>
</html>