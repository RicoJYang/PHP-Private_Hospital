<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>HG - Acceso</title>
		<link rel="stylesheet" href="css/styles.css">
	</head>
	
	<body>
		<div class="formulario">
		<?php	
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
			
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				echo "<h1>Hello there Mr/Ms " . $_REQUEST['apellido'] . " [" . $_REQUEST['nif'] . "]" . "</h1><br>";				
				echo "<a href='.php'>Entrar al portal.</a>";				
				session_start();
				$_SESSION['login'] = 0;
			}else
			{
				echo 	'<form method="post" action="' . $_SERVER['PHP_SELF'] . '">														
							<label for="apellido">Apellido</label>
							<input type="text" name="apellido">
							<br>
							<label for="nif">NIF/NIE</label>
							<input type="text" name="nif">
							<br>
							<input name="enviar" type="submit" value="DALE CANDELA">							
						</form>	';
			}			
		?>	
		</div>
	</body>
	
</html>