	<?php require "html/header.php" ?>

				
					INICIO
				</h2>
			</header>

			<h1>PVP de la consulta: 50,00€</h1>
			
			<div class="form section">				
				
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="A7KJVGREKLF5W">
					<input type="image" src="https://www.sandbox.paypal.com/es_ES/ES/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
					<img alt="" border="0" src="https://www.sandbox.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1">
				</form>

			</div>

	<?php require "html/footer.php" ?>