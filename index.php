	<?php require 'html/header.php' ?>

				
					INICIO
				</h2>
			</header>

			<div class="section">
				<?php
				if($_SERVER['REQUEST_METHOD'] == 'POST')
				{
					if(isset($_POST['user']))
					{
						header('Location: ' . 'login.php');
					} else
					{
						header('Location: ' . 'management.php');
					}
				} else 
				{
					echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
						<input class="button is-link" type="submit" name="user" value="USER"/>
						<input class="button is-link" type="submit" name="manager" value="MANAGER"/>
					</form>';
				}
				?>
			</div>

			<?php require 'html/footer.php' ?>