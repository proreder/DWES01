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

    include_once 'ejercicio3.form.html';
    //verificamos si se reciben datos
    if(!isset($_POST['tramo']) || !empty($_POST['tramo']) ){
        echo "Datos correctos";
    }else{
        echo "<script language='javascript'>
                alert('No existen datos del tramo.');
                
              </script>";
    }
    /**
     * Esta función convierte una cadena que contiene una hora, por ejemplo '11:30',
     *  a minutos desde comienzo del día.
     * @param string $hora
     * @return string retornará un número entero o false si no se ha podido hacer la conversión.
     */
    function convertirHoraAMinutos ($hora){
        return resultado;
    }

    /**
     * Esta función debe usar la función convertirHoraAMinutos. El objetivo de esta
     * función es convertir un tramo horario en el número de minutos desde comienzo
     * del día
     * @param string $tramo String que corrsponde con un tramo horario '11:30-12:30' =>array[690,750], 11:30=690min y 12:30=750min
     * @return array retorna un array de dos números, uno para el comienzo del tramo y otro para el fin del tramo
     */
    function convertirTramoHorasATramoMinutos ($tramo){
        return $array;
    }

    /*
     * Esta función recibirá como parámetro un tramo y deberá usar las funciones anteriores 
     * según sea necesario. La idea de esta función es:

     *  1º) Comprobar que el tramo horario cumple con la expresión regular siguiente: '/^\d+:\d+-\d+:\d+$/'
     *  2º) Comprobar que la hora de inicio del tramo es anterior a la hora de fin del tramo.
     *  3º) Comprobar que la hora de inicio es mayor que 0.
     *  4º) Comprobar que la hora de fin es menor o igual a 23:59.
     *  @param string $tramo
     *  @return string Retorna true si el tramo es correcto y false en caso contrario.
     *                 Ddeberá retornar false cuando una de las horas no es válida
     *                 (por ejemplo: '10:61'), y que la hora '0:0' es válida.
     */
    function comprobarTramoHoras ($tramo){
        $resul=false;
        $patter="/^\d+:\d+-\d+:\d+$/";
        //comparamos si coincide el patrón
        if(preg_match($patter, $tramo)){
            echo "Tram de horas correctos.";
            $resul=true;
        }
        //separamos las dos horas del tramo con split
        
        
        
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
        return $valor;
    }

    /**
     * esta función deberá usar las otras funciones convenientemente. El objetivo de esta función
     *  es verificar si el $tramo1 se solapa con el $tramo2, retornando una cadena de texto indicando el problema.

        Ejemplo 1: dados los tramos '10:20-10:30' y '10:15-10:25' el método debería retornar una cadena
     *             indicando "Tramo 10:20-10:30 coincidente con el tramo 10:15-10:25" dado que hay 5 minutos donde dichos tramo se solapan.
        Ejemplo 2: dados los tramos '10:20-10:30' y '10:21-10:29' el método debería retornar una cadena 
     *             indicando "Tramo 10:20-10:30 coincidente con el tramo 10:21-10:29" dado que el segundo tramo está contenido dentro dle primero.
        Ejemplo 3: dados los tramos '10:20-10:30' y '10:30-10:40' el metodo debería retornar una cadena 
     *             indicando que dichos tramos coinciden, dado que ambos tramos comparten un minuto (las 10:30).
        Ejemplo 4: dados los tramos '10:21-10:30' y '10:31-10:40' el método debería retornar una cadena vacía, 
     *             dado que no hay ninguna coincidencia.

     * @param string $tramo1
     * @param string $tramo2
     * @return string
     */

    function comprobarSiSePisanTramosHoras ($tramo1,$tramo2){
        return $resultado;
    }

    /**
     * Usando los métodos anteriores convenientemente, debes crear un método que dado un tramo ($tramo) 
     * compruebe si se solapa con alguno de los tramos contenidos en el array $tramosOcupados.

        Ejemplo: dado el tramo '12:20-13:00' el array de tramos ocupados $ocupacion=['11:30-12:30','12:31-13:30','16:30-18:00']; 
                 el método debería retornar un array con dos cadenas:
            Tramo 12:20-13:00 coincidente con el tramo 11:30-12:30
            Tramo 12:20-13:00 coincidente con el tramo 12:31-13:30
        En caso de que no haya ningún tramo coincidente, se retornará un array vacío.

     * @param string $tramo Tramo para a comprobar
     * @param array $tramosOcupados Attray que contiene los tramos
     * @return array En caso de que el tramo coincida con los tramos del array se retorna un array
     *               con dos cadenas, la cadena de entrada y la cadena del array coincidentede.
     *               En caso de que no haya ningún tramo coincidente, se retornará un array vacío
     */
    function comprobarSiPisaTramosOcupados ($tramo, $tramosOcupados){

    }

    /**
     * Usando los métodos anteriores convenientemente, debes crear un método que dado un tramo ($tramo) 
     * retorne true si el tramo está dentro del horario ($tramosHorario) o false en caso contrario.

        Ejemplo 1: dado el tramo '12:20-13:31' y el horario  $horario=['10:00-13:30','16:30-20:30'] el método debería retornar false.
        Ejemplo 2: dado el tramo '12:20-13:30' y el horario  $horario=['10:00-13:30','16:30-20:30'] el método debería retornar true.
        Ejemplo 3: dado el tramo '16:29-20:30' y el horario  $horario=['10:00-13:30','16:30-20:30'] el método debería retornar false.
        Ejemplo 4: dado el tramo '16:30-20:30' y el horario  $horario=['10:00-13:30','16:30-20:30'] el método debería retornar true
     * @param string $tramo Primer tramo a comparar
     * @param string $tramosHorario Segundo tramo a comparar
     * @return boolean Retorna true si el tramo está dentro del horario ($tramosHorario) o false en caso contrario.
     */
    function comprobarSiEntraEnHorario ($tramo, $tramosHorario){

    }

    ?>
</body>
</html>