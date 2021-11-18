<?php
session_start();
if (empty($_SESSION['id'])) exit();
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id=filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $sql = "DELETE FROM hiking WHERE id='$id'";
    $req = $pdo->exec($sql);
    header('Location: read.php');
    exit();
}

echo "What are you doing here dude ?";