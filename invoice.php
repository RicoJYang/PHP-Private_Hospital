<?php require "html/header.php" ?>
	
				
					CONFIRMACIÓN DE RESERVA DE CITA
				</h2>
			</header>

			<div class="form section">				

                <?php
                
                    include("sql.php");
                    session_start();

                    if(!isset($_SESSION["medico"]))
                    {
                        echo "<p>No puede acceder a este servicio</p>";
                        echo "<p>Pinche<a href='index.php'>aquí</a>para volver a la página principal.</p>";
                    }
                    
                    $medico = $_SESSION["medico"];
                    $paciente = $_SESSION["paciente"];
                    $fecha = $_SESSION["fecha"];
                    $hora = $_SESSION["hora"];
					
                    if (!setCita($medico, $paciente, $hora, $fecha))
                    {
                        echo "<div class='notification is-success'>";																		
                        echo 	"<p>Cita reservada con éxito</p>";
                        echo 	"<p>Dia " . $fecha . "</p>";
                        echo 	"<p>Hora " . $hora . "</p>";
                        echo "</div>";
                    }	
                ?>

                <div>
                    <a class="button is-link red" href="logout.php">SALIR</a>
                </div>
				
		    </div>

		<?php include "html/footer.php" ?>