<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio4</title>
    <style type="text/css">
        .error{
            border: 1px solid red;
        }
    </style>
</head>
<body>
<?php
//variables
$nombre="";
$apellidos="";
$email="";
$remail="";
$telefono="";
$planta="";
$puerta="";
$clave="";
$clave_repe="";
$situacion="";

//array para acumular los errores
$arrayErrores=[];

if(!empty($_POST)){
    echo "<br>Se han recibido datos ";
    //Si existe la variable nombre, si no esta vacia y es un string le quitamos los espacios delante y atrás y lo guardamos
    if(isset($_POST['nombre']) && (!empty($_POST['nombre'])) && is_string($_POST['nombre'])){
        $nombre=verificaString($_POST['nombre'], 'nombre');
    }
    //apellidos
    if(isset($_POST['apellidos']) && (!empty($_POST['apellidos'])) && is_string($_POST['apellidos'])){
        $apellidos=verificaString($_POST['apellidos'], 'apellido');
    }
    //email
    if(isset($_POST['email']) && (!empty($_POST['email']))){
        $email=filtrarEmail($_POST['email']);
    }else{
        $arrayErrores['email']="Email incorrecto";
    }
    //remail
    if(isset($_POST['remail']) && (!empty($_POST['remail']))){
        $remail=filtrarEmail($_POST['remail']);
    }else{
        $arrayErrores['remail']="Repetición del email incorrecto";
    }
    //se compara email y remail para que coincidan
    if($email!=$remail){
        $arrayErrores['remail']="Los email no coinciden";
    }
    //teléfono
    if($isset($_POST['telefono']) && !empty($_POST['telefono']) && is_numeric($_POST['telefono'])){
        $telefono=trim($_POST['telefono']);
    }else{
        $arrayErrores['telefono']="El teléfono introducido no es correcto";
    }
    include_once "ejercicio4_form.php";
    var_dump($arrayErrores);
}else{
    //incluimos el formulario
    include_once "ejercicio4_form.php";
} 

//funcion para eliminar espacios anteriores, posteriores y si el tamaño es mayor de 2 carácteres
function verificaString($texto, $valor){
    global $arrayErrores;
    $resultado=trim($texto);
    if(strlen($resultado)>=2){
       return $resultado; 
    }else{
        $arrayErrores[$valor]="El ${valor} introducido no es correcto.";

        return "";
    }
    
}

function filtrarEmail($email){
    
    $texto=trim($email);
    $texto=strtolower($texto);
    return $texto;
}
?>  
</body>
</html>

