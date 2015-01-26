<!DOCTYPE html>
<html>
<head>
	<title>DVD Search with PDO</title>
	<link rel="stylesheet" href="css/style.css">
	<script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
</head>
<body>
	<form action = "results.php" method="get" ng-app="">
		You would like to search for <span ng-bind="item"></span> 
		<br/>
		<input type="text" name = "title" ng-model="item">
		<input type="submit" value="Confirm">
	</form>

</body>
</html>