<!DOCTYPE html>
<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<html lang="en">
<head>
	<?php 
		$usuario = $_SESSION['usuario'];
		echo "<title> $usuario </title> ";
	?>
 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mis Mensajes</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/loggin.css"> 
  <link rel="icon" type="image/png" href="img/favicon.jpg" />
  <meta charset="utf-8">

</head>
<body>
	<?php
  	// Abrimos conexión a la DB
    $db = mysqli_connect('localhost','root','','melomanos');
  	?>

	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>                        
	      </button>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
	      <?php if ($usuario == "admin")
	      		  		echo '<li><a href="admin.php">Crear Grupo</a></li>';
	      	?>
	        <li><a href="main.php">Bandeja de Entrada</a></li>
	       	<li><a href="bandejaSalida.php">Bandeja de Salida</a></li>
	        <li><a href="NuevoMensaje.php">Redactar Mensaje</a></li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	      	<li class="active"><a href="perfil.php" class="glyphicon glyphicon-user"></a></li>
         	<li><a href="loggin.php" span class="glyphicon glyphicon-log-in"></a></li>
	      </ul>
	    </div>
	  </div>
	</nav>

	<div class="container" style="margin-top: 150px">
		<div class="row">
		<div class="profile-head">
	        <div class="profiles col-xs-8 col-xs-push-2  col-sm-10 col-sm-push-1 thumbnail">
	          <div class="col-md-3 col-sm-3 col-xs-12">
	            <div class="row">
	            <h2>Nombre de Usuario<br><br>
	            	<?php echo"$usuario";?>
	            </h2></div>
	           
	          	</div>

	          	<div class="col-md-4 col-sm-6 col-xs-12">
	                     
	                      <p><h2>Descripción</h2><?php
	                      		
	                      		$resultadoConsulta = mysqli_query($db, "SELECT * FROM `usuarios` WHERE nombreusuario = '$usuario'");
	                      		$usuarioGeneral = mysqli_fetch_assoc($resultadoConsulta);

                      			echo $usuarioGeneral['descripcion'];
	                      		?>	 
	                      </p>
	                      <ul>
	                      <li><h3>Edad</h3></li>
	                      <li><?php echo $usuarioGeneral['edad'];		                      		
		                      	?>	
						  	</li>
	                     </ul>
	            </div>

	            <div class="col-md-4 col-sm-6 col-xs-12">

	                	<p><h2>Grupo</h2>
	                		<?php echo $usuarioGeneral['grupo'];
							?>	 
	                      </p>
	                      <ul>
	                      <li><h3>Sexo</h3>
	                      		<?php
	                      		if(isset($usuarioGeneral['sexo']))
		                      			if ($usuarioGeneral['sexo'] == 'M')
		                      				echo "Masculino";
		                      			else echo "Femenino";
		                      	else echo "Edad no disponible";
		                      	?>	
						  	</li>
	                      </ul>

				</div>

	        </div>
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