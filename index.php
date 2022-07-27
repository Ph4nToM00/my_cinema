<!DOCTYPE html>
<html>
<head>
	<?php
	session_start();
	require_once('connectdb.php');

	if(isset($_POST['submit']))
	{
		$recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';
		if(stristr($recherche, 'magie'))
		{
			header('Location: https://urlz.fr/94Vv');
		}
	}
	?>
	<?php 
	if(isset($_POST['submit']))
	{
		$recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';
		$options = explode("_", $_POST['recherche']);
		if (isset($_POST['recherche']) ? $options[0] : '')
		{
			$genre = $dbh->query("SELECT movie.title, movie.id AS id_movie,
				genre.id AS id_genre, 
				genre.name AS genre_name 
				FROM movie 
				LEFT JOIN movie_genre 
				ON movie.id = movie_genre.id_movie 
				INNER JOIN genre 
				ON movie_genre.id_genre = genre.id 
				WHERE name LIKE \"%$recherche%\"
				");

			$distrib = $dbh->query("SELECT movie.title, movie.id_distributor AS id_movie,
				distributor.id AS id_distrib, 
				distributor.name AS name_distrib 
				FROM movie 
				INNER JOIN distributor 
				ON distributor.id = movie.id_distributor
				WHERE name LIKE \"%$recherche%\"
				");


			$q = $dbh->query("SELECT * FROM movie
				WHERE title
				LIKE \"%$recherche%\"
				"); 
		}
	}

	?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>My_Cinema</title>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php" id="logo">MyCinema</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.php">Acceuil</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="login.php">Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="singup.php">Sing-up</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="membres.php">Membres</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="affiche.php">À l'affiche</a>
						</li>
					</ul>
					<form class="d-flex" method="POST">
						<input class="form-control me-2" type="search" placeholder="Recherchez" aria-label="Search" name="recherche">
						<select name="options" class="form-select form-select-sm" aria-label=".form-select-sm example">
							<option selected value="title"><--Trouvez avec options--></option>
								<option value="0_genre" name="genre">Genre</option>
								<option value="1_distrib" name="distrib">Distributeur</option>
							</select>&nbsp&nbsp
							<button class="btn btn-outline-success" type="submit" name="submit">Trouver</button>
						</form>
					</div>
				</div>
			</nav>
		</header>
	</br>
</br>
<div class="container">
	<br />
	<br />
	<h1 class="title">Recherche de film :</h1>
	<div class="container">
		<div class="col php" id="php">
			<?php 
			if(isset($_POST['submit']) && ($_POST['options'] === 'title') && isset($q))
			{
				while($r = $q->fetch(PDO::FETCH_ASSOC)){
					echo ' '.$r['title'].' '.'<span class="badge bg-info text-dark">'. $r['duration'].' '. 'min' .'</span>' .' <br />';
				}
			}
			elseif(isset($_POST['submit']) && ($_POST['options'] === '0_genre') && isset($genre))
			{
				while ($p = $genre->fetch(PDO::FETCH_ASSOC)) {
					echo ' '.$p['title']. ' '.'<span class="badge bg-success">' . $p['genre_name'].'</span>' . ' <br />';
				}
			}
			elseif(isset($_POST['submit']) && ($_POST['options'] === '1_distrib') && isset($distrib))
			{
				while ($d = $distrib->fetch(PDO::FETCH_ASSOC)) {
					echo ' '.$d['title']. ' '.'<span class="badge bg-dark">' . $d['name_distrib'].'</span>' . ' <br />';
				}
			}
			?>
		</div>
	</div>
</div>
<br />
<br />
<br />
<br />
</body>
</html>
<?php 
?>