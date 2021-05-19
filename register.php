<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18/5/2021
 * Time: 23:02
 */
$hostDB="127.0.0.1";
$nameDB="task_register";
$userDB="root";
$passwordDB="";

$username = "";
$password = "";
$password_v = "";

$username_error = "";
$password_error = "";
$password_v_error = "";

$connetion_error = "";
$successfull = "";
$status = "";
$valid = true;

if(isset($_POST['register']) && $_POST['register'] != null){

    if(!isset($_POST['username']) || $_POST['username'] == null){
        $username_error = "Usuario Requerido";
        $valid = false;
    }

    if(!isset($_POST['password']) || $_POST['password'] == null){
        $password_error = "Contraeña Requerido";
        $valid = false;
    }

    if(!isset($_POST['password-v']) || $_POST['password-v'] == null){
        $password_v_error = "Debe confirma la Contraseña";
        $valid = false;
    }

    if($password_v_error == "" && $_POST['password-v'] != $_POST['password']){
        $password_v_error = "No son iguales";
        $valid = false;
    }





    if($valid){
        $enlace = mysqli_connect($hostDB, $userDB, $passwordDB, $nameDB);

        if(!$enlace){
            $connetion_error = "Errror en la conexion";
            $status = false;
        }else{

            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "INSERT INTO usuario (username,password) VALUES ('".$username."','".$password."')";

            $prepare = mysqli_query($enlace,$sql);
            if(!$prepare){
                $connetion_error = mysqli_error($enlace);
                $status = false;

            }else{
                $successfull = "Usuario insertado satisfactoriamente";
                $status = true;
            }

        }

    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <style>
        .error{
            color:red;
        }
        .ok{
            color:green;
        }
    </style>
</head>
<body>
<div>
    <div >
        <p class="<?php echo $status == true ? 'ok' : 'error' ?>">
            <strong>
                <?php if($connetion_error != ""): ?>
                    <p ><?php echo $connetion_error ?></p>
                <?php endif; ?>
                <?php if($successfull != ""): ?>
                    <p ><?php echo $successfull ?></p>
                <?php endif; ?>
            </strong>
        </p>
    </div>
    <?php if($successfull == ""): ?>
        <form action="register.php" method="POST">
        <div>
            <label for="username">Usuario</label>
            <input type="text" name="username" id="username"/>
            <?php if($username_error != ""): ?>
                <p style="color: red"><?php echo $username_error ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password"/>
            <?php if($password_error != ""): ?>
                <p style="color: red"><?php echo $password_error ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="password-v">Confirmar Password</label>
            <input type="password" name="password-v" id="password-v"/>
            <?php if($password_v_error != ""): ?>
                <p style="color: red"><?php echo $password_v_error ?></p>
            <?php endif; ?>
        </div>
        <div>

            <input type="submit" name="register" value="Registrar"/>
        </div>
        <div>

            <a href="index.php">retornar al login</a>
        </div>
    </form>
    <?php else: ?>
        <div>
            <a href="index.php">Entre con su nueva cuenta</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>

<?php
