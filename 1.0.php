<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ejercicio 7.1</title>		
	</head>
	<body>	
		<?php	
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
			
			include("conexion_agenda.php");
			
			$consulta = "SELECT * FROM agenda;";
			
			if(!($peticion = mysql_query($consulta, $conx)))
			{
				echo "Peticion mal.";
			}else
			{
				$info = mysql_fetch_array($peticion);
				foreach($info as $i)
				{
					echo $i;
					echo "<br>";
				}
			}	
		?>	
		
	</body>
</html>
