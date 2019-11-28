<?php
	
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set('display_errors', '1');
	

	//--------------------------
	//	CONEXION

	function getConexion()
	{	

		$mysqli = new mysqli("localhost", "root", "rootroot", "hospital");
		$mysqli->set_charset("utf8");

		if ($mysqli->connect_error)
		{
			echo "Error de conexión (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			return 0;
		}
		return $mysqli;
	}


	//--------------------------
	//	FUNCIONES LISTA

	function getListaPacientes()
	{

		$conexion = getConexion();

		$consulta = "SELECT * FROM PACIENTE";

		$resultado = $conexion->query($consulta, MYSQLI_USE_RESULT);

		echo "<div class='field control select is-primary'>";
		echo 	"<select name='pacientes'>";
		echo		"<option value='' selected disabled hidden>SELECCIONE EL PACIENTE</option>";

		while ($row = $resultado->fetch_array(MYSQLI_ASSOC))
		{
			echo "<option value=" . $row["DNI"] . ">" . $row["APELLIDO1"] . " " . $row["APELLIDO2"] . ", " . $row["NOMBRE"] . "</option>";
		}

		echo 	"</select>";
		echo "</div>";
		
	}
	

	function getListaMedicos()
	{

		$conexion = getConexion();

		$consulta = "SELECT * FROM MEDICO";

		$resultado = $conexion->query($consulta, MYSQLI_USE_RESULT);

		echo "<div class='field control select is-primary'>";
		echo 	"<select name='medicos'>";
		echo		"<option value='' selected disabled hidden>SELECCIONE EL MÉDICO</option>";

		while ($row = $resultado->fetch_array(MYSQLI_ASSOC))
		{
			echo "<option value=" . $row["CODIGO"] . ">" . $row["NOMBRE"] . "</option>";			
		}

		echo 	"</select>";
		echo "</div>";
	}


	//--------------------------
	//	RESERVAR CITA

	function setCita($medico, $paciente, $hora, $fecha)
	{
		$conexion = getConexion();

		if (!$conexion)
		{
			echo "<div class='notification is-warning'>";			
			echo 	"<p>No se puede dar de alta. Error de conexion</p>";
		  	echo "</div>";
			exit();
		}

		$consulta = "INSERT INTO CONSULTA (COD_MEDICO, DNI_PACIENTE, HORA, FECHA) VALUES ('$medico', '$paciente', '$hora', '$fecha')";

		$resultado = $conexion->query($consulta);
		$conexion->close();

		return $resultado;
	}


	//--------------------------
	//	ALTA

	function alta ($codigo, $nombre)
	{
		$conexion = getConexion();

		if (!$conexion)
		{
			echo "<div class='notification is-warning'>";			
			echo 	"<p>No se puede dar de alta. Error de conexion</p>";
		  	echo "</div>";
			exit();
		}

		$codigo = strtoupper($codigo);
		$nombre = "DR./DRA. " . strtoupper($nombre);

		$consulta = "INSERT INTO MEDICO (CODIGO, NOMBRE) VALUES ('$codigo', '$nombre')";

		$resultado = $conexion->query($consulta);
		$conexion->close();
		
		return $resultado; // Devuelve boolean que puedo usar al llamar la funcion para hacer comprobaciones
	}


	//--------------------------
	//	BAJA

	function baja ($codigo)
	{
		$conexion = getConexion();

		if (!$conexion)
		{
			echo "<div class='notification is-warning'>";			
			echo 	"<p>No se puede dar de alta. Error de conexion</p>";
		  	echo "</div>";
			exit();
		}

		$consulta = "DELETE FROM MEDICO WHERE CODIGO = $codigo";		

		$resultado = $conexion->query($consulta);
		$conexion->close();

		return $resultado;		
	}


	//--------------------------
	//	CONSULTA DISPONIBILIDAD

	function consultaDisponibilidad($medico, $codigo, $fecha)
	{
		$conexion = getConexion();

		if (!$conexion)
		{
			echo "<div class='notification is-warning'>";
			echo 	"<p>No se puede dar de alta. Error de conexion</p>";
		  	echo "</div>";
			exit();
		}

		$consulta = "SELECT * FROM CONSULTA WHERE COD_MEDICO = '" . $codigo . "' AND FECHA = '" . $fecha . "'";		
		$resultado = $conexion->query($consulta, MYSQLI_USE_RESULT);

		$consultaMed = "SELECT * FROM MEDICO WHERE CODIGO = '" . $codigo . "'";		

		echo "<p>CONSULTAS DE " . $codigo . "</p>";
		echo "<p>FECHA: " . $fecha . "</p>";

		echo "<table class='table'>";
		echo 	"<thead>";
		echo 		"<tr>";
		echo 			"<th>HORA</th>";
		echo 			"<th>PACIENTE</th>";		
		echo 		"</tr>";
		echo 	"</thead>";
		echo 	"<tbody>";		

		while($row = $resultado->fetch_array(MYSQLI_ASSOC))
		{
			echo "<tr>";
			echo "<td>" . $row["HORA"] . "</td>";
			echo "<td>" . $row["DNI_PACIENTE"] . "</td>";						
			echo "</tr>";
		}
		
		echo 	"</tbody>";
		echo "</table>";

				
		$conexion->close();		
	}
	
?>
 
