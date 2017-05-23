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
	      	<li class="active"><a href="admin.php">Crear Grupo</a></li>
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

	<div id="content">
    <div class="container">
      <form id="login" action="admin.php" method="post" accept-charset='UTF-8' style="height: 420px">
        <input type='hidden' name='form-name' value='NuevoMensaje'>
          <div id="login_content" class="login_content">
          
	         <label>Nombre del grupo</label>
	         <input type="text" maxlength="50" class="form-control" name="nombreGrupo">

	          <div class="form-group">
	            <label>Edad Mínima</label>
	            <input type="number" name="edadMin">
	          </div>
	          <div class="form-group">
	            <label>Edad Máxima</label>
	            <input type="number" name="edadMax">
	          </div>
	          <label>Tipo de Música</label>
	          <select class="form-control" name="musica" id="sel1">
	          <?php  $uno = "SELECT gusto from gusto ORDER BY gusto";
                    $consulta = mysqli_query($db, $uno);
                while ($fila = mysqli_fetch_assoc($consulta)){
                    echo '<option>'.$fila["gusto"];   
                }
           	  ?>
           	  </select>
 			<div id="mensaje_footer"><br>
	        <button id="login_btn" type="submit">Crear</button>
	      	</div>

	      </div>
	     
	  </form>
	</div>
	</div>

	<?php	
		if (isset($_POST['nombreGrupo']) && isset($_POST['edadMin']) && isset($_POST['edadMax']) && isset($_POST['musica'])){
			$nombreGrupo = $_POST['nombreGrupo'];
			$edadMin = $_POST['edadMin'];
			$edadMax = $_POST['edadMax'];
			$musica = $_POST['musica'];
			
			$checkGrupo = mysqli_query($db, "SELECT grupo FROM `grupos` WHERE grupo = '$nombreGrupo'");
			if(mysqli_num_rows($checkGrupo) >= 1){
				echo "<script type='text/javascript'>alert('El grupo ya existe!')</script>";
			}
			else if (!empty($nombreGrupo) && !empty($edadMin) && !empty("edadMax") && !empty($musica)) {
					$insertarGrupo = "INSERT INTO grupos VALUES ('$nombreGrupo', '$edadMin', '$edadMax', '$musica')";
					$insercionGrupo = mysqli_query($db, $insertarGrupo);
					if($insercionGrupo){
						echo "<script type='text/javascript'>alert('Grupo creado con éxito!')</script>";
					}
			}
			else echo "<script type='text/javascript'>alert('Rellena todos los campos')</script>";
		}
	?>
	         

<?php
    mysqli_close($db);
  ?>
</body>

<!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</html>