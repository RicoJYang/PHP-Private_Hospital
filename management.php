<?php require "html/header.php" ?>
	
				
					CONFIGURACIÓN INTERNA
				</h2>
			</header>

			<div class="form section">

				<?php
					error_reporting(E_ALL ^ E_NOTICE);
					ini_set('display_errors', '1');
					
					session_start();
					
					if (isset($_SESSION["settings"]))
					{
						echo "<a class='button is-link' href='?accion=alta'>NUEVO</a>";
						echo "<a class='button is-link' href='?accion=baja'>ELIMINAR</a>";
						echo "<a class='button is-link' href='?accion=disponibilidad'>DISPONIBILIDAD</a>";
						echo "<a class='button is-link red' href='logout.php'>SALIR</a>";

						session_destroy();
					} else
					{
						echo "<p>No puede acceder a este servicio</p>";
						echo "<p>Pinche<a href='index.php'>aquí</a>para volver a la página principal.</p>";
					}
				?>				

				<div class="form section">
					
					<?php

						//	ALTA

						if ($_GET["accion"] == "alta")
						{
							echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
							echo 	"<input class='input' type='text' pattern='[0-9]{1,2}' name='codigoAlta' placeholder='CÓDIGO'>";
							echo 	"<input class='input' type='text' pattern='(?i)[a-z]{1,30}' name='nombreAlta' placeholder='NOMBRE'>";
							echo 	"<input class='button is-link' type='submit' value='NUEVO MÉDICO'>";
							echo 	"<input type='hidden' name='accion' value='realizar_alta'>";
							echo "</form>";					
						}						

						if ($_POST["accion"] == "realizar_alta")
						{
							include("sql.php");

							if (isset($_POST["codigoAlta"]) && isset($_POST["nombreAlta"]))
							{
								$codigo = $_POST["codigoAlta"];
								$nombre = $_POST["nombreAlta"];

								if (!($codigo && $nombre))
								{
									echo "<div class='notification is-warning'>";									
									echo 	"<p>Tiene que introducir los datos</p>";
									echo "</div>";
								}
								else if (alta($codigo, $nombre))
								{
									echo "<div class='notification is-success'>";																		
									echo 	"<p>Médico guardado con éxito</p>";
									echo "</div>";
								}
								else 
								{
									echo "<div class='notification is-danger'>";									
									echo 	"Ya existe un médico con ese código";
									echo "</div>";
								}
							}													
						}


						//	BAJA

						if ($_GET["accion"] == "baja")
						{
							include("sql.php");

							echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";

									getListaMedicos();

							echo 	"<input class='button is-link' type='submit' value='ELIMINAR MÉDICO'>";
							echo 	"<input type='hidden' name='accion' value='realizar_baja'>";
							echo "</form>";
						}
						
						if ($_POST["accion"] == "realizar_baja")
						{
							include("sql.php");

							$codigo = $_POST["medicos"];

							if (baja($codigo))
							{
								echo "<div class='notification is-success'>";																		
								echo 	"<p>Médico borrado con éxito</p>";
								echo "</div>";
							} else
							{
								echo "<div class='notification is-warning'>";																		
								echo 	"<p>Debe seleccionar un médico</p>";
								echo	"<p>o</p>";
								echo 	"<p>El médico seleccionado no se puede borrar porque tiene consultas pendientes</p>";
								echo "</div>";
							}
						}


						//	CONSULTA

						if ($_GET["accion"] == "disponibilidad")
						{
							include("sql.php");

							echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";

									getListaMedicos();

							echo 	"<input class='input date is-primary' type='date' name='fecha' value='" . date('Y-m-d') . "' min='" . date('Y-m-d') . "' max='2019-12-31'>";
							echo 	"<input class='button is-link' type='submit' value='COMPROBAR DISPONIBILIDAD'>";
							echo 	"<input type='hidden' name='accion' value='realizar_consulta'>";
							echo "</form>";
						}

						if ($_POST["accion"] == "realizar_consulta")
						{
							include("sql.php");

							$medico = $_POST["medicos"];
							$fecha = $_POST["fecha"];														

							if (isset($_POST["medicos"]))
							{
								$codigo = $_POST["medicos"];
								consultaDisponibilidad($medico, $codigo, $fecha);
							} else
							{
								echo "<div class='notification is-warning'>";																		
								echo 	"<p>Debe seleccionar un médico</p>";								
								echo "</div>";
							}
						}						
					?>

				</div>
			</div>

			<?php include "html/footer.php" ?>