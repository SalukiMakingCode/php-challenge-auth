<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'root', '');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}