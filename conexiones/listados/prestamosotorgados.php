<html>
<body>

<form method="post">

<label>Fechainicio :<input type="text" name="fecha1" size="11" value= ""></label>
<label>Fechafin :<input type="text" name="fecha2" size="11" value="" > </label>
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
    function prestamosotorgados( $conexion, $fecha1, $fecha2)
    {
        
            $sql = "select * from DBA_TP.vista_prestamosotorgados WHERE (FECHA_ALTA >='" .$fecha1 ."' AND FECHA_ALTA <= '" .$fecha2."' )";
			$filas = 0;
         $stmt = oci_parse($conexion, $sql); // Preparar la sentencia
         $ok = oci_execute( $stmt );         // Ejecutar la sentencia
        
        if( $ok == true )
        {
            /* Mostrar los datos. Lo hacemos de este modo puesto que no es posible obtener el número de
               registros sin antes haber accedido a los datos mediante las funciones 'oci_fetch_*'):
            */
             /*if( $obj = oci_fetch_object($stmt) )
            {*/
                
                // Recorrer el resource y mostrar los datos (HAY QUE PONER LOS NOMBRES DE LOS CAMPOS EN MAYÚSCULAS):
                 
                             
                             /* <table>
                                <tr>
                                 <th> Fecha de alta </th>; // ac� encabezado de la tabla columna 1
                                 <th> Nro Prestamo </th>; // encabezado de la tabla columna 2
                                 <th> Titular </th>; // ac� encabezado de la tabla columna 1
                                 <th> Teléfono </th>; // encabezado de la tabla columna 2
                                <tr><th> Garante </th>; // ac� encabezado de la tabla columna 1
                                <th> Teléfono  </th>; // encabezado de la tabla columna 2
                                </tr>
                                do
                                {
                                    <tr>
                                    <td>  echo $obj->FEHCA_ALTA  </td>;
                                    <td>  echo $obj->NROPRESTAMO  </td>;
                                    <td>  echo$obj->TITULAR </td>;
                                    <td>  echo$obj->TELTITULAR  </td>;
                                    <td>  echo $obj->NROPRESTAMOGARANTE  </td>;
                                    <td>  echo $obj->NROPRESTAMOTELGARANTE  </td>;
                                    </tr>
                                } while( $obj = oci_fetch_object($stmt) );
                            </table> "*/
                             // C�digo php para cargar una tabla
                         echo "<table border='1'>";
                         echo '<tr><td> FECHA DE ALTA </td>'; // ac� encabezado de la tabla columna 1
                         echo '<td> NRO DE PRESTAMO </td>'; // encabezado de la tabla columna 2
                         echo '<td> TITULAR </td>'; // ac� encabezado de la tabla columna 1
                         echo '<td> NRO TELEFONO </td>'; // encabezado de la tabla columna 2
                         echo '<td> GARANTE </td>'; // ac� encabezado de la tabla columna 1
                         echo '<td> TELEFONO </td></tr>'; // encabezado de la tabla columna 2
        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS))  
        {
            echo "<tr>";
            echo '<td>' . $row['FECHA_ALTA'] . '</td>';
            echo '<td>' . $row['NROPRESTAMO'] . '</td>';
            echo '<td>' . $row['TITULAR'] . '</td>';
            echo '<td>' . $row['TELTITULAR'] . '</td>';
            echo '<td>' . $row['GARANTE'] . '</td>';
            echo '<td>' . $row['TELGARANTE'] . '</td>';
            echo "</tr>";
        }

                              


                
                // Mostrar el número de registros:
                 echo "<p>(".oci_num_rows($stmt).") fila(s) encontrado(s)</p>";
            /*}
            else
                echo "<p>No se otorgaron prestamos en ese periodo</p>";'*/
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
$importescobrados = prestamosotorgados( $con , $fechaini, $fechafin);
}



?>



</body>
</html>