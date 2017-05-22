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
  <title>Bandeja de Salida</title>
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
	       	<li class="active"><a href="bandejaSalida.php">Bandeja de Salida</a></li>
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
		<div class="jumbotron">
			<h2>Bandeja de Salida</h2><br>    
			<table class="table table-striped">
			<thead>
			  <tr>
			  	<th style="width: 150px">Emisor</th>
			    <th style="width: 190px">Destinatario(s)</th>
			    <th style="width: 190px">Asunto</th>
			    <th style="width: 190px">Mensaje</th>
			    <th style="width: 150px">Dia</th>
			  </tr>
			</thead>
			<tbody>
			  <?php 
			  		$consulta = "SELECT * from `mensajes` WHERE emisor = '$usuario'";
			  		$destino = mysqli_query($db, $consulta);
			  		if($destino){
				  		while ($fila = mysqli_fetch_assoc($destino)){
	                    echo '<tr>';
						echo '<td style = "text-align:left">'.$fila["emisor"];

	                    //if($boolean){
	                    //	echo '<td style = "text-align:left">'.$grupo.'</td>';
	                   	echo '<td style = "text-align:left">'.$fila["receptor"].'</td>';
	                    echo '<td style = "text-align:left">'.$fila["asunto"].'</td>';
	                    echo '<td style = "text-align:left"><a href = "mensaje.php?id='.urldecode($fila['id_mensaje']).'">'.$fila["mensaje"].'</a></td>';
	                    echo '<td style = "text-align:left">'.$fila["dia"].'</td>';
	                    echo '</tr>';
	                   
	                	}
	                	
	                }
	                else echo "<script type='text/javascript'>alert('Error al enviar el mensaje!')</script>";
			  ?>
			</tbody>
			</table>
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
