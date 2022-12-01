  
	<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>Vistas/Public/css/style.css">

	<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>Vistas/Public/css/fontawesome-all.css">

	  <link rel="shortcut icon" href="<?php echo SERVERURL; ?>Vistas/Public/img/favicon2.ico">
  <center>
    <img src="<?php echo SERVERURL; ?>Vistas/Public/img/Standardiron.png" class="imagen">
    </center>
    <div class="w3l-login-form">
        <h2>INICIO</h2>
        <form  action="" method="POST" autocomplete="off">

            <div class="form-group">
                    <div class="group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control"  name="LoginN" id="LoginN" placeholder="Usuario" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="35" required="required" />
                </div>
            </div>
            <div class="form-group">
                    <div class="group">
                    <i class="fas fa-unlock"></i>
                    <input type="password" class="form-control" name="PasswordD" id="PasswordD" placeholder="Password" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="required" />
                </div>
            </div>
         
            <button type="submit">Inicio</button>
        </form>
    
    </div>
    <?php 
            if (isset($_POST['LoginN']) && isset($_POST['PasswordD'])) {
                require_once "./Controladores/loginControlador.php";
                $ins_login= new loginControlador();
                echo $ins_login->iniciar_sesion_controlador();
            }


    ?>
    	<script src="<?php echo SERVERURL; ?>Vistas/js/main.js" ></script>

	<script src="<?php echo SERVERURL; ?>Vistas/Public/js/jquery-3.1.1.min.js"></script>

	<script src="<?php echo SERVERURL; ?>Vistas/Public/js/bootstrap.min.js"></script>

	<script src="<?php echo SERVERURL; ?>Vistas/Public/js/bootbox.js"></script>
	
