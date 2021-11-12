 <html>
    <head>
     
     <?php
     session_start();
     $user= $_SESSION['user'];
     $pas= $_SESSION['pas'];
     echo $user;
     echo "<br>";
     echo $pas;
     ?>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/cambiarPestanna.js"></script>
        
        <title>MENU PRINCIPAL</title>
    </head>
 <body onload="javascript:cambiarPestanna(pestanas,pestana1);" />
      <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <div class="contenedor">
            <div class="titulo">Sistema Gestion</div>
            <div id="pestanas">
                <ul id=lista>
                    <li id="pestana1"><a href='javascript:cambiarPestanna(pestanas,pestana1);'>Titular</a></li>
                    <li id="pestana2"><a href='javascript:cambiarPestanna(pestanas,pestana2);'>Prestamo</a></li>
                 	<li id="pestana7"><a href='javascript:cambiarPestanna(pestanas,pestana7);'>	Listados</a></li>
                </ul>
            </div>
            
            
       
            <div id="contenidopestanas">
                <div id="cpestana1">
                         <p><a href="listados/listado_titulares.php" target="_blank"> Listado Titulares</a></p>        
                  
                </div>
                <div id="cpestana2">
                  
                </div>
               
				<div id="cpestana7">
					<p><a href="listados/importescobrados.php" target="_blank"> Importes cobrados</a></p>
                    <p><a href="listados/cajadiaria.php" target="_blank"> Caja Diaria</a></p>
                    <p><a href="listados/prestamosotorgados.php" target="_blank"> Prestamos Otorgados</a></p>
                    <p><a href="listados/listado_morosos.php" target="_blank"> Listado Morosos</a></p>
                    <p><a href="listados/listado_titulares.php" target="_blank"> Listado Titulares</a></p>
                    <p><a href="listados/listado_garantes.php" target="_blank"> Listado Garantes</a></p>


                                       
                </div>
            </div>
        </div>
		 </html>