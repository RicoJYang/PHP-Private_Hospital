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
		echo 	"<select id='pacientes'>";

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
		echo 	"<select id='medicos'>";

		while ($row = $resultado->fetch_array(MYSQLI_ASSOC))
		{
			echo "<option value=" . $row["CODIGO"] . ">" . $row["NOMBRE"] . "</option>";			
		}

		echo 	"</select>";
		echo "</div>";
	}



	//--------------------------
	//	ALTA

	function alta ($codigo, $nombre)
	{
		$conexion = getConexion();

		if (!$conexion)
		{
			echo "<div class='notification is-warning'>";
			echo 	"<button class='delete'/>";
			echo 	"No se puede dar de alta. Error de conexion";
		  	echo "</div>";
			exit();
		}

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
			echo 	"<button class='delete'/>";
			echo 	"No se puede dar de baja. Error de conexion";
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

	function consultaDisponibilidad($codigo)
	{
		$conexion = getConexion();

		if (!$conexion)
		{
			echo "<div class='notification is-warning'>";
			echo 	"<button class='delete'/>";
			echo 	"No se puede consultar. Error de conexion";
		  	echo "</div>";
			exit();
		}

		$consulta = "SELECT * FROM  WHERE COD_MEDICO = $CODIGO";
		$resultado = $conexion->query($consulta, MYSQLI_USE_RESULT);

		echo "<table>";
		echo 	"<thead>";
		echo 		"<tr>";
		echo 			"<th>HORA</th>";
		echo 			"<th>DISPONIBILIDAD</th>";
		echo 		"</tr>";
		echo 	"</thead>";
		echo 	"<tbody>";		

		while($row = $resultado->fetch(MYSQLI_ASSOC))
		{
			echo "<tr>";
			echo "<td>" . $row[""];
			echo "</tr>";
		}
		
		echo 	"</tbody>";






		
		

		$resultado = $conexion->query($consulta);
		$conexion->close();

		return $resultado;
	}
	
?>
 
