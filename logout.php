<?php
    session_start();
    unset($_SESSION);
    session_destroy();
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Logout - Infostud</title>
    <link rel="stylesheet" href="stileLogin.css">
</head>

<body>
<form action="login.php">
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
    <div class="nav-right">
        <img src="account.png" alt="dasdas" width="100px">
    </div>
</div>
<div class="central-block">
    <div class="body">
        <div class="box">
            <h1>Disconnessione avvenuta con successo!</h1>
        </div>
        <div>
            <input class="bottoneHome" type="submit" name="invio" value="Torna al login">
        </div>
    </div>
</div>


</form>
</body>
</html>