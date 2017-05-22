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
		echo "<title> ID $idMensaje </title> ";
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
	
	<div class="container">
      <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
        <?php
          $resultadoConsulta = mysqli_query($db, "SELECT * FROM mensajes WHERE id_mensaje = '$idMensaje'");
          $mensaje = mysqli_fetch_assoc($resultadoConsulta);
        ?>
          <div class="panel panel-info" style="margin-top: 20%">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo"Mensaje ID $idMensaje";?></h3>
            </div>
            <div class="panel-body">
              <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>De</td>
                        <td><?php echo $mensaje['emisor']?></td>
                      </tr>
                      <tr>
                        <td>Destinatario</td>
                        <td><?php echo $mensaje['receptor']?></td>
                      </tr>
                      <tr>
                        <td>Asunto</td>
                        <td><?php echo $mensaje['asunto']?></td>
                      </tr>
                      <tr>
                        <td>Mensaje</td>
                        <td><?php echo $mensaje['mensaje']?></td>
                           
                      </tr>
                     
                    </tbody>
                  </table>
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