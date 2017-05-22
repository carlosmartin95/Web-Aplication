</!DOCTYPE html>
<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<html lang="es">
	<head>
		<title> Bienvenido al Rincon del Melómano</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/loggin.css"> 
		<link rel="icon" type="image/png" href="favicon.jpg" />
		<meta charset="utf-8">
	</head>
	<body>
	<?php
  	// Abrimos conexión a la DB
    $db = mysqli_connect('localhost','root','','melomanos');
  	?>
		<div id="content">
			<div class="container">

				<form id='login' method="post" style="height:380px;" action = "loggin.php" accept-charset='UTF-8'>
				<input type='hidden' name='form-name' value='login'>
					<div id="login_header" style="color: black">
						El Rincón del Melómano
					</div>
					<div id="login_content">
						<span>
		                     <input class="tip" name="username" type="text" maxlength="25";  "onblur="onBlur(this);">
		                     <label for="username" style="color: black">Usuario</label>
		                     <div class="tooltip" data-text="Enter your username"></div>
		                  </span>
						<span>
		                     <input class="tip" name="password" type="password" maxlength="16";  onblur="onBlur(this);">
		                     <label for="password" style="color: black">Password</label>
		                     <div class="tooltip" data-text="Enter your password"></div>
		                  </span>
		                <p>
							<a class="link_registro" href="registro.php">No tienes cuenta? REGÍSTRATE!</a>
						</p>
					<br>
					<div id="login_footer">
						<button id="login_btn" type="submit">Entrar</button>
					</div>
					</div>
					 <?php
				        echo "<br><br>";
				        if (isset($_POST['username']) && isset($_POST['password'])){
				          $usuario = $_POST['username'];
				          $password = $_POST['password'];

				          if(!empty($usuario) && !empty($password)){
				            //Pass user to next page
				            $_SESSION['usuario'] = $usuario;
				            $checkUser = mysqli_query($db, "SELECT nombreusuario FROM `usuarios` WHERE nombreusuario = '$usuario'");
				            //Get password from user in database
			                $passQuery = mysqli_query($db, "SELECT contrasena FROM `usuarios` WHERE nombreusuario = '$usuario'");
			                $pwd = mysqli_fetch_object($passQuery);
			                if($pwd->contrasena!= $password && mysqli_num_rows($checkUser) == 0)
			                  echo "<script type='text/javascript'>alert('Usuario o contraseña incorrectos!')</script>";
			                else{
				                //Check if user is administrator
				                if($usuario == 'admin'){
				                  echo '<script>window.location = "admin.php" </script>';
				                }
				                else echo '<script>window.location = "main.php" </script>';
			                }
				         }
				         else echo "<script type='text/javascript'>alert('Por favor, rellene todos los campos')</script>";
				        }
				      ?>	

				</form>
			</div>
		</div>
	<?php
    mysqli_close($db);
 	?>
	</body>

	<!-- Scripts -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
</html>