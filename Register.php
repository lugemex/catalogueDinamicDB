<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/Register_style.css" rel="stylesheet">
	<?php session_start();?>
</head>


<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
			<img class="img-fluid mb-3 mb-lg-0" src="img/newLogo.png" alt="">
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
            
			<!-- Form -->
			<form class="form-signin" action = "#" method = "POST">
              <div class="form-label-group">
				<!-- User -->
                <input type="String" name="usuario" class="form-control" placeholder="Username" required autofocus>
                <label for="usuario">Username</label>
              </div>
				
			<div class="form-label-group">
				<!-- Name -->
                <input type="String" name="name" class="form-control" placeholder="Name" required>
                <label for="name">Name</label>
              </div>
			  <!-- Mail -->
              <div class="form-label-group">
                <input type="string" name="correo" class="form-control" placeholder="Email address" required>
                <label for="correo">Email address</label>
              </div>

              <hr>

              <div class="form-label-group">
				<!-- Password -->
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <label for="password">Password</label>
              </div>
		
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name = "enviar">Register</button>
              <a class="d-block text-center mt-2 small" href="Login.php">Sign In</a>
			  <a class="d-block text-center mt-2 small" href="index.php">Home</a>
              <hr class="my-4">
              
				<?php
					if(isset($_POST["enviar"])){
						$usuario 	= $_POST["usuario"];
						$password 	= $_POST["password"];
						$name 		= $_POST["name"];
						$correo		= $_POST["correo"];
						$password_encriptada = sha1($password);
						
						$fp = fopen("db.txt","r+");
						
						while(!feof($fp)){
							$linea = fgets($fp);
							$linea_split = explode(",",$linea); //regresa un array
							
							if($usuario == "mantenimiento" && $password_encriptada == "2c564879968adbf9875ea151b00dacc051437447"){
								echo "<script>
								alert('Usuario restringido');
								window.location = 'index.php';
								</script>";
							}
							if($linea_split[1] == $usuario || $linea_split[4] == $correo){
								echo "<script>
									alert('Usuario ya registrado');
									window.location = 'Register.php';
									</script>";
								break;
							}
							if(feof($fp)){
								$lastUser = $linea_split[0] + 1;
								fputs($fp, "\n".
								$lastUser.",".
								$usuario.",".
								$password_encriptada.",".
								$name.",".
								$correo.","
								);
								echo "<script>
								alert('Usuario registrado exitosamente');
								window.location = 'Login.php';
								</script>";
							}
						}
						fclose($fp);
					}
					?>
			
			</form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>