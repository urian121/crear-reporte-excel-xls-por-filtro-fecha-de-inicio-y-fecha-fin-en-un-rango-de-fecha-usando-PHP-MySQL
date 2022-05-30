<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <!--Importante--->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar</title>
    <style>
    .color{
        background-color: #9BB;  
    }
</style>
</head>
<body>
    
<?php
date_default_timezone_set("America/Bogota");
$fecha = date("d/m/Y");


/**PARA FORZAR LA DESCARGA DEL EXCEL */
header("Content-Type: text/html;charset=utf-8");
header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
$filename = "ReporteExcel_" .$fecha. ".xls";
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=" . $filename . "");

/**conexion a BD */
$usuario  = "root";
$password = "";
$servidor = "localhost";
$basededatos = "ejemplo_youtube";
$con = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
mysqli_query($con,"SET SESSION collation_connection ='utf8_unicode_ci'");
$db = mysqli_select_db($con, $basededatos) or die("Upps! Error en conectar a la Base de Datos");

/***RECIBIENDO LAS VARIABLE DE LA FECHA */
$fechaInit = $_POST['fecha_ingreso'];
$fechaFin  = $_POST['fechaFin'];


/*
select * from trabajadores where (created_at>="2019-01-01" and created_at<="2019-01-31") order by created_at desc
select * from trabajadores where (created_at>="$start" and created_at<="$end") order by created_at desc
SELECT * FROM trabajadores WHERE created_at BETWEEN "2019-01-01" AND "2019-01-31" order by created_at desc
SELECT * FROM trabajadores WHERE created_at BETWEEN "$start" AND "$end" order by created_at desc
SELECT * FROM `trabajadores` WHERE fecha_ingreso BETWEEN '2016-03-20' AND '2016-20-31'
select * from trabajadores where fecha_ingreso >= '2019-11-06 00:00:00' and fecha_ingreso < '2019-11-07 00:00:00';
SELECT * FROM trabajadores WHERE fecha_ingreso BETWEEN '$fecha1' AND '$fecha2' ORDER BY fecha_ingreso DESC
*/
                       

$sqlTrabajadores = ("SELECT * FROM trabajadores WHERE fecha_ingreso BETWEEN '$fechaInit' AND '$fechaFin' ORDER BY fecha_ingreso ASC");
$query = mysqli_query($con, $sqlTrabajadores);
?>


<table style="text-align: center;" border='1' cellpadding=1 cellspacing=1>
<thead>
    <tr style="background: #D0CDCD;">
    <th>#</th>
    <th class="color">NOMBRE</th>
    <th class="color">APELLIDO</th>
    <th class="color">EMAIL</th>
    <th class="color">TELEFONO</th>
    <th class="color">SUELDO</th>
    <th class="color">FECHA DE INGRESO</th>
    </tr>
</thead>
<?php
$i =1;
    while ($dataRow = mysqli_fetch_array($query)) { ?>
    <tbody>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $dataRow['nombre']; ?></td>
            <td><?php echo $dataRow['apellido']; ?></td>
            <td><?php echo $dataRow['email'] ; ?></td>
            <td><?php echo $dataRow['telefono'] ; ?></td>
            <td><?php echo $dataRow['sueldo'] ; ?></td>
            <td><?php echo $dataRow['fecha_ingreso'] ; ?></td>

        </tr>
    </tbody>
    
<?php } ?>
</table>

</body>
</html>