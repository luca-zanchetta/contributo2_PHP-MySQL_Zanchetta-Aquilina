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
    <title>Login - MiniInfostud</title>
    <link rel="stylesheet" href="stileLogin.css">
    <link rel="stylesheet" href="stile-base.css">
</head>

<body>
<form action="fittizia.html">

<h1>Mini Infostud</h1>

<div class="box">
    <h2>Matricola:</h2>
    <input class="textField" type="text" name="matricola">
    <br />
    <h2>Password:</h2>
    <input class="textField" type="password" name="matricola">
</div>

<div>
    <input class="bottoni" type="reset" value="Cancella">
    <input class="bottoni" type="submit" name="invio" value="Login">
</div>

<div class="box2">
    <h4>Non sei uno studente?</h4>
    <input class="bottoni2" type="submit" name="invio" value="REGISTRATI">
</div>

</form>
</body>
</html>
