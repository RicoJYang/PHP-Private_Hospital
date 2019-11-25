	<?php require 'html/header.php' ?>	


					ACCESO
				</h2>
			</header>

			<div class="form section">

				<?php
					error_reporting(E_ALL ^ E_NOTICE);
					ini_set("display_errors", "1");
					
					require "conexionBBDD.php";
					session_start();

					$user = mysqli_real_escape_string($conx, $_POST["dni"]);

					$sql = "SELECT nombre FROM usuarios WHERE dni = '$user'";
					$result = mysqli_query($conx, $sql);
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      				$active = $row["active"];

					$count = mysqli_num_rows($result);

					if($count == 1)
					{
						$_SESSION["login_user"] = $user;

						header("location:cita.php");
					}	else
					{
						$error = "El NIF no está registrado en la base de datos";
					}
				?>

				<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
					<input class="input" type="text" name="dni" placeholder="NIF/NIE"/>					
					<input class="button is-link" type="submit" name="login" value="ENTRAR"/>
				</form>


			</div>

			<?php require 'html/footer.php' ?>