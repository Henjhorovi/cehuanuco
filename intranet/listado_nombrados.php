<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=euc-kr"> 
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<!-- Website CSS style -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=latin-ext" rel="stylesheet">

		<title>Habilitados CE</title>
	</head>
	<body>
		<div class="container" style="margin: 25px auto;">
	    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                  <th>N°</th>
                  <th>DNI</th>
                  <th>APELLIDOS</th>
                  <th>NOMBRE</th>
                  <th>N° COL.</th>
                  <th>SEXO</th>
                  <th>TELEFONO</th>
                  <th>EMAIL</th>                  
                </tr>
        </thead>
        <tbody>
            <?PHP
                        include 'conexion.php';
                        $i=1;
                        $stmt = $bd->prepare("SELECT * FROM colegiado WHERE estado=1 ORDER BY nrocolegiatura ASC" ); 
                        $stmt->execute();
                        foreach($stmt as $colegiado)
                        {
                            if($colegiado['nrocolegiatura']<10){
                                $numerocol='000'.$colegiado['nrocolegiatura'];
                            }else{
                                if($colegiado['nrocolegiatura']<100){
                                    $numerocol='00'.$colegiado['nrocolegiatura'];
                                }else{
                                    if($colegiado['nrocolegiatura']<1000){
                                    $numerocol='0'.$colegiado['nrocolegiatura'];
                                }
                            }}
                            echo "<tr><td> " . $i . 
                                    "</td><td> " . $colegiado['dni'] . "</td>"
                                    . "<td> " . $colegiado['apellidos'] . "</td>"
                                    . "<td> " . $colegiado['nombre'] . "</td>"
                                    . "<td> " . $numerocol . "</td>"
                                    . "<td><center> " . $colegiado['sexo'] . "</center></td>"
                                    . "<td> " . $colegiado['telefono'] . "</td>"
                                    . "<td> " . $colegiado['email'] . "</td>"
                                    . "</tr>";
                            $i++;
                        }
                    ?>
        </tbody>
    </table>
		
        </div><!--container-->

<script>
    $(document).ready(function() {
    $('#example').DataTable();
    } );
</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>      
	</body>
</html>