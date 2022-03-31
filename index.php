<?php
require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post">
<h2>Formulaire</h2> 
 <input type="text" name="firstname" placeholder="firstname" /><br /> 
 <input type="text" name="lastname" placeholder="lastname"/><br /> 
 <input type="submit" name="add" /> 
</form>

<?php

if(isset($_POST['firstname']) && isset($_POST['lastname'])){

$query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
$statement = $pdo->prepare($query);

$statement->bindValue(':firstname', $_POST['firstname'], \PDO::PARAM_STR);
$statement->bindValue(':lastname', $_POST['lastname'], \PDO::PARAM_STR);

$statement->execute();

$friends = $statement->fetchAll();
header('Location: /');
}
?>

<?php
$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

echo '<ul>'; 
foreach($friends as $friend) {
echo '<li>'.$friend['firstname'] .' '. $friend['lastname']. '</li>';
}
echo '</ul>'; 
?>

</body>
</html>


