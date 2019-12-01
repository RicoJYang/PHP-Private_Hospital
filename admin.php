<?php require "html/header.php" ?>
	
				
					CONFIGURACIÓN
				</h2>
			</header>

			<div class="form section">				

				<?php
					session_start();					
					if($_SERVER["REQUEST_METHOD"] == "POST")
					{
						if (isset($_POST["alta"]))
						{						
							$_SESSION["ejecutar"] = "alta";
							header('Location: ' . 'admin_consulta.php');
						} 
						else if (isset($_POST["baja"]))
						{
							$_SESSION["ejecutar"] = "baja";
							header('Location: ' . 'admin_consulta.php');
						}
						else
						{
							$_SESSION["ejecutar"] = "disponibilidad";
							header('Location: ' . 'admin_consulta.php');
						}
						
					}
					else
					{
					echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
					echo 	"<input class='button is-link' type='submit' name='alta' value='NUEVO MÉDICO'>";
					echo 	"<input class='button is-link' type='submit' name='baja' value='ELIMINAR MÉDICO'>";
					echo 	"<input class='button is-link' type='submit' name='disponibilidad' value='DISPONIBILIDAD'>";
					echo "</form>";
					}					
				?>
				<div class="section">
					<a class="button is-link red" href="logout.php">SALIR</a>
				</div>
				
			</div>

		<?php include "html/footer.php" ?>