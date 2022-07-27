<!DOCTYPE html>
<html>
<head>
	<?php
	session_start();
	require_once('connectdb.php');
	if(isset($_POST['submit']))
	{
		$pseudo = htmlspecialchars($_POST['pseudoconnect']);
		$password = sha1($_POST['password']);
		if (!empty($pseudo) AND !empty($password))
		{
			$requser = $dbh->prepare("SELECT * FROM membre WHERE pseudo = ? AND password  = ?");
			$requser->execute(array($pseudo, $password));
			$userexist = $requser->rowCount();
			if ($userexist == 1)
			{
				$userinfo = $requser->fetch();
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['pseudo'] = $userinfo['pseudo'];
				$_SESSION['email']	= $userinfo['email'];
				header("Location: profile.php?id=" . $_SESSION['id']);
			}
			else{
				$error = "Mauvais email ou password";
			}
		}
		else{
			$error = "Tous les champs doivent être remplis !";
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
<h1 class="conn">Connectez-vous !</h1>
</br>
</br>
<div class="container-md form">
	<form method="POST"> 
		<div class="form-group">
			<label for="exampleInputPseudo">Pseudo :</label>
			<input type="text" class="form-control" id="exampleInputPseudo" aria-describedby="emailHelp" placeholder="Entrer Votre Pseudo" name="pseudoconnect">
		</div>
		<br>
		<div class="form-group">
			<label for="exampleInputPassword1">Mot de passe :</label>
			<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
		</div>
		<br>
		<br>
		<button type="submit" class="btn btn-primary" name="submit">se connecter</button>
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