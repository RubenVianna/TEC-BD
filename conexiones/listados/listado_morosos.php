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
    function listar_morosos( $conexion)
    {
        

            $sql = "select * from DBA_TP.vista_morosos";
			$filas = 0;
         $stmt = oci_parse($conexion, $sql); // Preparar la sentencia
         $ok = oci_execute( $stmt );         // Ejecutar la sentencia
        
        if( $ok == true )
        {
            echo "<table border='1'>";
                         echo '<tr> NROPRESTAMO <td>  </td>'; 
                         echo '<td> NROCUOTA </td>'; 
                         echo '<td> DEUDA </td>'; 
                         echo '<td> TITULAR  </td>';
                         echo '<td> TELEFONO </td>'; 
                         echo '<td> GARANTE </td>'; 
                         echo '<td> TELEFONO </td>';
                          
                         
        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS))  
        {
            echo "<tr>";
            echo '<td>' . $row['NROPRESTAMO'] . '</td>';
            echo '<td>' . $row['NROCUOTA'] . '</td>';
            echo '<td>' . $row['DEUDA'] . '</td>';
            echo '<td>' . $row['TITULAR'] . '</td>';
            echo '<td>' . $row['TELTITULAR'] . '</td>';
            echo '<td>' . $row['GARANTE'] . '</td>';
            echo '<td>' . $row['TELGARANTE'] . '</td>';
            echo "</tr>";
        }

                              


                
                // Mostrar el número de registros:
                 echo "<p>(".oci_num_rows($stmt).") moroso(s) encontrado(s)</p>";
                 
        }
        else
            $ok = false;
         oci_free_statement($stmt);    // Liberar los recursos asociados a una sentencia o cursor
        return $ok;
    }
?>

<?php
echo "<p/>Listado Morosos: <br/>";
$con = conectar_Oracle($user,$pas);
$listado = listar_morosos( $con);

?>



</body>
</html>