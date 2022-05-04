<?php
    ini_set('display_errors', 0);
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
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="stylesheet" href="stile-base.css">
    <title>Prenota Appello - Infostud</title>
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
                    <form action="">
                        <input type="button">
                    </form>
                    Infostud
                </h2>
            <div class="vertical-bar"></div>
                <h2>
                    <a class="logout" href="logout.php">
                        logout
                    </a>
                </h2>
        </div>
        <div class="nav-central"  style="width:auto;">
            <form action="prenotaAppello.php" style="width: 100%;">
                <div class="nav-logo">
                    <input type="submit" name="ricerca" value="">
                    <img src="search.png" alt="err" width="20px" style="display: inline-flex;">
                </div>   
                <input type="date" name="data" style="padding-right: 5%;">
            </form> 
        </div>
        <div class="nav-right">
            <img src="account.png" alt="dasdas" width="90px">
        </div>
    </div>
    <div class="central-block">
        <div class="sidebar">
        <h5>
                <a class="opzione" href="cancella_prenotazione.php">Cancella prenotazione</a>
            </h5>
            <h5>
                <a class="opzione" href="visualizza_prenotazioni.php">Visualizza prenotazioni</a>
            </h5>
            <h5>
                <a class="opzione" href="prenota-esame_scegli_corso.php">Indietro</a>
        </div>
        <div class="body">
            <?php
                if(!isset($_GET['data'])){ 
                    $query_prenotazioni_possibili = "SELECT *
                    FROM appello a
                    WHERE a.id_corso = {$_GET['corso']}
                    AND a.scadenza >= current_date()
                    AND a.codice NOT IN (
                        SELECT id_appello
                        FROM prenotazione_appello
                        WHERE id_studente = {$_SESSION['matricola']}
                    )"; 
                }else {
                    //$filtro = new DateTime($_GET['data']);
                    //$filtro = $mysqliConnection->real_escape_string($filtro->format('Y-m-d'));
                    echo $filtro;
                    $query_prenotazioni_possibili = "SELECT *
                    FROM appello a
                    WHERE a.id_corso = {$_GET['corso']}
                    AND a.scadenza >= current_date()
                    AND date(a.data_appello) >= date(\'{$filtro}\')
                    AND a.codice NOT IN (
                        SELECT id_appello
                        FROM prenotazione_appello
                        WHERE id_studente = {$_SESSION['matricola']})"; 
                }         
                try {
                    $result = $mysqliConnection->query($query_prenotazioni_possibili);
                    if ($result->num_rows > 0) {
                        ?>
                            <div class="body-title">
                                <h2>Appelli del corso <?php echo "{$_GET['nomeCorso']}"; ?></h2>     
                            </div>
                        <?php
                    }
                }
                catch(mysqli_sql_exception $e){
                    echo $e->getMessage();
                }
            ?>
            <div class="container-esami">
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            ?>
                                <div class="blocco-esame" style="background-color:<?php echo "{$_GET['coloreCorso']}"; ?>">
                                    <div class="nome-esame" >
                                        <?php echo $row["data_appello"]?>
                                    </div> 
                                    <div class="info-button">
                                            PRENOTA
                                            <form action="prenotaAppelloSCRIPT.php" method="GET">
                                                <input type="submit" name="prenota" value="" >
                                                <input type="hidden" name="appello" value="<?php echo $row['codice']; ?>">
                                            </form>
                                    </div>  
                                </div>                                   
                        <?php
                        }  
                    }
                    elseif($result->num_rows == 0) {
                        ?>
                            <form action="fittizia.php" method="post">
                            <div class="zero-esami_central">
                                <h2>Nessun appello trovato.</h2>
                            </div>
                            </form>
                        <?php
                    }
                ?>   
            </div>           
        </div>
    </div>
</div>
</body>
</html>