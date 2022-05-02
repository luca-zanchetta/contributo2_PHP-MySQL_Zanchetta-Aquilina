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
    <title>Homepage</title>
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
        <div class="nav-central">
            <form action="cancella_iscrizione.php" method="GET">
                <div class="nav-logo">
                    <input type="submit" name="ricerca" value="">
                    <img src="search.png" alt="err" width="20px" style="display: inline-flex;">
                </div>    
                    <input type="text" name="filtro">              
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
                <a class="opzione" href="visualizza_prenotazione.php">Visualizza prenotazioni</a>
            </h5>
            <h5>
                <a class="opzione" href="prenota-esame_scegli_corso.php">Indietro</a>
            </h5>
        </div>
        <div class="body">
            <?php
                //controlliamo se la pagina è stata lanciata da se stessa tramite la form di ricerca
                if(!isset($_GET['filtro']) || $_GET['filtro'] == ''){
                    $query_visualizza_iscrizioni = "SELECT p.*,c*
                    FROM prenotazione_appello p
                    WHERE p.id_studente = \"{$_SESSION['matricola']}\"";
                }else {
                    $query_visualizza_iscrizioni = "SELECT p.*,c*
                    FROM prenotazione_appello p,corso c,appello a
                    WHERE a.id_corso = c.id AND a.id = p.id_appello AND p.id_studente =\"".$_SESSION['matricola']."\" AND c.nome LIKE\"".$_GET['filtro']."%\"";
                }    
                try{
                    $result = $mysqliConnection->query($query_visualizza_iscrizioni);
                    if ($result->num_rows > 0) {
                        ?>
                            <div class="body-title">
                                <h2>Seleziona appello:</h2>     
                            </div>
                        <?php
                    }
                }
                catch(mysqli_sql_exception $e){
                    echo "error!";
                }
            ?>
            <div class="container-esami">
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                            ?>
                                <div class="blocco-esame" style="background-color:<?php echo $row["id_colore"]?>">
                                    <div class="nome-esame" >
                                        <?php echo $row["nome"]." ".$row["data_appello"]?>
                                    </div> 
                                    <div class="info-button">
                                            cancella
                                            <form action="cancellazione_prenotazione.php" method="GET"> <!--Da implementare visualizza-corso.php-->
                                                <input type="submit" name="iscriviti" value="" >
                                                <input type="hidden" name="corso" value="<?php echo $row["id"] ?>">
                                            </form>
                                    </div>  
                                </div>                                     
                        <?php
                        }  
                    }
                    elseif($result->num_rows == 0 and !isset($_GET['filtro'])) {
                        ?>
                            <form action="iscriviti.php" method="post">
                            <div class="zero-esami_central">
                                <h2>Non risultano prenotazioni.</h2>
                                <input class="button-iscrizione" type="submit" name="iscriviti" value="ISCRIVITI AD UN CORSO">
                            </div>
                            </form>
                        <?php
                    }elseif($result->num_rows == 0 and isset($_GET['filtro'])) {
                        ?>
                            <form action="homepage.php" method="post">
                            <div class="zero-esami_central">
                                <h2>Non risultano prenotazioni a corso con quel nome.</h2>
                                <input class="button-iscrizione" type="submit" name="home" value="TORNA ALLA HOME">
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