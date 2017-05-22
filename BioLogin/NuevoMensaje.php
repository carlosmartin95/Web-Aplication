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
  <title>Nuevo Mensaje</title>
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
          <li class="active"><a href="NuevoMensaje.php">Redactar Mensaje</a></li>
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
      <form id="login" method="post" accept-charset='UTF-8' style="height:400px">
        <input type='hidden' name='form-name' value='NuevoMensaje'>
          <div id="login_content">
          
          <label>Para*</label>
          <select class="form-control" name="para" id="sel1">
            <option>Todos</option>
            <option disabled style="color: black;">Usuarios:</option>
            <?php  $uno = "SELECT nombreusuario from usuarios ORDER BY nombreusuario";
                    $consulta = mysqli_query($db, $uno);
                while ($fila = mysqli_fetch_assoc($consulta)){
                    echo '<option>'.$fila["nombreusuario"];   
                }
           ?>
           <option disabled style="color: black;">Grupos:</option>
           <?php  $dos = "SELECT grupo from grupos ORDER BY grupo";
                    $consulta5 = mysqli_query($db, $dos);
                while ($columna = mysqli_fetch_assoc($consulta5)){
                    echo '<option>'.$columna["grupo"];   
                }
           ?> 
          </select>
          <div class="form-group">
            <label>Asunto</label>
            <input type="text" maxlength="50" class="form-control" name="asunto" id="pwd">
          </div>
          <div class="form-group">
            <label>Mensaje*</label>
            <textarea class="form-control" maxlength="1000" rows="5" name="mensaje" id="mensaje" style="resize: vertical;"></textarea>
            <div id="mensaje_footer"><br><br>
            <button id="login_btn" type="submit">Enviar</button>
            </div>
          </div>
          <?php 
            if(isset($_POST['mensaje']) && isset($_POST['asunto']) ){
                $mensaje = $_POST['mensaje']; 
                $asunto = $_POST['asunto'];
                $para = $_POST['para'];
                $valido = True;
                
                if(!empty($mensaje)){
                    $grupejos = "SELECT grupo from grupos";
                    $consultaGrupos = mysqli_query($db, $grupejos);

                    while ($listo = mysqli_fetch_assoc($consultaGrupos)) {
                      if($para == $listo['grupo'] && $valido){
                          $valido = False;
                      }
                    }

                    //cambiar
                    if($para != "Todos" && !empty($mensaje) && $valido){
                      $insert = "INSERT INTO mensajes (emisor,receptor,asunto,dia,mensaje) VALUES ('$usuario','$para','$asunto', NOW(),'$mensaje')";
                      $resultado = mysqli_query($db, $insert);
                    }
                    else if ($para == "Todos" && !empty($mensaje)){ 
                        $tres = "SELECT nombreusuario from usuarios";   
                        $consul = mysqli_query($db, $tres);
                        while ($person = mysqli_fetch_assoc($consul)){
                          $dest = $person['nombreusuario'];
                          $insert = "INSERT INTO mensajes (emisor,receptor,asunto,dia,mensaje) VALUES ('$usuario','$dest','$asunto',NOW(),'$mensaje')"; 
                          $resultado = mysqli_query($db,$insert);
                        }
                    } 
                    else if (!empty($mensaje)){  
                       
                        $checkeo  = "SELECT grupo from usuarios WHERE nombreusuario = '$usuario'";
                        $consulta4 = mysqli_query($db,$checkeo);
                        $checkeoFinal = mysqli_fetch_assoc($consulta4);
                         if ($checkeoFinal['grupo'] == $para && !empty($para)){
                            $grupos = "SELECT nombreusuario from usuarios WHERE grupo = '$para'";
                            $consulta3 = mysqli_query($db, $grupos);
                            // Pasamos dos variables a la siguiente página
                            while ($array = mysqli_fetch_assoc($consulta3)) {
                              
                                $destinatario = $array['nombreusuario'];
                                $insert = "INSERT INTO mensajes (emisor,receptor,asunto,dia,mensaje) VALUES ('$usuario','$destinatario','$asunto',NOW(),'$mensaje')"; 
                                $resultado = mysqli_query($db,$insert);
                            }
                         }
                         else { 
                                echo "<script type='text/javascript'>alert('No puedes enviar mensajes a un grupo al que no pertecenes')</script>";
                                echo '<script>window.location = "NuevoMensaje.php" </script>';
                         }
                    }
                    if(isset($resultado) && $resultado){
                        echo "<script type='text/javascript'>alert('Mensaje enviado con éxito!')</script>";
                        echo '<script>window.location = "main.php" </script>';
                    }
                    else echo "<script type='text/javascript'>alert('Error al enviar el mensaje!')</script>";
                }
                else echo "<script type='text/javascript'>alert('Rellena el campo 'MENSAJE' antes de enviar')</script>";
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