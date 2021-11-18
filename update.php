<?php
session_start();
if (empty($_SESSION['id'])) exit();
if (!isset($_GET['id'])) {
    echo "what are you doing here dude ?? " ;
}
$id=$_GET['id'];
include 'db_connection.php';
$sql = "SELECT id, name, difficulty, distance, duration, height_difference FROM hiking WHERE id='$id' ";
$req = $pdo->query($sql);
$row = $req->fetch();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editer une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Editer</h1>
	<form action="read.php" method="post">
        <input type="hidden" name="type" value="edit"/>
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>

        <div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo $row['name']; ?>">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile"<?php if ($row['difficulty']=="très facile") echo " selected"; ?>>Très facile</option>
				<option value="facile"<?php if ($row['difficulty']=="facile") echo " selected"; ?>>Facile</option>
				<option value="moyen"<?php if ($row['difficulty']=="moyen") echo " selected"; ?>>Moyen</option>
				<option value="difficile"<?php if ($row['difficulty']=="difficile") echo " selected"; ?>>Difficile</option>
				<option value="très difficile"<?php if ($row['difficulty']=="très difficile") echo " selected"; ?>>Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo $row['distance']; ?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo $row['duration']; ?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo $row['height_difference']; ?>">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
