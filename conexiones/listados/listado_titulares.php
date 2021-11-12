<html>
<body>



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
    function listar_titulares( $conexion)
    {
        

            $sql = "select * from DBA_TP.vista_titulares";
            $filas = 0;
         $stmt = oci_parse($conexion, $sql); // Preparar la sentencia
         $ok = oci_execute( $stmt );         // Ejecutar la sentencia
        
        if( $ok == true )
        {
            echo "<table border='1'>";
                         echo '<tr> <td> NRODOCUMENTO   </td>'; 
                         echo '<td> APELLIDO </td>'; 
                         echo '<td> NOMBRE </td>'; 
                         echo '<td> FNACIMIENTO  </td>';
                         echo '<td> DIRECCION </td>'; 
                         echo '<td> INGRESOS TOTALES </td>'; 
                         echo '<td> CANT. FAMILIARES </td>'; 
                         echo '<td> INGRESOS RETENIDOS </td>';
                         echo '<td> TELEFONOS </td>';
                         
                          
                         
        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS))  
        {
            echo "<tr>";
            echo '<td>' . $row['NRODOCUMENTOP'] . '</td>';
            echo '<td>' . $row['APELLIDO'] . '</td>';
            echo '<td>' . $row['NOMBRE'] . '</td>';
            echo '<td>' . $row['FNACIMIENTO'] . '</td>';
            echo '<td>' . $row['DIRECCION'] . '</td>';
            echo '<td>' . $row['INGRESOSTOTALES'] . '</td>';
            echo '<td>' . $row['CANTFAMILIARES'] . '</td>';
            echo '<td>' . $row['INGRESOSRETENIDOS'] . '</td>';
            echo '<td>' . $row['TELEFONOS'] . '</td>';
           
            echo "</tr>";
        }

                              


                
                // Mostrar el número de registros:
                 echo "<p>(".oci_num_rows($stmt).") titular(es) encontrado(s)</p>";
                 
        }
        else
            $ok = false;
         oci_free_statement($stmt);    // Liberar los recursos asociados a una sentencia o cursor
        return $ok;
    }
?>

<?php
echo "<p/>Listado de Titulares: <br/>";
$con = conectar_Oracle($user,$pas);
$listado = listar_titulares( $con);

?>



</body>
</html>