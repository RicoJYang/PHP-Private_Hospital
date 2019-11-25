	<?php require "html/header.php" ?>
	<?php include "conexionBBDD.php" ?>
	

					BIENVENIDO, <?php echo $login_session ?>
				</h2>				
			</header>
			
			<div class="form section">
				<?php	
					error_reporting(E_ALL ^ E_NOTICE);
					ini_set('display_errors', '1');
										

					echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">	
							<select class="select" name="medico" size="4">
								<option value="1">Dra. F. Hernandez</option>
								<option value="2">Dr. J. Gayo</option>
								<option value="3">Dra. M.L. Esquina</option>
								<option value="4">Dr. A. Ruiperez</option>
							</select>								

							<select class="select" name="horas" size="10">
								<option value="1">09:00</option>
								<option value="2">09:30</option>
								<option value="3">10:00</option>
								<option value="4">10:30</option>
								<option value="5">11:00</option>
								<option value="6">11:30</option>
								<option value="7">12:00</option>
								<option value="8">12:30</option>
								<option value="9">13:00</option>
								<option value="10"13:30></option>
							</select>
														
							<input class="input date" type="date" name="fecha" value="' . date("Y-m-d") . '" min="' . date("Y-m-d") . '" max="2019-12-31">
							
							<input class="button is-link" type="submit" name="guardar" value="RESERVAR CITA">
														
							<a class="button is-link red" href="logout.php">SALIR</a>
						</form>	';						
				?>
			</div>

			<?php require 'html/footer.php' ?>