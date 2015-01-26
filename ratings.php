<?php 

$host = 'itp460.usc.edu';
$dbname = 'dvd';
$user = 'student';
$password = 'ttrojan';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

$rating_name = $_GET['rating_name'];

echo "<h3>Rating: $rating_name</h3>";

$sql = "
	SELECT title
	FROM dvds
	INNER JOIN ratings
	ON ratings.id = dvds.rating_id
	WHERE ratings.rating_name = ?
";

$statement = $pdo->prepare($sql);
$statement->bindParam(1, $rating_name);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_OBJ);

echo "<table border=1 style=width:100%>";


?>

<?php foreach($results as $result) : ?>
	<tr>
		<td><?php echo $result->title ?></td>
	</tr>
<?php endforeach ?>