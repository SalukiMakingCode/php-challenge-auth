<?php
//Check if credentials are valid
session_start();
$username=$_POST['username'];
$pass=$_POST['password'];
include 'db_connection.php';
$sql = "SELECT id, username, password FROM user WHERE username='$username' AND password='$pass'";
$req = $pdo->query($sql);
$row = $req->fetch();
if ($row['id']>0) {
    $_SESSION['id']=$row['id'];
    header('Location: read.php');
    exit();
}
else {
    header('Location: index.php');
    exit();
}
