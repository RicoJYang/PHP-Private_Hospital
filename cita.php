<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>HG - Cita</title>
		<link rel="stylesheet" href="css/styles.css">
	</head>
	
	<body>
		<?php	
			error_reporting(E_ALL);
			ini_set('display_errors', '1');

			session_start();

			if(isset($_SESSION['login'])) 
			{			
				echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">	
						<select name="cars" size="3">
							<option value="">Dra. F. Hernandez</option>
							<option value="">Dr. J. Gayo</option>
							<option value="">Dra. M.L. Esquina</option>
							<option value="">Dr. A. Ruiperez</option>
						</select>
						<br>	
						<input type="date" name="fecha">
						<br>
						<input name="enviar" type="submit" value="RESERVAR CITA">	
					</form>	';
				
				session_destroy();
			} else
			{
				echo "Vaya a <a href='login.php'>este enlace</a> para identificarse antes de reservar una cita";
			}
		?>
	</body>
	
</html>