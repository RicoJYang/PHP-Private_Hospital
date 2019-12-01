<?php require "html/header.php" ?>
	
				
                    <?php
                        session_start();

                        echo "CONFIGURACIÓN - " . strtoupper($_SESSION["ejecutar"]);
					?>
				</h2>
			</header>
			
            <div class="form section">

            <a class='button is-link back' href='admin.php'>VOLVER</a>

                <?php                

                    if(isset($_SESSION["ejecutar"]))
                    {

                        switch($_SESSION["ejecutar"])
                        {
                            //	ALTA
                            case "alta":
                                
                                include("sql.php");

                                echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
                                echo 	"<input class='input' type='text' pattern='[0-9]{1,2}' name='codigoAlta' placeholder='CÓDIGO' required>";
                                echo 	"<input class='input' type='text' pattern='(?i)[a-z]{1,30}' name='nombreAlta' placeholder='NOMBRE' required>";
                                echo 	"<input class='button is-link' type='submit' name='accion' value='NUEVO MÉDICO'>";
                                echo "</form>";

                                if (isset($_POST["accion"]))
                                {                                    
                                    if (isset($_POST["codigoAlta"]) && isset($_POST["nombreAlta"]))
                                    {
                                        $codigo = $_POST["codigoAlta"];
                                        $nombre = $_POST["nombreAlta"];

                                        if (alta($codigo, $nombre))
                                        {
                                            echo "<div class='notification is-success'>";																		
                                            echo 	"<p>Médico guardado con éxito</p>";
                                            echo "</div>";
                                        }
                                        else 
                                        {
                                            echo "<div class='notification is-danger'>";									
                                            echo 	"<p>Ya existe un médico con ese código</p>";
                                            echo "</div>";
                                        }
                                    }
                                }							
                            break;

                            //	BAJA
                            case "baja":                            
                                
                                include("sql.php");

                                echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";

                                        getListaMedicos();

                                echo 	"<input class='button is-link' type='submit' name='accion' value='ELIMINAR MÉDICO'>";                                
                                echo "</form>";                                
                            
                                if (isset($_POST["accion"]))
                                {
                                    if (isset($_POST["medicos"]))
                                    {
                                        $codigo = $_POST["medicos"];

                                        if (baja($codigo))
                                        {
                                            echo "<div class='notification is-success'>";																		
                                            echo 	"<p>Médico borrado con éxito</p>";
                                            echo "</div>";
                                        } else
                                        {
                                            echo "<div class='notification is-warning'>";
                                            echo 	"<p>Imposible borrar</p>";
                                            echo 	"<p></p>";
                                            echo 	"<p>El médico seleccionado tiene consultas pendientes</p>";
                                            echo "</div>";
                                        }
                                    }
                                }
                            break;
                            //	CONSULTA
                            case "disponibilidad":

                                include("sql.php");

                                echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";

                                        getListaMedicos();

                                echo 	"<input class='input date is-primary' type='date' name='fecha' value='" . date('Y-m-d') . "' max='2019-12-31'>";
                                echo 	"<input class='button is-link' type='submit' name='accion' value='COMPROBAR DISPONIBILIDAD'>";                                
                                echo "</form>";
                            
                                if (isset($_POST["accion"]))
                                {
                                    $codigo = $_POST["medicos"];
                                    $fecha = $_POST["fecha"];														

                                    getDisponibilidad($codigo, $fecha);                                    
                                }                            

                            break;
                        }
                    }
                    else 
                    {
                        echo "<p>No puede acceder a este servicio</p>";
                        echo "<p>Pinche<a href='admin.php'>aquí</a>para volver a la página principal.</p>";
                        
                    }

                    //session_destroy();
                ?>            
            </div>

<?php include "html/footer.php" ?>