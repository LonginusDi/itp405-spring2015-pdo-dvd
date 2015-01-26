<?php

if (!isset($_GET['title'])) {
	header('Location: search.php');
}


$title = $_GET['title'];

$host = 'itp460.usc.edu';
$dbname = 'dvd';
$user = 'student';
$password = 'ttrojan';

echo "<h3>You searched for $title:</h3>";

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

$sql = "
	SELECT title, genre_name, format_name, rating_name
	FROM dvds
	INNER JOIN genres
	ON dvds.genre_id = genres.id
	INNER JOIN formats
	ON dvds.format_id = formats.id
	INNER JOIN ratings
	ON dvds.rating_id = ratings.id
	WHERE title LIKE ?
";


$statement = $pdo->prepare($sql);
$like = '%' . $title . '%';
$statement->bindParam(1, $like);
$statement->execute();
$dvds = $statement->fetchAll(PDO::FETCH_OBJ);

if (empty($dvds)) {
	echo "Nothing was found in the database <br/>";
	echo "<a href=search.php>Return to search page</a>";
}else{
	echo "<table border=1 style=width:100%>";
	echo "<tr>";
	echo "<td> <strong>Title </strong></td>";
	echo "<td> <strong>Genre </strong></td>";
	echo "<td> <strong>Format </strong></td>";
	echo "<td> <strong>Rating </strong></td>";
	echo "</tr>";
}

?>

<?php foreach($dvds as $dvd) : ?>
	<tr>
		<td><?php echo $dvd->title ?></td>
		<td><?php echo $dvd->genre_name ?></td>
		<td><?php echo $dvd->format_name ?></td>
		<td><a href = "ratings.php?rating_name=<?php echo $dvd->rating_name ?>">
			<?php echo $dvd->rating_name ?>
		</a></td>
	</tr>
<?php endforeach ?>
</table>