	<?php require "html/header.php" ?>

				
					INICIO
				</h2>
			</header>

			<div class="section">
				<?php
				if($_SERVER["REQUEST_METHOD"] == "POST")
				{					
					if(isset($_POST["admin"]))
					{												
						header('Location: ' . 'management.php');											
						session_start();
						$_SESSION["settings"] = 0;
					} else
					{
						header('Location: ' . 'cita.php');	
					}
				} else 
				{
					echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
						<input class="button is-link" type="submit" name="user" value="USER"/>
						<input class="button is-link" type="submit" name="admin" value="ADMIN"/>
					</form>';
				}
				?>
			</div>

			<?php require "html/footer.php" ?>