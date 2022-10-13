<html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/LR.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="Multimedia/icono_arbol.png">
    <title>Register-Login</title>
    </head>
    <body>
        <?php
            if(isset($_POST['inv'])){
                header('Location: index.html');
                die();
            }
            if(isset($_POST['register'])){
            // Aldagaiak hartu
            $nick = isset($_REQUEST['nicknameR']) ? $_REQUEST['nicknameR'] : null;
            $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
            $surname = isset($_REQUEST['surname']) ? $_REQUEST['surname'] : null;
            $pass = isset($_REQUEST['pswdr']) ? $_REQUEST['pswdr'] : null;
            $passc = isset($_REQUEST['pswdc']) ? $_REQUEST['pswdc'] : null;
            $age = isset($_REQUEST['age']) ? $_REQUEST['age'] : null;
            $rol = 'Invitado';
            $group = '1';
            $rbook = '-';

            // aldagaiak
            $hostDB = 'wger1dbvpc1.clfizgthaamq.us-east-1.rds.amazonaws.com';
            $nombreDB = 'e1webgune';
            $usuarioDB = 'LeyreBoyra';
            $contrasenyaDB = 'NausicaA';
            // Datu basearekin konektatu
            $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
            $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
            if($pass == $passc){
            // Preparatu INSERT
            $miInsert = $miPDO->prepare('INSERT INTO Usuarios (nickname, nombre, apellido, contraseña, edad, rol, grupo, lib_leido) VALUES (:nick, :name, :surname, :pass, :age, :rol, :group, :rbook)');
            // Exekutatu INSERT datuekin
            $miInsert->execute(
                        array(
                            'nickname' => $titulo,
                            'nombre' => $name,
                            'apellido' => $surname,
                            'contraseña' => $pass,
                            'edad' => $age,
                            'rol' => $rol,
                            'grupo' => $group,
                            'lib_leido' => $rbook
                            )
            );
            // Zuzenak badira, saioa hasiko dugu sartutako datuekin
            session_start();
            $_SESSION['nickname'] = $_REQUEST['nickname'];
            // Orrialde segurura bidaltzen dugu
            header('Location: index.html');
            die();
            }else{
                echo '<div class="error"><b>Las contraseñas no coinciden.</b></div>';
            }
            
            }
            if (isset($_POST['login'])) { //egiaztatzen dugu datuak jaso ditugula

                // Aldagaia hauek datu basetik irakurriko ditugu
                $zerbitzaria = "wger1dbvpc1.clfizgthaamq.us-east-1.rds.amazonaws.com";
                $erabiltzailea ="LeyreBoyra";
                $pasahitza = "NausicaA";
                $datubasea = "e1webgune";

                 // Hauek formulariotik hartzen ditugu
                $izena = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
                $pasahitz = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : null;
              

                try {
                    $konexioa = new PDO("mysql:host=$zerbitzaria;dbname=$datubasea", $erabiltzailea, $pasahitza);
                    // ezarri PDO exception modura
                    $konexioa->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // sql 
                    $sql = "SELECT contraseña FROM Usuarios WHERE nickname= '$izena' ";
                    $emaitza = $konexioa->query($sql);
                    $datuak = $emaitza->fetchAll();
                    if(!isset($datuak)){
                        
                    } 
                    else {
                        error_reporting(0);
                        $pasahitzZuzena = $datuak[0]['contraseña'];
                        // Sartutako datuak zuzenak diren egiaztatu
                    if ($pasahitzZuzena == $pasahitz) {
                        // Zuzenak badira, saioa hasiko dugu sartutako datuekin
                        session_start();
                        $_SESSION['user'] = $_REQUEST['user'];
                        // Orrialde segurura bidaltzen dugu
                        header('Location: index.html');
                        die();
                    } else {
                        // Datuak zuzenak ez badira, erabiltzaileari jakinarazi
                        echo '<div class="error"><b>Usuario o contraseña no validos.</b></div>';
                    }
                        
                    }
                    
                } catch(PDOException $e) {
                    echo $sql . "<br>" .$e->getMessage();
                }
                
                $konexioa = null;
              
                
               

                
            }
        ?>
    	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form method="post" name="R" id="R" action="">
					<label for="chk" aria-hidden="true">Registrarse</label>
					<input type="text" name="nicknameR" placeholder="Nickname" required="">
					<input type="text" name="name" placeholder="Nombre" required="">
                    <input type="text" name="surname" placeholder="Apellido" required="">
                    <input type="text" name="age" placeholder="Edad" required="">
					<input type="password" name="pswdr" placeholder="Contraseña" required="">
                    <input type="password" name="pswdc" placeholder="Confirmar Contraseña" required="">
					<button type="submit" name="register" value="Submit">Registrarse</button>
				</form>
			</div>

			<div class="login">
				<form method="post" name="L" id="L" action="">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" name="user" placeholder="Nickname" autocomplete="off">
					<input type="password" name="pass" placeholder="Contraseña" autocomplete="off">
					<button type="submit" name="login" value="Submit">Login</button>
                    <button type="submit" name="inv" value="Submit">Invitado</button>
				</form>
			</div>
	</div>
    </body>
</html>