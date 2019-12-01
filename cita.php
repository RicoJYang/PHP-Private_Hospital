	<?php require "html/header.php" ?>
	<?php include "conexionBBDD.php" ?>
	

				RESERVAR UNA CITA
			</h2>				
		</header>
		
		<div class="form section">				

			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

				<?php	
					error_reporting(E_ALL ^ E_NOTICE);
					ini_set('display_errors', '1');

					include("sql.php");
					
					getListaPacientes();

					getListaMedicos();
				?>

				<input class="input date is-primary" type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" max="2019-12-31">

				<?php								
					mostrarHoras($medico, $fecha);
				?>

				<input class="button is-link" type="submit" value="RESERVAR Y PAGAR">
				<input type="hidden" name="accion" value="guardar_cita">										
			</form>

			<div>
				<a class="button is-link red" href="logout.php">SALIR</a>
			</div>
			
			<?php

				if ($_POST["accion"] == "guardar_cita")
				{						
					if (isset($_POST["medicos"]) && isset($_POST["pacientes"]) && isset($_POST["horas"]))
					{						
						$medico = $_POST["medicos"];
						$paciente = $_POST["pacientes"];						
						$fecha = $_POST["fecha"];
						$hora = $_POST["horas"];

						if (setCita($medico, $paciente, $hora, $fecha))
						{
							session_start();
							
							$_SESSION["medico"] = $medico;
							$_SESSION["paciente"] = $paciente;
							$_SESSION["fecha"] = $fecha;
							$_SESSION["hora"] = $hora;

							header('Location: ' . 'payment.php');
						}
						else
						{
							echo "<div class='notification is-danger'>";
							echo 	"<p>El médico seleccionado no está disponible a las " . $hora . "</p>";
							echo "</div>";
						}
					}												
				}
			?>

		</div>

	<?php require "html/footer.php" ?>