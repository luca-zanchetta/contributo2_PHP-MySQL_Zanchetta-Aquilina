<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <link rel="stylesheet" href="stile-base.css">
        <title>Homepage</title>
        <?php
            //mysqli_report(MYSQLI_REPORT_ALL); // Per la gestione delle eccezioni dovute a molteplici insert successive ad ogni installazione del db

            $host = "localhost";
            $mysql_user = "admin";
            $mysql_pwd = "admin";
            $db_name = "infostud";
            
            
            $mysqliConnection = new mysqli($host, $mysql_user, $mysql_pwd, $db_name);
           
            if (mysqli_errno($mysqliConnection)) {
                printf("\nERRORE: Connessione al db non riuscita.\n%s\n", mysqli_error($mysqliConnection));
                exit();
            }
        ?>

    </head>
    <body>
        <div class="header">
            <div class="nav-left">
                <div class="nav-logo">
                    <img src="https://store-images.s-microsoft.com/image/apps.51215.9007199266623456.05e3a154-d5ac-49d8-af6e-ab2f789dc26d.f443b25b-1668-48aa-8137-f8e5609aee45?mode=scale&q=90&h=300&w=300" alt="logo" width="90px">
                </div>
                <div class="vertical-bar"></div>
                    <h2>
                        <input type="button">
                        Infostud
                    </h2>
                <div class="vertical-bar"></div>
                    <h2>
                        <input type="button">
                        logout
                    </h2>
            </div>
            <div class="nav-central">
                <div class="nav-logo">
                    <input type="button" name="" id="" >
                    <img src="search.png" alt="err" width="20px" style="display: inline-flex;">
                </div>   
                <input type="text" name="riceca" id="">
            </div>
            <div class="nav-right">
                <img src="account.png" alt="dasdas" width="90px">
            </div>
        </div>
        <div class="central-block">
            <div class="sidebar">
                <h5>Prenota Esame</h5>
                <h5>Iscriviti a un corso</h5>
                <h5>Visualizza corsi</h5>
            </div>
                <div class="body">
                    <div class="body-title">
                        <h2>Corsi a cui sei iscritto</h2>     
                    </div>
                        <div class="container-esami">
                        <?php
                            try{
                                $result = $mysqliConnection->query("SELECT * FROM corso;");
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()){
                                        ?>
                                        
                                            <div class="blocco-esame" style="background-color:<?php echo $row["id_colore"]?>">
                                                <span class="nome-esame" >
                                                    <?php echo $row["nome"]?>
                                                </span>
                                                <span class="info-button">
                                                    info
                                                </span>       
                                            </div>                                   
                                    <?php
                                    }  
                                }
                            }catch(mysqli_sql_exception $e){
                                echo "error!";
                            }
                        ?>   
                        </div>           
                    </div>
                </div>
        </div>
    </body>
</html>
