<?php
require_once("install.php");
ini_set('display_errors', 0);

if(isset($_POST['invio']) && !($_POST['matricola'] == "" || $_POST['password'] == "")) {
    $host = "localhost";
    $mysql_user = "admin";
    $mysql_pwd = "admin";
    $db_name = "infostud";

    $mysqliConnection = new mysqli($host, $mysql_user, $mysql_pwd, $db_name);
    if (mysqli_connect_errno()) {
        printf("\nERRORE: Connessione al server non riuscita.\n%s\n", mysqli_connect_error());
        exit();
    }

    /* VERIFICA LOGIN */

    $sql_get_password = "SELECT password
    FROM studente
    WHERE matricola = \"{$_POST['matricola']}\"
    ";
    if(!$resultQ = mysqli_query($mysqliConnection, $sql_get_password)) {
        printf("\nERRORE: La query di recupero password non funziona correttamente.\n");
        exit();
    }
    $pass_enc = mysqli_fetch_array($resultQ); // Password criptata

    /* Fonte: https://rosariociaglia.altervista.org/crittografia-e-decrittografia-con-php-come-criptare-e-decriptare-stringhe/ */
    
    $password = $_POST['password']; //password inviata dall'utente da un form con la classica variabile $_POST['password']
    $key_enc = '0274'; //chiave per la crittografia
    $met_enc = 'aes256'; //metodo per la crittografia: aes128, aes192, aes256, blowfish, cast-cbc
    $iv = 'ma1R0ikDD56_hG12'; //una stringa random con 16 caratteri

    //Crittografare la password
    $pass_enc = openssl_encrypt($password, $met_enc, $key_enc, 0, $iv);

    $sql_get_students = "SELECT * 
    FROM studente 
    WHERE matricola = \"{$_POST['matricola']}\" 
    AND password = \"{$pass_enc}\"
    ";
    if(!$resultQ = mysqli_query($mysqliConnection, $sql_get_students)) {
        printf("\nERRORE: La query di controllo login non funziona correttamente.\n");
        exit();
    }


    $utente = mysqli_fetch_array($resultQ);
    if($utente) { /* Login avvenuto correttamente */
        session_start();
        $_SESSION['matricola'] = $_POST['matricola'];
        header('Location: homepage.php');
        exit();
    }
    elseif(!$utente) { /* Qualcosa è andato storto */
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
            <div class=\"nav-right\">
                <img src=\"https://w7.pngwing.com/pngs/73/580/png-transparent-arturia-business-logo-musical-instruments-individual-retirement-account-logo-business-sound.png\" alt=\"dasdas\" width=\"100px\">
            </div>
        </div>
        <div class=\"central-block\">
            <div class=\"body\">
                <div class=\"box\">
                    <h1>ERRORE: Studente NON registrato.</h1>
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

?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Login - Infostud</title>
    
    <link rel="stylesheet" href="stileLogin.css">
</head>

<body>


<div class="header">
    <div class="nav-left">
        <div class="nav-logo">
            <img src="https://store-images.s-microsoft.com/image/apps.51215.9007199266623456.05e3a154-d5ac-49d8-af6e-ab2f789dc26d.f443b25b-1668-48aa-8137-f8e5609aee45?mode=scale&q=90&h=300&w=300" alt="logo" width="100px">
        </div>
        <div class="vertical-bar"></div>
            <h2>
                Infostud
            </h2>
    </div>
    <div class="nav-right">
        <img src="https://w7.pngwing.com/pngs/73/580/png-transparent-arturia-business-logo-musical-instruments-individual-retirement-account-logo-business-sound.png" alt="dasdas" width="100px">
    </div>
</div>
<div class="central-block">
    <div class="body">
        <h2 class="title">LOGIN</h2> 

        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <div class="box">
            <h2>Matricola:</h2>
            <input class="textField" type="text" name="matricola">
            <br />
            <h2>Password:</h2>
            <input class="textField" type="password" name="password">
        </div> 
        <div>
            <input class="bottoni" type="submit" name="invio" value="LOGIN">
        </div>
        </form>
        <div class="box2">
            <h2>Non sei uno studente?</h2>
            <form action="form_registrazione.html">
                <input class="bottoni2" type="submit" name="invio" value="REGISTRATI">
            </form>
        </div>
        <?php
            if(isset($_POST['invio']) && ($_POST['matricola'] == "" || $_POST['password'] == "")) {
                echo "<h2 class=\"error\">DATI MANCANTI! Riprovare.</h2> ";
            }
        ?>
    </div>
</div>

</body>
</html>