<?php require 'html/header.php' ?>
	
				
					CONFIGURACIÓN INTERNA
				</h2>
			</header>

			<div class="form section">

				<form>
					<label>Selección de fecha</label>
					<input class="input date" type="date" name="fecha" value="' . time() . '" min="' . time() . '" max="2019-12-31">
					
					<?php
						if ($_GET["accion"] == "alta")
						{							
							echo "<form action='management.php' method='GET'>
								<label>CODIGO</label>
								<input type='text' name='codigoAlta'>
								<label>NOMBRE</label>
								<input type='text' name='nombreAlta'>
								
								<input class='input' type='submit' name='ALTA'>
							</form>";
			
							echo "<br>" . "<a href='./'>Volver a la agenda</a>";
						}						
					?>

					<tr>
						<td>09:00</td>

					</tr>
					
				</form>

			</div>
			
			<?php include 'html/footer.php' ?>