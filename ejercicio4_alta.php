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
$password="";
$repassword="";
$situacion;
$garaje;
$trastero;
$alquilado;

//array para acumular los errores
$arrayErrores=[];

//array para especificar las puertas por planta
$puertasPorPlanta=['0' => '4',
                   '1' => '6',
                   '2' => '5',
                   '3' => '5',
                   '4' => '5',
                   '5' => '5',
                   '6' => '4'];

if(!empty($_POST)){
    
    //Si existe la variable nombre, si no esta vacia y es un string le quitamos los espacios delante y atrás y lo guardamos
    if(isset($_POST['nombre']) && (!empty($_POST['nombre'])) && is_string($_POST['nombre'])){
        $nombre=verificaString($_POST['nombre'], 'nombre', 2);
    }else{
        $arrayErrores['nombre']="El nombre no puede estar en blanco";
    }
    //apellidos
    if(isset($_POST['apellidos']) && (!empty($_POST['apellidos'])) && is_string($_POST['apellidos'])){
        $apellidos=verificaString($_POST['apellidos'], 'apellido', 2);
    }else{
        $arrayErrores['apellido']="El apellido no puede estar en blanco";
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
    if(isset($_POST['telefono']) && !empty($_POST['telefono']) && is_numeric($_POST['telefono'])){
        $telefono=trim($_POST['telefono']);
    }else{
        $arrayErrores['telefono']="El teléfono introducido no es correcto";
    }
    //planta
    if(isset($_POST['planta']) && !empty($_POST['planta'])){
        $planta=$_POST['planta'];
    }
    //puerta
    if(isset($_POST['puerta']) && !empty($_POST['puerta'])){
        $puerta=$_POST['puerta'];
        
        $indice=intval($planta);
        
        if($puerta > $puertasPorPlanta[$indice]){
            $puerta--;
            $arrayErrores['puerta']="La planta ${planta} sólo tiene ${puerta} puertas";
        }
    }else{
        $arrayErrores['puerta']="No se ha seleccionado una puerta";
    }
    //password
    if(isset($_POST['password']) && !empty($_POST['password'])){
        $password=verificaString($_POST['password'], 'password', 8);
    }else{
        $arrayErrores['password']="No se ha introducido el password";
    }
    //repassword
    if(isset($_POST['repassword']) && !empty($_POST['repassword'])){
        $repassword=verificaString($_POST['password'], 'password', 8);
        //se comparan los password, tienen que ser iguales
        if ($password!==$repassword) {
          $arrayErrores['repassword']="Los password no coinciden";
        }
    }else{
        $arrayErrores['repassword']="No se ha introducido la repetición del password";
    }
    if(isset($_POST['opts']) && !empty($_POST['opts'])){
        $situacion=$_POST['opts'];
        $garaje=isset($situacion['garaje']);
        
        $alquilado=isset($situacion['alquilado']);
       
        $trastero=isset($situacion['trastero']);
        
        if($trastero && !$garaje){
            $arrayErrores['situacion']="Al menos se tiene que disponer de un garaje para tener trastero";
        }
    }else{
        $arrayErrores['situacion']="No se ha especificado una situación";
    }
    
    include_once "ejercicio4_form.php";
    if(!count($arrayErrores)>0){
        echo "<h1>Datos validos</h1>";
    }
    
}else{
    //incluimos el formulario
    include_once "ejercicio4_form.php";
} 

/**
 * @param string $texto Cadena de texto a procesar, se eliminan los espacis por delante y por detras
 * @param string $valor Corresponde a si es nombre, apellidos o password
 * @param int    $longitud entero que indica la longitud de la cadena
 * @return string $resultado se devuelve la cadena sin los espacios
 */
function verificaString($texto, $valor, $longitud){
    global $arrayErrores;
    $resultado=trim($texto);
    if(strlen($resultado)>=$longitud){
       return $resultado; 
    }else{
        $arrayErrores[$valor]="El ${valor} introducido no es correcto.";

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

