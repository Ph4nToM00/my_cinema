<!DOCTYPE html>
<html>
<head>
	<?php
	session_start();
	require_once('connectdb.php');
	
	if (isset($_GET['id']) AND $_GET['id'] > 0) 
	{
		$getid = intval($_GET['id']); 
		$requser = $dbh->prepare("SELECT * FROM membre WHERE id = ?");
		$requser->execute(array($getid));
		$userinfo = $requser->fetch();

		
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
								<a class="nav-link" href="affiche.php">À l'affiche</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href=""><?php echo $userinfo['pseudo']; ?></a>
							</li>
							<li class="nav-item position-end">
								<a class="nav-link position-end" href="deco.php">Déconnexion</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
	</br>
</br>
<br />
<div id="conn">
	<h1 class="conn php" id="conn"><?php  echo  ucfirst($userinfo['pseudo']) ; ?></h1>	
</div>
</br>
</br>
<br />
<br />
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-md-auto">
			<?php 
			if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
				?>	 
				<?php
			}
			else{
				header("Location: error.php");
			}
			?>
			<div class="error">
				<?php
				if (isset($error)) 
				{
					echo '<font color="red">' . $error . '</font>';
				}
				?>
			</div>
		</div>
	</div>
</div>
<div class="container loadout">
	<div class="row">
		<div class="col">
			<img style= "width: 70%; height: 80%" src="images/gold.png"  alt="Gold">
			<h3 class="text">Abonnement Gold</h3>
			<?php 

			?>
		</div>
		<div class="col">
			<img style= "width: 70%; height: 80%"  src="images/silver.png" alt="VIP">
			<h3 class="text">Abonnement VIP</h3>
			<?php 

			?>
		</div>
		<div class="col">
			<img style= "width: 70%; height: 80%" src="images/bronze.png" alt="classic">
			<h3 class="text">Abonnement Classic</h3>
			<?php 

			?>
		</div>
	</div>
</div>

</body>
</html>
<?php 
}
else{
	header("Location: error.php");
}
?>