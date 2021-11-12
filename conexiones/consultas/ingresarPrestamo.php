<html>
<body>
                         <form method="post">
                          <input type="submit" name="ingresar" value="Ingresar">
                          <div>
                        <h1>Ingresar Prestamo</h1>
                        <table border='1' >
                        <tr><td> NRODOCUMENTO </td>
                        <td> CAPITAL </td>
                        <td> CANTIDAD DE CUOTAS </td> 
                        <td> % INTERES ANUAL </td> 
                        <td> VENCIMIENTO MENSUAL </td> 
                        <td> NRODOCUMENTO DEL GARANTE </td>
                        <tr>
                        <td> <input type="text" name="nrodocumento" size="11"  ></td>
                        <td> <input type="text" name="capital" size="11" ></td>
                        <td> <input type="text" name="cantcuotas" size="11" ></td>
                        <td> <input type="text" name="intanual" size="11" ></td>
                        <td> <input type="text" name="vtomensual" size="11" value=""></td>
                        <td> <input type="text" name="nrodocumentog" size="11"></td>
                        </div> 
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


    function IngresarPrestamo( $conexion, $nrodocumento, $capital, $cantcuotas, $intanual, $vtomensual, $nrodocumentog)
    {
        

         $sql = " call DBA_TP.pro_crear_prestamo(".$nrodocumento.",  ".$capital.", ".$cantcuotas.", ".$intanual.", ".$vtomensual.", ".$nrodocumentog.")";
                        
         $stmt = oci_parse($conexion, $sql); // Preparar la sentencia
         $ok = oci_execute( $stmt );


         if( $ok == true )
        {
            echo "<p>El prestamo se ha ingresado correctamente </p>";
        }
         oci_free_statement($stmt);    // Liberar los recursos asociados a una sentencia o cursor
         
        return $ok;
    }

       
               if(isset($_REQUEST['ingresar']))
               {

                                $nrodocumento=$_POST['nrodocumento'];
                                $capital=$_POST['capital'];
                                $cantcuotas=$_POST['cantcuotas'];
                                $intanual=$_POST['intanual'];
                                $vtomensual=$_POST['vtomensual'];
                                $nrodocumentog=$_POST['nrodocumentog'];
                                 $con = conectar_Oracle($user,$pas);
                                 $ingresarUnPrestamo = IngresarPrestamo($con, $nrodocumento,  $capital, $cantcuotas, $intanual, $vtomensual, $nrodocumentog);
                                
                }
               

        
?>

</body>
</html>