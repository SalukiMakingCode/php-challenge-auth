<?php
session_start();
if (empty($_SESSION['id'])) exit();
include 'db_connection.php';

if (isset($_POST['type'])) {
    if ($_POST['type']=="add") {
        $name=filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $difficulty=filter_var($_POST['difficulty'], FILTER_SANITIZE_STRING);
        $distance=filter_var($_POST['distance'], FILTER_SANITIZE_NUMBER_FLOAT);
        $duration=filter_var($_POST['duration'], FILTER_SANITIZE_NUMBER_FLOAT);
        $height_difference=filter_var($_POST['height_difference'], FILTER_SANITIZE_NUMBER_FLOAT);

        $sql = "INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES
                ('$name', '$difficulty', '$distance', '$duration', '$height_difference')";
        $req = $pdo->exec($sql);
    }

    if ($_POST['type']=="edit") {
        $id=filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);;
        $name=filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $difficulty=filter_var($_POST['difficulty'], FILTER_SANITIZE_STRING);
        $distance=filter_var($_POST['distance'], FILTER_SANITIZE_NUMBER_FLOAT);
        $duration=filter_var($_POST['duration'], FILTER_SANITIZE_NUMBER_FLOAT);
        $height_difference=filter_var($_POST['height_difference'], FILTER_SANITIZE_NUMBER_FLOAT);

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