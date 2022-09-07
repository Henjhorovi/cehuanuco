<?php
 if (isset($_POST['usuario'])&&isset($_POST['password']))
 {
        include "conexion.php";
        $fec="SELECT NOW()";
        foreach($bd->query($fec) as $fech){
            $fechareg=$fech[0];
        }
        $sql="SELECT * FROM colegiado WHERE dni='" . $_POST['usuario'] . "' AND clave='" . $_POST['password'] ."'";
        $i=0;
         foreach ($bd->query($sql) as $RsLogin)
        {             
             $i++;
         }
         //var_dump($sql);
         if($i>0)
         {
             session_start();
             $_SESSION['idcolegiadovoto']= $RsLogin['id'];                
             $_SESSION['nombrevoto']= $RsLogin['nombre']." ".$RsLogin['apellidos'];
             $_SESSION['apellidos']=$RsLogin['apellidos'];
             $_SESSION['nombre']=$RsLogin['nombre'];
                     
            header("Location: eleccionespartidos.php");
         }
            else 
             {
               ?>
                <center><h3>ERROR DE USUARIO O CONTRASEÑA</h3></center>
            <?php         
             }
    
 }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>CEH - ELeciones 2021</title>
    <link rel="stylesheet" type="text/css" href="css/elecciones.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.png">
		</div>
		<div class="login-content">
                <form class="form" method="POST" action=""> 
				<img src="img/avatar.png">
				<h2 class="title">ELECCIONES 2021</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Usuario</h5>
                                        <input type="text" class="input" name="usuario">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
                                <input type="password" class="input" name="password">
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Ingresar">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/eleccionesmain.js"></script>
</body>
</html>

 
