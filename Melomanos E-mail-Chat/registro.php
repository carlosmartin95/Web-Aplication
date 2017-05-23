</!DOCTYPE html>
<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<html lang="es">
<head>
<title> Registro en El Rincon del Melómano</title>
<head> 

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mis Mensajes</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/loggin.css"> 
  <link rel="icon" type="image/png" href="img/favicon.jpg" />
  <meta charset="utf-8">

</head>
<body style="overflow: scroll;">
	<?php
  	// Abrimos conexión a la DB
    $db = mysqli_connect('localhost','root','','melomanos');
  	?>
		<div id="content">
			<div class="container">

				<form id='login1' style = 'width: 440px; height: 600px; position: absolute;background: #F8F8F8;box-shadow: 0 3px 3px rgba(0, 0, 0, .1);left: 45%;margin-left: -200px;margin-top: -230px;top: 40%;'
					method="post" action = "registro.php" accept-charset='UTF-8'>
				<input type='hidden' name='form-name' value='login1'>
					<div id="register_header" style="color: black">
						Registro
					</div>
					<div id="register_content" style="width: 440px; height: 400px">
						<span>
		                     <input class="tip" name="username" type="text" maxlength="30">
		                     <label for="username" style="color: black">Usuario*</label>
		                 </span>
						<span>
		                     <input class="tip" name="password" type="password" maxlength="15">
		                     <label for="password" style="color: black">Password*</label>
		                 </span>
		                <span>
		                     <input class="tip" name="edad" type="number" style="background-color: #FFF9C4">
		                     <label for="edad" style="color: black">Edad*</label>
		                 </span>
		                <span>
		                     <input class="tip" name="descripcion" type="text" style="background-color: #FFF9C4">
		                     <label for="descripcion" style="color: black">Descripción*</label>
		                 </span>
		            	<span>
		                	 <label for="grupo" style="color: black">Musica</label>
		                     <select class="form-control" name="gusto" style="background-color: #FFF9C4">
		                     	 <?php $uno = "SELECT gusto from gusto";
					                    $consulta = mysqli_query($db, $uno);
					                while ($fila = mysqli_fetch_assoc($consulta)){
					                    echo '<option>'.$fila["gusto"];   
					                }
						          ?>
		                     </select>
		                  </span>
	                  	<span>
	                  		 <label for="sexo" style="color: black">Sexo</label>
	                  		 <select class="form-control" name="sexo" style="background-color: #FFF9C4">
	                  		 	<option>Hombre</option>
			                    <option>Mujer</option>
			                    <option>Otro</option>
	                  		 </select>
	                  	 </span>	
		               </div>
					<div id="register_footer" style="position: absolute; bottom: 0; width: 100%" ">
						<button id="register_btn" type="submit">Registrarse</button>
					</div>
					 <?php
				        echo "<br><br>";
				        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['edad']) && isset($_POST['sexo']) && isset($_POST['descripcion']) && isset($_POST['gusto']) ){
				         
				          $usuario = $_POST['username'];
				          $password = $_POST['password'];
				          $sexo = $_POST['sexo'];
				          $descripcion = $_POST['descripcion'];
				          $edad = $_POST['edad'];
				          $gusto = $_POST['gusto'];
				          $_SESSION['usuario'] = $usuario;

				          	if( !empty($descripcion) && !empty($usuario) && !empty($password) && !empty($sexo) && !empty($edad) && !empty($gusto)){

				          		  $consultaEdades = mysqli_query($db, "SELECT * FROM grupos WHERE grupo ='$gusto'");
				          		  $chekeoEdad = mysqli_fetch_assoc($consultaEdades);
				          		  
						          $checkUser = mysqli_query($db, "SELECT nombreusuario FROM `usuarios` WHERE nombreusuario = '$usuario'");
					              if(mysqli_num_rows($checkUser) >= 1)
					            	echo "<script type='text/javascript'>alert('El nombre de usuario ya existe!')</script>";
					              else {  mysqli_query($db, "INSERT INTO usuarios VALUES('$usuario','$password','$edad', '$gusto', '$descripcion','$sexo')");
						            
							          $checkRegistro = mysqli_query($db, "SELECT nombreusuario FROM `usuarios` WHERE nombreusuario = '$usuario'");
						              if(mysqli_num_rows($checkRegistro) >= 1){
						              		echo "<script type='text/javascript'>alert('Registro con éxito!')</script>";
						              		echo '<script>window.location = "main.php" </script>';
						              }
							          else echo "<script type='text/javascript'>alert( Error al realizar el registro, Intentelo de nuevo')</script>";
						      	  }
							      
							}
							else echo "<script type='text/javascript'>alert('Porfavor, rellene los campos obligatorios (*)')</script>";
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