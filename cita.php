	<?php require "html/header.php" ?>
	<?php include "conexionBBDD.php" ?>
	

					RESERVAR UNA CITA
				</h2>				
			</header>
			
			<div class="form section">				

				<form action="payment.php" method="post">

					<?php	
						error_reporting(E_ALL ^ E_NOTICE);
						ini_set('display_errors', '1');

						include("sql.php");
						
						getListaPacientes();

						getListaMedicos();
					?>					

					<input class="input date is-primary" type="date" name="fecha" value="<?php>date('Y-m-d')?>" min="<?php>date('Y-m-d')?>" max="2019-12-31">

					<div class="field control select is-primary">
						<select name="horas">
							<option value='' selected disabled hidden>ELIJA HORA</option>
							<option value='09:00'>09:00</option>
							<option value='09:30'>09:30</option>
							<option value='10:00'>10:00</option>
							<option value='10:30'>10:30</option>
							<option value='11:00'>11:00</option>
							<option value='11:30'>11:30</option>
							<option value='12:00'>12:00</option>
							<option value='12:30'>12:30</option>
							<option value='13:00'>13:00</option>
							<option value='13:30'>13:30</option>
						</select>
					</div>

					<input class="button is-link" type="submit" value="RESERVAR Y PAGAR">
					<input type="hidden" name="accion" value="guardar_cita">

					<a class="button is-link red" href="logout.php">SALIR</a>					

				</form>

				<?php

					if ($_POST["accion"] == "guardar_cita")
					{
						include("sql.php");

						if (isset($_POST["pacientes"]) && isset($_POST["medicos"]) && isset($_POST["horas"]))
						{								
							$paciente = $_POST["pacientes"];
							$medico = $_POST["medicos"];
							$hora = $_POST["horas"];
							$fecha = $_POST["fecha"];

							if (!($medico && $paciente))
							{
								echo "<div class='notification is-warning'>";									
								echo 	"<p>Tiene que elegir médico y paciente</p>";
								echo "</div>";
							}
							else if (setCita($medico, $paciente, $hora, $fecha))
							{
								echo "<div class='notification is-success'>";																		
								echo 	"<p>Reserva realizada con éxito</p>";
								echo "</div>";
							}
							else 
							{
								echo "<div class='notification is-danger'>";									
								echo 	"Esa hora no está libre";
								echo "</div>";
							}
						}													
					}
				?>

			</div>

			<?php require "html/footer.php" ?>