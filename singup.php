<!DOCTYPE html>
<html>
<head>
	<?php 
	require_once('connectdb.php');

	if (isset($_POST['submit']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$email = htmlspecialchars($_POST['email']);
		$password = sha1($_POST['password']);

		if (!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['password']))
		{
			$reqmail = $dbh->prepare("SELECT * FROM membre WHERE email = ?");
			$reqmail->execute(array($email));
			$emailexist = $reqmail->rowCount();
			if ($emailexist == 0) 
			{
				$pseudolenght = strlen($pseudo);
				if($pseudolenght <= 255)
				{
					$insertmbr = $dbh->prepare("INSERT INTO membre(pseudo, email, password) VALUES(?, ?, ?)");
					$insertmbr->execute(array($pseudo, $email, $password));
					header('Location: index.php');
				}
				else
				{
					$error = "votre pseudo doit faire moins de 255 caractères";
				}
			}
			else{
				$error = "Adresse Email déjà utilisée !";
			}

		}
		else
		{
			$error = "Tous les champs doivent être remplis !"; 
		}
	}


	?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>My_Cinema - SingUp</title>
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
							<a class="nav-link" href="singup.php">SingUp</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
</br>
</br>
<br />
<br />
<h1 class="conn">Enregistrez-vous !</h1>
</br>
<div class="container-md form">
	<form method="POST">
		<div class="form-group">
			<label for="exampleInputPseudo">Pseudo :</label>
			<input type="text" class="form-control" id="exampleInputPseudo" placeholder="Pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>">
		</div>
		<br />
		<div class="form-group">
			<label for="exampleInputEmail1">Email :</label>
			<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php if(isset($email)) { echo $email; } ?>">
		</div>
		<br />
		<div class="form-group">
			<label for="exampleInputPassword1">Mot de passe :</label>
			<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" value="">
		</div>
		<br>
		<br>
		<button type="submit" class="btn btn-primary" name="submit" >s'enregistrer</button>
	</form>
	<br />
	<div class="error">
		<?php
		if (isset($error)) 
		{
			echo '<font color="red">' . $error . '</font>';
		}
		?>
	</div>
</div>

</body>
</html>