<!DOCTYPE html>
<html>
<head>
	<?php
	require_once('connectdb.php');

	if(isset($_POST['submit']))
	{
		$recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';


		$p = $dbh->query(
			"SELECT * FROM user
			WHERE firstname LIKE \"%$recherche%\" OR
			lastname LIKE \"%$recherche%\"
			");

		$error = "Membre non trouvé";
		if(isset($p) == 0){
			echo $error;
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
						<input class="form-control me-2" type="search" placeholder="Recherchez" aria-label="Search" name="recherche">&nbsp&nbsp
						<button class="btn btn-outline-success" type="submit" name="submit">Trouver</button>
					</form>
				</div>
			</div>
		</nav>
	</header>
</br>
</br>
<br />
<br />
<div class="container">
	<h1 class="title"> Recherche de membres :</h1>
	<div class="col php" id="php">
		<?php 
		if(isset($_POST['submit']))
		{
			while($r = $p->fetch(PDO::FETCH_ASSOC)){
				echo ' '.$r['firstname'].' '. $r['lastname']. ' '.'|' . $r['email']. ' '.'|'.' '. $r['address']. ' ' .$r['zipcode']. ' '.$r['city']. ' '.'|'.' '. $r['country'] .'<br />';
			}

		}
		?>

	</div>
</div>
</div>
</body>
</html>