<html>
<body>

<form method="post">

<label>Fechainicio :<input type="text" name="fecha1" size="11" value= ""></label>
<label>Fechafin :<input type="text" name="fecha2" size="11" value=""> </label>
<input type="submit" name="ingresar" value="Ingresar Fecha">

</form>

<?php
session_start();
$user= $_SESSION['user'];
$pas= $_SESSION['pas'];
    function conectar_Oracle( $user, $pas)
    {
        // Conectar con Oracle:
         $conexion = oci_connect($user, $pas) or die ( "Error al conectar : ".oci_error() );
        return $conexion;
    }
?>

<?php
	error_reporting(0);
    function importescobrados( $conexion, $fechaini, $fechafin)
    {
        

            $sql = "select * from DBA_TP.vista_importescobrados WHERE (fechapago >='" .$fechaini ."' AND fechapago<= '" .$fechafin."') order by fechapago ";
			$filas = 0;
         $stmt = oci_parse($conexion, $sql); // Preparar la sentencia
         $ok = oci_execute( $stmt );         // Ejecutar la sentencia
        
        if( $ok == true )
        {
            echo "<table border='1'>";
                         echo '<tr><td> FECHA DE PAGO </td>'; 
                         echo '<td> NRO DE PRESTAMO </td>'; 
                         echo '<td> CUOTAS PAGADAS </td>'; 
                         echo '<td> IMPORTE  </td>';
                         $acu=0; 
                         
        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS))  
        {
            echo "<tr>";
            echo '<td>' . $row['FECHAPAGO'] . '</td>';
            echo '<td>' . $row['NROPRESTAMO'] . '</td>';
            echo '<td>' . $row['CUOTASPAGADAS'] . '</td>';
            echo '<td>' . $row['IMPORTECOBRADO'] . '</td>';
            $acu+= $row['IMPORTECOBRADO'];
            echo "</tr>";
        }

                                            
                // Mostrar el número de registros:
                 echo "<p>(".oci_num_rows($stmt).") fila(s) encontrado(s)</p>";
                 echo "<p>Total recaudado: $".$acu." </p>";
        }
        else
            $ok = false;
         oci_free_statement($stmt);    // Liberar los recursos asociados a una sentencia o cursor
        return $ok;
    }
?>

<?php
if(isset($_REQUEST['ingresar'])){
$fechaini=$_POST['fecha1'];
$fechafin=$_POST['fecha2'];
echo "<p/>Periodo comprendido: <br/>";
echo "desde el " .$fechaini. "       hasta el " .$fechafin. "<p/>";
$con = conectar_Oracle($user,$pas);
$importescobrados = importescobrados( $con , $fechaini, $fechafin);
}
?>

</body>
</html>