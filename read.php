<?php
session_start();
if (empty($_SESSION['id'])) exit();
include 'db_connection.php';

if (isset($_POST['type'])) {
    if ($_POST['type']=="add") {
        $name=$_POST['name'];
        $difficulty=$_POST['difficulty'];
        $distance=$_POST['distance'];
        $duration=$_POST['duration'];
        $height_difference=$_POST['height_difference'];

        $sql = "INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES
                ('$name', '$difficulty', '$distance', '$duration', '$height_difference')";
        $req = $pdo->exec($sql);
    }

    if ($_POST['type']=="edit") {
        $id=$_POST['id'];
        $name=$_POST['name'];
        $difficulty=$_POST['difficulty'];
        $distance=$_POST['distance'];
        $duration=$_POST['duration'];
        $height_difference=$_POST['height_difference'];

        $sql = "UPDATE hiking SET name='$name', difficulty='$difficulty', distance='$distance', duration='$duration',
                  height_difference='$height_difference' WHERE id='$id'";
        $req = $pdo->exec($sql);
    }
}

$sql = 'SELECT id, name, difficulty, distance, duration, height_difference FROM hiking';
$req = $pdo->query($sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <a href="create.php">Ajouter</a><br/><br/>
    <table>
        <?php
        while($row = $req->fetch()) {
        echo "<tr>
                <td class='edit'> <a href='update.php?id=".$row['id']."'>Editer</a></td>
                <td class='delete'> <a href='delete.php?id=".$row['id']."'>Supprimer</a></td>
                <td class='name'>".$row['name']."</td>
                <td class='difficulty'>".$row['difficulty']."</td>
                <td class='distance'>".$row['distance']."</td>
                <td class='duration'>".$row['duration']."</td>
                <td class='height_difference'>".$row['height_difference']."</td>
              </tr>";
        }
        $req->closeCursor();
        ?>
    </table>

  </body>
</html>