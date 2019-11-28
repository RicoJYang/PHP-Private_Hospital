<?php require "html/header.php" ?>
	
				
					CONFIGURACIÓN INTERNA
				</h2>
			</header>

			<div class="form section">
				
				<?php						
					echo "<a class='button is-link' href='?accion=alta'>NUEVO</a>";
					echo "<a class='button is-link' href='?accion=baja'>ELIMINAR</a>";
					echo "<a class='button is-link' href='?accion=disponibilidad'>DISPONIBILIDAD</a>";
					echo "<a class='button is-link red' href='logout.php'>SALIR</a>";
				?>

				<div class="form section">
					
					<?php


						//	ALTA

						if ($_GET["accion"] == "alta")
						{
							echo "<form action='management.php' method='post'>";
							echo 	"<input class='input' type='text' pattern='[0-9]{1,2}' name='codigoAlta' placeholder='CÓDIGO'>";
							echo 	"<input class='input' type='text' pattern='[a-z]{1,30}' name='nombreAlta' placeholder='NOMBRE'>";
							echo 	"<input class='button is-link' type='submit' value='NUEVO MÉDICO'>";
							echo 	"<input type='hidden' name='accion' value='realizar_alta'>";
							echo "</form>";							
						}						

						if ($_GET["accion"] == "realizar_alta")
						{
							include("sql.php");

							$codigo = $_GET["codigoAlta"];
							$nombre = $_GET["nombreAlta"];

							alta($codigo, $nombre);			
						}


						//	BAJA

						if ($_GET["accion"] == "baja")
						{
							include("sql.php");

							echo "<form action='management.php' method='post'>";

									getListaMedicos();

							echo 	"<input class='button is-link' type='submit' value='ELIMINAR MÉDICO'>";
							echo 	"<input type='hidden' name='accion' value='realizar_baja'>";
							echo "</form>";
						}
						
						if ($_GET["accion"] == "realizar_baja")
						{
							include("sql.php");

							$codigo = $_GET["codigoAlta"];							

							baja($codigo);
						}


						//	CONSULTA

						if ($_GET["accion"] == "disponibilidad")
						{
							include("sql.php");

							echo "<form action='management.php' method='post'>";

									getListaMedicos();

							echo 	"<input class='input date is-primary' type='date' name='fecha' value='" . date('Y-m-d') . "' min='" . date('Y-m-d') . "' max='2019-12-31'>";
							echo 	"<input class='button is-link' type='submit' name='consultar' value='COMPROBAR DISPONIBILIDAD'>";
							echo 	"<input type='hidden' name='accion' value='realizar_consulta'>";
							echo "</form>";
						}

						if ($_GET["accion"] == "realizar_consulta")
						{
							include("sql.php");

							$codigo = $_GET["codigoAlta"];							
							$fecha = $_GET["fecha"];

							consultaDisponibilidad($codigo);
						}
					?>

				</div>
			</div>

			<?php include "html/footer.php" ?>