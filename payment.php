	<?php require "html/header.php" ?>

				
					FACTURA Y PAGO
				</h2>
			</header>

			<?php
				include("sql.php");
				session_start();				
				
				$medico = $_SESSION["medico"];
				$paciente = $_SESSION["paciente"];
				$fecha = $_SESSION["fecha"];
				$hora = $_SESSION["hora"];								
            ?>

			<div class="section">
				
				<table class="table">
				<thead>
					<td colspan="2">
						FACTURA CONSULTA MÉDICA
					</td>								
					<td>
						Factura: 123<br>
						<?php echo $fecha ?><br>
					</td>				
				</thead>
				
				<tr>
					<td colspan="2">
						HOSPITAL GENERAL<br>
						12345 Avenida Melindres 24<br>
						Albacete, Castilla la Mancha
					</td>
					<td>
						<?php echo getNombrePaciente($paciente) ?><br>
						<?php echo $paciente ?><br>
						<?php echo getEmailPaciente($paciente) ?>
					</td>						
				</tr>
				<tr>
					<td colspan="2"></td>					
					<td></td>
				</tr>			
				<tr>
					<td colspan="2">
						Médico
					</td>					
					<td>
					<?php echo getNombreMedico($medico) ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Fecha
					</td>					
					<td>
					<?php echo $fecha ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Hora
					</td>					
					<td>
					<?php echo $hora ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>					
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						Servicio
					</td>					
					<td>
						Precio
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Consulta 30 minutos
					</td>					
					<td>
						50,00 €
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>					
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						<strong>Total:</strong>
					</td>					
					<td>
						<strong>50,00 €</strong>
					</td>
				</tr>
			</table>

			<br>
			<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="A7KJVGREKLF5W">
				<input type="image" src="https://www.sandbox.paypal.com/es_ES/ES/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
				<img alt="" border="0" src="https://www.sandbox.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1">
			</form>

		</div>			
			

	<?php require "html/footer.php" ?>