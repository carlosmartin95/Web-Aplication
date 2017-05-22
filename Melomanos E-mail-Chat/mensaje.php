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
		$idMensaje = urldecode($_GET['id']);
		echo "<title> ID del mensaje: $idMensaje </title> ";
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
	      	<li><a href="perfil.php" class="glyphicon glyphicon-user"></a></li>
         	<li><a href="loggin.php" span class="glyphicon glyphicon-log-in"></a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
	
    <div class="jumbotron" style="background: #F8F8F8;
				box-shadow: 0 3px 3px rgba(0, 0, 0, .1);
				height: 470px;
				left: 50%;
				margin-left: -200px;
				margin-top: -200px;
				position: absolute;
				top: 50%;
				width: 400px;
				padding:30px ">
	
    	<p><h3>Para:</h3>
	    	<?php  $uno = "SELECT * from mensajes WHERE emisor = '$usuario' AND id_mensaje = '$idMensaje'";
	                $consulta = mysqli_query($db, $uno);
	                $array = mysqli_fetch_assoc($consulta);
	            	if($consulta && $array)
						echo '<h4>'.$array['receptor'].'</h4>';
	       ?>
	     </p>
        <p><h3>Asunto:</h3>
      		<?php echo '<h4>'.$array['asunto'].'<h4>';
          	?>
       	 </p>
       	<p><h3>Mensaje:</h3></p>
           <?php echo '<h4>'.$array['mensaje'].'</h4>';
           ?> 
      
    </div>


<?php
    mysqli_close($db);
 	?>
</body>

	<!-- Scripts -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
</html>