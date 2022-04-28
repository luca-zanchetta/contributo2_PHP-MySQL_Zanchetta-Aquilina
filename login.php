<?php
require_once("install.php");
ini_set('display_errors', 0);
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
        <div class="box">
            <h2>Matricola:</h2>
            <input class="textField" type="text" name="matricola">
            <br />
            <h2>Password:</h2>
            <input class="textField" type="password" name="password">
        </div> 
        <div>
            <form action="fittizia.html">
                <input class="bottoni" type="submit" name="invio" value="LOGIN">
            </form>
        </div>
        <div class="box2">
            <h2>Non sei uno studente?</h2>
            <form action="form_registrazione.html">
                <input class="bottoni2" type="submit" name="invio" value="REGISTRATI">
            </form>
        </div>        
    </div>
</div>

</body>
</html>