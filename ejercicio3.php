<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/calendario.css" type="text/css"/>
    <title>Ejercicio 3- Convecinos</title>
</head>
<body>
<?php
    //incluimos el formulario
    include_once 'ejercicio3.form.html';
    
    
    //verificamos si se reciben datos
    if(!empty($_POST)){
        if(isset($_POST['tramo']) && !empty($_POST['tramo'])){
            //si existen datos se inicia el proceso de validación
            $tramo=$_POST['tramo'];
            iniciar($tramo);
        }else{
            echo "Datos incorrectos"; 
        }
    }
    // else{
    //     echo "<script language='javascript'>
    //             alert('No existen datos del tramo.');
                
    //           </script>";
    // }
    
    //iniciamos el proceso de verificación
    function iniciar($tramo){
        //variables
        //array globales
        $horario=['10:00-13:30','16:30-20:30'];
        $ocupacion=['11:30-12:30','12:31-13:30','16:30-18:00'];
        $hayError=false;
        $arrayErrores="";
        $continua=false;
        //verificamos que el tramo cumple el patrón /^\d+:\d+-\d+:\d+$/ y es correcto, es una hora posible
        $esPatronCorrecto=comprobarTramoHoras($tramo);
        if($esPatronCorrecto){
            $continua=true;
            //$tramo='11:30-12:30=>$arrayTramo=[690,750]
            //convertimos el tramo recibido en minutos
            $arrayTramo=convertirTramoHorasATramoMinutos($tramo);
        }else{
            $continua=false;
            echo "<br><p>Patrón incorrecto.</p>";
        }
        //Si lo anterior es correcto continuamos, verificamos que el $tramo está dentro de $horario=['10:00-13:30','16:30-20:30']
        $estaDentro=false;
        if($continua){
            $estaDentro=comprobarSiEntraEnHorario($tramo, $horario);
        }
        if($estaDentro){
            $continua=true;
        }else{
            $continua=false;
            echo "<p class='error'>El tramo  ${tramo} está fuera del horario.</p>";
        }
        //se verifica si el tramo se solapa con los tramos del array $ocupacion
        if($continua){
            
            $arrayErrores=comprobarSiPisaTramosOcupados($tramo, $ocupacion);
            //eliminamos los elementos vacios y pasa mos el elemento con el mensaje de error a cadena
            foreach ($errores as $error){
                $longitud=strlen($error);
                if(!($longitud==0)){
                    $errores=$error;
                }
            }
        }
        if(strlen($errores)>0){
            echo "<p class='error'> ${errores}"."No está libre para su reserva</p>";
        }else{
            echo "<p>El tramo ${tramo} esta libre para su reserva</p>";
        }
                //
            // $tramoA='10:20-10:30';
            // $tramoB='10:00-10:30';
            // echo "<br>TramoA: ${tramoA}<br>TramoB: ${tramoB}<br>";
            // $contenido=esTramoHorasContenidoEnOtroTramoHoras($tramoA, $tramoB);
            // if($contenido){
            //     echo "<br>El tramoA está contenido en el tramoB: ";
            // }else{
            //     echo "<br>El tramoA no está contenido en el tramoB: ";
            // }
            
            // //verificamos si los tramos se pisan
            // $tramo1='10:20-10:30';
            // $tramo2='10:15-10:25';
            // $resultado=comprobarSiSePisanTramosHoras ($tramo1,$tramo2);
            // echo $resultado;
            // $tramo2='10:21-10:29';
            // $resultado=comprobarSiSePisanTramosHoras ($tramo1,$tramo2);
            // echo $resultado;
            // $tramo2='10:30-10:40';
            // $resultado=comprobarSiSePisanTramosHoras ($tramo1,$tramo2);
            // echo $resultado;
            // $tramo1='10:21-10:30';
            // $tramo2='10:31-10:40';
            // $resultado=comprobarSiSePisanTramosHoras ($tramo1,$tramo2);
            // echo $resultado;
            // $tramo1='10:21-10:30';
            // $tramo2='10:10-10:20';
            // $resultado=comprobarSiSePisanTramosHoras ($tramo1,$tramo2);
            // echo $resultado;
            // //verificamos un tramo con el array ocupación
            // echo "comprobarSiPisaTramosOcupados";
            // $tramo1='19:20-19:31';
            // global $ocupacion;
            // $errores="";
            // $errores=comprobarSiPisaTramosOcupados($tramo1, $ocupacion);
            // echo "<br>Errores:";
            // print_r($errores);
            // $tramo2='12:30-13:00';
            // $errores=comprobarSiPisaTramosOcupados($tramo2, $ocupacion);
            // echo "<br>Errores:";
            // print_r($errores);

            // //Verificamos horarios de apertura
            // global $horario;
            // $tramo='12:20-13:31';
            // $resultado=comprobarSiEntraEnHorario ($tramo, $horario);
            // if($resultado){
            //     echo "<br>${tramo} está dentro del horario";
            // }else{
            //     echo "<br>${tramo} está fuera del horario";
            // } 
            // //
            // $tramo='12:20-13:30';
            // $resultado=comprobarSiEntraEnHorario ($tramo, $horario);
            // if($resultado){
            //     echo "<br>${tramo} está dentro del horario";
            // }else{
            //     echo "<br>${tramo} está fuera del horario";
            // }
            // //
            // $tramo='16:29-20:30';
            // $resultado=comprobarSiEntraEnHorario ($tramo, $horario);
            // if($resultado){
            //     echo "<br>${tramo} está dentro del horario";
            // }else{
            //     echo "<br>${tramo} está fuera del horario";
            // }
            // //
            // $tramo='16:30-20:30';
            // $resultado=comprobarSiEntraEnHorario ($tramo, $horario);
            // if($resultado){
            //     echo "<br>${tramo} está dentro del horario";
            // }else{
            //     echo "<br>${tramo} está fuera del horario";
            // }
        
    }
    
    /**
     * Esta función convierte una cadena que contiene una hora, por ejemplo '11:30',
     *  a minutos desde comienzo del día.
     * @param string $hora
     * @return string retornará un número entero o false si no se ha podido hacer la conversión.
     */
    function convertirHoraAMinutos ($hora){
        $tiempo=explode(":",$hora);
        $horas=$tiempo[0];
        $minutos=$tiempo[1];
        $resultado=($horas*60)+$minutos;
        return $resultado;
    }

    /**
     * Esta función debe usar la función convertirHoraAMinutos. El objetivo de esta
     * función es convertir un tramo horario en el número de minutos desde comienzo del día.
     * @param string $tramo String que corresponde con un tramo horario '11:30-12:30' =>array[690,750], 11:30=690min y 12:30=750min
     * @return array retorna un array de dos números, uno para el comienzo del tramo y otro para el fin del tramo
     */
    function convertirTramoHorasATramoMinutos ($tramo){
        $arrayTramo=[];
        //separamos las dos horas del tramo con explode
        $array=explode("-", $tramo);
        $hora1=convertirHoraAMinutos($array[0]);
        $hora2=convertirHoraAMinutos($array[1]);
        $arrayTramo=[$hora1, $hora2];
        
        return $arrayTramo;
    }

    /*
     * Esta función recibirá como parámetro un tramo y deberá usar las funciones anteriores 
     * según sea necesario. La idea de esta función es:

     *  1º) Comprobar que el tramo horario cumple con la expresión regular siguiente: '/^\d+:\d+-\d+:\d+$/'
     *  2º) Comprobar que la hora de inicio del tramo es anterior a la hora de fin del tramo.
     *  3º) Comprobar que la hora de inicio es mayor que 0.
     *  4º) Comprobar que la hora de fin es menor o igual a 23:59.
     *  @param string $tramo
     *  @return boolean Retorna true si el tramo es correcto y false en caso contrario.
     *                 Ddeberá retornar false cuando una de las horas no es válida
     *                 (por ejemplo: '10:61'), y que la hora '0:0' es válida.
     */
    function comprobarTramoHoras ($tramo){
        $resul=false;
        $tramo1=0;
        $tramo2=0;
        $pattern="/^\d+:\d+-\d+:\d+$/";
        //comparamos si coincide el patrón
        if(preg_match($pattern, $tramo)){
            //Tramo de horas correctos
            $resul=true;
        }
        //separamos las dos horas del tramo con explode y lo guardamos en un array
        if($resul){
            $arrayTramos=explode("-", $tramo);
        }
        //separamos los tramos para su verificación 
        if(!empty($arrayTramos)){
             $minutos1=explode(":",$arrayTramos[0]);
            //verificamos que los miutos de tramo1 no superen los 59min
            if($minutos1[1]>59){ 
                $resul=false;
            }else{
                $tramo1=convertirHoraAMinutos($arrayTramos[0]);
            }
            
           //verificamos que los minutos de tramo1 no superen los 59min
            $minutos2=explode(":",$arrayTramos[1]);
            //echo "Minutos2: ";
            //sprint_r($minutos2);
            if($minutos2[1]>59){ 
                $resul=false;
            }else{
                $tramo2=convertirHoraAMinutos($arrayTramos[1]);
            }
            
            //si tramo inicio es menor o igual a 0 se devuelve false, o si tramo final 
            //es menor que tramo inicio se devuelve false
            if(!($tramo1>=0 && $tramo1<$tramo2)){
                $resul=false;
            }
            //si tramo final es mayor de 1439min (23:59) se devuelve false.
            if($tramo2>1439){
                $resul=false;
            }
        }
         return $resul;
    }

    /**
     * Esta función deberá usar las otras funciones convenientemente
     * El objetivo de esta función es retornar "true" si el $tramoA está contenido en $tramoB, y false en caso contrario.

     *   Ejemplo 1: el tramo '10:20-10:30' está contenido en el tramo '10:00-10:30', por lo que el método debería retornar true.
     *   Ejemplo 2: el tramo '10:20-10:31' no está contenido en el tramo '10:00-10:30', por lo que el método debería retornar false.
     *
     *  @param string $tramoA Primer tramo a comparar
     *  @param string $tramoB Segundo tramo a comparar 
     */
    function esTramoHorasContenidoEnOtroTramoHoras ($tramoA, $tramoB){
        $esContenido=false;
        //verificamos que se cumple el formato correcto
        $resulA=comprobarTramoHoras($tramoA);
        $resulB=comprobarTramoHoras($tramoB);
        if($resulA && $resulB){
            //convertimos los tramos en array de minutos
            $arrayTramoA=convertirTramoHorasATramoMinutos($tramoA);
            $arrayTramoB=convertirTramoHorasATramoMinutos($tramoB);
            //pasamos el array a variables con list
            list($tramoA_inicio, $tramoA_fin)=$arrayTramoA;
            list($tramoB_inicio, $tramoB_fin)=$arrayTramoB;
            if(($tramoA_inicio>=$tramoB_inicio) && ($tramoA_fin<=$tramoB_fin)){
                $esContenido=true;
            }
        }
        return $esContenido;
    }

    /**
     * esta función deberá usar las otras funciones convenientemente. El objetivo de esta función
     *  es verificar si el $tramo1 se solapa con el $tramo2, retornando una cadena de texto indicando el problema.

     *   Ejemplo 1: dados los tramos '10:20-10:30' y '10:15-10:25' el método debería retornar una cadena
     *             indicando "Tramo 10:20-10:30 coincidente con el tramo 10:15-10:25" dado que hay 5 minutos donde dichos tramo se solapan.
     *   Ejemplo 2: dados los tramos '10:20-10:30' y '10:21-10:29' el método debería retornar una cadena 
     *             indicando "Tramo 10:20-10:30 coincidente con el tramo 10:21-10:29" dado que el segundo tramo está contenido dentro dle primero.
     *   Ejemplo 3: dados los tramos '10:20-10:30' y '10:30-10:40' el metodo debería retornar una cadena 
     *             indicando que dichos tramos coinciden, dado que ambos tramos comparten un minuto (las 10:30).
     *   Ejemplo 4: dados los tramos '10:21-10:30' y '10:31-10:40' el método debería retornar una cadena vacía, 
     *             dado que no hay ninguna coincidencia.

     * @param string $tramo1
     * @param string $tramo2
     * @return string $cadena
     */

    function comprobarSiSePisanTramosHoras ($tramo1,$tramo2){
        $cadena="";
        //verificamos que se cumple el formato correcto
        $resul1=comprobarTramoHoras($tramo1);
        $resul2=comprobarTramoHoras($tramo2);
        if($resul1 && $resul2){
            //convertimos los tramos en array de minutos
            $arrayTramo1=convertirTramoHorasATramoMinutos($tramo1);
            $arrayTramo2=convertirTramoHorasATramoMinutos($tramo2);
            //pasamos el array a variables con list
            list($tramo1_inicio, $tramo1_fin)=$arrayTramo1;
            list($tramo2_inicio, $tramo2_fin)=$arrayTramo2;
            //si tramo1_fin es < que tramo2_inicio no se pisan
            //si tramo1_inicio es > tramo2_ fin no se pisan
            if(!($tramo1_fin<$tramo2_inicio || $tramo1_inicio>$tramo2_fin)){
                $cadena="<p style='color:red'> Tramo ${tramo1} coincidente con el tramo ${tramo2}.</p>";
            }
        }
        return $cadena;
        
    }

    /**
     * Usando los métodos anteriores convenientemente, debes crear un método que dado un tramo ($tramo) 
     * compruebe si se solapa con alguno de los tramos contenidos en el array $tramosOcupados.

     *   Ejemplo: dado el tramo '12:20-13:00' el array de tramos ocupados $ocupacion=['11:30-12:30','12:31-13:30','16:30-18:00']; 
     *            el método debería retornar un array con dos cadenas:
     *       Tramo 12:20-13:00 coincidente con el tramo 11:30-12:30
     *       Tramo 12:20-13:00 coincidente con el tramo 12:31-13:30
     *   En caso de que no haya ningún tramo coincidente, se retornará un array vacío.

     * @param string $tramo Tramo para a comprobar
     * @param array $tramosOcupados Attray que contiene los tramos
     * @return array En caso de que el tramo coincida con los tramos del array se retorna un array
     *               con dos cadenas, la cadena de entrada y la cadena del array coincidentede.
     *               En caso de que no haya ningún tramo coincidente, se retornará un array vacío
     */
    function comprobarSiPisaTramosOcupados($tramo, $arrayOcupados){
        $error=false;
        $errores=[];
       
            //recorremos el array $ocupacion con todos los tramos
            foreach ($arrayOcupados as $unTramo){
                //hola
                $cadena=comprobarSiSePisanTramosHoras($tramo, $unTramo);
                $errores[]=$cadena;
            }
        
                   
        return $errores;
    }
        
    /**
     * Usando los métodos anteriores convenientemente, debes crear un método que dado un tramo ($tramo) 
     * retorne true si el tramo está dentro del horario ($tramosHorario) o false en caso contrario.
     *
     *   Ejemplo 1: dado el tramo '12:20-13:31' y el horario  $horario=['10:00-13:30','16:30-20:30'] el método debería retornar false.
     *   Ejemplo 2: dado el tramo '12:20-13:30' y el horario  $horario=['10:00-13:30','16:30-20:30'] el método debería retornar true.
     *   Ejemplo 3: dado el tramo '16:29-20:30' y el horario  $horario=['10:00-13:30','16:30-20:30'] el método debería retornar false.
     *   Ejemplo 4: dado el tramo '16:30-20:30' y el horario  $horario=['10:00-13:30','16:30-20:30'] el método debería retornar true
     * @param string $tramo Primer tramo a comparar
     * @param string $tramosHorario Segundo tramo a comparar
     * @return boolean Retorna true si el tramo está dentro del horario ($tramosHorario) o false en caso contrario.
     */

    function comprobarSiEntraEnHorario ($tramo, $horario){
        
            $estaContenido=false;
            
                //recorremos el array $horarios con todos los dos  tramos
                foreach ($horario as $unTramo){
                    
                    //se verifica si tramo esta contenido dentro del los tramos de los horarios
                    $resultado=esTramoHorasContenidoEnOtroTramoHoras($tramo, $unTramo);
                    if($resultado) $estaContenido=1;
                    
                }
            return $estaContenido;
        }
    

    ?>
</body>
</html>