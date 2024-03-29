<?php

	require_once '../includes/users.php';

	if (!user_is_signed_in()) {
		header('Location: sign-in.php');
		exit;	
	}

	require_once '../includes/db.php';

	$results = $db->query('
	SELECT id,name,latitude,longitude,address
	FROM ottawamapped
	ORDER BY name ASC
');

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Ottawa Mapped Administration</title>
<link href="../css/admin.css" rel="stylesheet">
<script src="../js/modernizr.dev.js"></script>
</head>
<body>
<p class="sign-out"><a href="sign-out.php">Sign Out</a></p>
<a href="add.php"> Add a Volleyball Court</a>
<ul>
<?php
	/*
		foreach ($results as $ottawamapped) {
			echo '<li>' . $ottawamapped['name'] . '</li>';
		}
	*/
	?>
<ol class="mapped">
		<?php foreach ($results as $volley) : ?>
		<li itemscope itemtype="http://schema.org/TouristAttraction"> <a href="../single.php?id=<?php echo $volley['id']; ?>" itemprop="name"><?php echo $volley['name']; ?></a> <span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
				<meta itemprop="latitude" content="<?php echo $volley['latitude']; ?>">
				<meta itemprop="longitude" content="<?php echo $volley['longitude']; ?>">
				</span>
				<p><a href="edit.php?id=<?php echo $volley['id']; ?>">Edit</a></p>
				<p><a href="delete.php?id=<?php echo $volley['id']; ?>">Delete</a></p>
		</li>
		<?php endforeach; ?>
</ol>
</body>
</html>