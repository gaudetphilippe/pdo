<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pdo</title>
</head>
<body>

<?php
require_once 'connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);

$query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname , :lastname)";
$statement = $pdo->prepare($query);
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
$statement->execute();


$friends = $statement->fetchAll();

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();
?>

<?php foreach ($friends as $friend): ?>
<ul>
    <li> <?php echo $friend['firstname'] .' '. $friend['lastname'];?></li>
</ul>
<?php endforeach; ?>

<form  action=""  method="post">
    <div>
      <label  for="lastname">Nom :</label>
      <input  type="text"  id="lastname"  name="lastname">
    </div>
    <div>
      <label  for="firstname">Prénom :</label>
      <input  type="text"  id="firstname"  name="firstname">
    </div>
    <div  class="button">
        <button  type="submit">Envoyer votre message</button>
    </div>
</form>
</body>
</html>



