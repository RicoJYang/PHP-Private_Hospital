	<?php require "html/header.php" ?>
	<?php include "conexionBBDD.php" ?>
	

					RESERVAR UNA CITA
				</h2>				
			</header>
			
			<div class="form section">
				<?php	
					error_reporting(E_ALL ^ E_NOTICE);
					ini_set('display_errors', '1');

					include("sql.php");

					echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";

					getListaPacientes();

					
					getListaMedicos();					

					echo "<div class='field control select is-primary'>
								<select>
									<option value='1'>09:00</option>
									<option value='2'>09:30</option>
									<option value='3'>10:00</option>
									<option value='4'>10:30</option>
									<option value='5'>11:00</option>
									<option value='6'>11:30</option>
									<option value='7'>12:00</option>
									<option value='8'>12:30</option>
									<option value='9'>13:00</option>
									<option value='10'>13:30</option>
								</select>
							</div>";
							
					echo "<input class='input date is-primary' type='date' name='fecha' value='" . date('Y-m-d') . "' min='" . date('Y-m-d') . "' max='2019-12-31>";
					
					echo "<input class='button is-link' type='submit' name='guardar' value='RESERVAR CITA'>";
									
					echo "</form>";					
				?>
				
				<a class='button is-link red' href='logout.php'>SALIR</a>

			</div>

			<?php require "html/footer.php" ?>