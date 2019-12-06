<?php
	
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set('display_errors', '1');




	$arrayHoras =  ["09:00:00", 
					"09:30:00", 
					"10:00:00", 
					"10:30:00", 
					"11:00:00", 
					"11:30:00", 
					"12:00:00", 
					"12:30:00", 
					"13:00:00", 
					"13:30:00"];

	
	

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
		echo 	"<select name='pacientes' required>";
		echo		"<option value='' selected disabled hidden>SELECCIONE EL PACIENTE</option>";

		while ($row = $resultado->fetch_array(MYSQLI_ASSOC))
		{
			echo "<option value=" . $row["DNI"] . ">" . $row["APELLIDO1"] . " " . $row["APELLIDO2"] . ", " . $row["NOMBRE"] . "</option>";
		}

		echo 	"</select>";
		echo "</div>";
		
		$conexion->close();
	}
	

	function getListaMedicos()
	{
		$conexion = getConexion();

		$consulta = "SELECT * FROM MEDICO";

		$resultado = $conexion->query($consulta, MYSQLI_USE_RESULT);

		echo "<div class='field control select is-primary'>";
		echo 	"<select name='medicos' required>";
		echo		"<option value='' selected disabled hidden>SELECCIONE EL MÉDICO</option>";

		while ($row = $resultado->fetch_array(MYSQLI_ASSOC))
		{
			echo "<option value=" . $row["CODIGO"] . ">" . $row["NOMBRE"] . "</option>";			
		}

		echo 	"</select>";
		echo "</div>";

		$conexion->close();
	}


	function mostrarHoras($codigo, $fecha)
	{
		global $arrayHoras;

		echo "<div class='field control select is-primary'>";
		echo 	"<select name='horas' required>";
		echo 		"<option value='' selected disabled hidden>SELECCIONE HORA</option>";		

		for ($i = 0; $i < 10; $i++)
		{			
			echo "<option value='" . $arrayHoras[$i] . "'>" . $arrayHoras[$i] . "</option>";			
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
			echo 	"<p>No se puede guardar. Error de conexion</p>";
		  	echo "</div>";
			exit();
		}

		$consulta = "INSERT INTO CONSULTA (COD_MEDICO, DNI_PACIENTE, HORA, FECHA) VALUES ('$medico', '$paciente', '$hora', '$fecha')";

		$resultado = $conexion->query($consulta);
		$conexion->close();

		return $resultado;		// Devuelve boolean que puedo usar al llamar la funcion para hacer comprobaciones
	}


	//--------------------------
	//	NOMBRE MEDICO

	function getNombreMedico($medico)
	{
		$conexion = getConexion();

		$consulta = "SELECT NOMBRE FROM MEDICO WHERE CODIGO = '" . $medico . "' LIMIT 1";
		$resultado = $conexion->query($consulta);
		
		while($row = $resultado->fetch_array(MYSQLI_ASSOC))
		{
			$nombre = $row["NOMBRE"];					
		}

		$conexion->close();

		return $nombre;
	}


	//--------------------------
	//	NOMBRE PACIENTE

	function getNombrePaciente($paciente)
	{
		$conexion = getConexion();

		$consulta = "SELECT * FROM PACIENTE WHERE DNI = '" . $paciente . "'";
		$resultado = $conexion->query($consulta);
		
		while($row = $resultado->fetch_array(MYSQLI_ASSOC))
		{
			$nombre = $row["NOMBRE"];
			$apellido1 = $row["APELLIDO1"];
			$apellido2 = $row["APELLIDO2"];
		}

		$conexion->close();

		return $nombre . " " . $apellido1 . " " . $apellido2;
	}


	//--------------------------
	//	EMAIL PACIENTE

	function getEmailPaciente($paciente)
	{
		$conexion = getConexion();

		$consulta = "SELECT * FROM PACIENTE WHERE DNI = '" . $paciente . "'";
		$resultado = $conexion->query($consulta);
		
		while($row = $resultado->fetch_array(MYSQLI_ASSOC))
		{
			$email = $row["EMAIL"];					
		}

		$conexion->close();

		return $email;
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
		
		return $resultado; 
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

	function getDisponibilidad($codigo, $fecha)
	{
		global $arrayHoras;

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
		
		$valueMed = getNombreMedico($codigo);
		
		echo "<p>CONSULTAS DE " . $valueMed . "</p>";		
		echo "<p>FECHA: " . $fecha . "</p>";

		echo "<table class='table'>";
		echo 	"<thead>";
		echo 		"<tr>";
		echo 			"<th>HORA</th>";
		echo 			"<th>DISPONIBILIDAD</th>";		
		echo 		"</tr>";
		echo 	"</thead>";
		echo 	"<tbody>";

		$iterador = 0;
		$ocupadas = [];
		while($row = $resultado->fetch_array(MYSQLI_ASSOC))
		{
			$ocupadas[$iterador] = $row["HORA"];
			$iterador++;
		}
		
		$disponibles = array_diff($arrayHoras, $ocupadas);
		
		for ($i = 0; $i < 10; $i++)
		{			
			echo "<tr>";
			echo 	"<td>" . $arrayHoras[$i] . "</td>";			
			if (in_array($arrayHoras[$i], $disponibles))
			{
				echo "<td class='available'>DISPONIBLE</td>";
			}
			else
			{
				echo "<td class='not-available'>NO DISPONIBLE</td>";
			}
		}
			echo "</tr>";
		echo 	"</tbody>";
		echo "</table>";

				
		$conexion->close();		
	}	
?>