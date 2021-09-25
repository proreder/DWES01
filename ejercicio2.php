<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/calendario.css" type="text/css"/>
    <title>Ejercicio 2- Calendario</title>
</head>
<body>
    <?php
        //definimos la constante SEMANAS que corresponde con las filas de la tabla
        define ('SEMANAS', 8);

        //definimos las variables
        $diaSemana;
        $diasDelMes;
        $annio;
        $dia; 
        $mes;
        $columnas=7;
        $annioEntrada;
        $texto_error="";
        $errorEntrada=false;

        if(!(isset($_GET['d']) || isset($_GET['m']) || isset($_GET['y']))){
            $errorEntrada=true;
            $texto_error="El formato de entrada no es correcto, ejemplo: 12/05/2021";
        }
        //si no hay error de entrada procesamos los parámetros que no esten vacios
        elseif(empty($_GET['d']) || empty($_GET['m']) || empty($_GET['y'])){
            $errorEntrada=true;
            $texto_error="Falta un parámetro de entrada, ejemplo: 12/05/2021";
        }
        //verificamos que la fecha sea válida
        if(!$errorEntrada){
            $d=$_GET['d'];
            $m=$_GET['m'];
            $y=$_GET['y'];
            $fechaEntrada=$d.'/'.$m.'/'.$y;
            echo $fechaEntrada;
            $error_fecha=validarFecha($fechaEntrada);
            if(!$error_fecha){
                $errorEntrada=true;
                $texto_error="La fecha no es válida, ejemplo: 12/05/2021";  
            }else{
               //se obtiene el dia de la semana del mes y del  que se le pasa como parámetro
               $diaSemana=diaSemana($d, $m, $y);
               //se obtiene los dias que tiene un mes que se le pasa como parametro
               $diasDelMes=diasMes($m,$y);
               //se obtiene el numero de dias del mes siguiente
                $mesSiguiente=$m+1;
               if($mesSiguiente==12){
                $mesSiguiente=1;
               }
               /**
                * dibujamos el calendario
                * @param integer $diaSemana
                * @param integer $diasDelMes
                * @param integer $mesSiguiente 
                */
               
            }
        }
        if($errorEntrada){
            echo "<span class='error'>";
            echo $texto_error;
            echo "</span>";
        }

        //pintamos la tabla
        function pintarTabla($diaInicial1, $numeroDias1, $diaInicial2, $numeroDias2){
            $arrayDiasSemana= ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
            echo "<table>";
            echo "<tr>";
            for ($i=0;$i<7;$i++){
                echo ("<th>${$arrayDiasSemana[$i]}</th>");
            }
            echo "</table>";
        }
        //Se valida que la fecha sea valida
        function validarFecha($fecha){
            $valores = explode('/', $fecha);
            if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
                return true;
            }
                return false;
        }

        //Devuelve el numero de dias de un mes
        function diasMes($mes, $annio)
        {
            $numero_dias = cal_days_in_month(CAL_GREGORIAN, $mes, $annio); 
            echo "El mes {$mes} del {$annio} tiene {$numero_dias}";
            return $numero_dias;
        }
        //devuelve el dia de la semana de una fecha
        function diaSemana($d, $m, $y){
            $dia_semana = date("w", mktime(0, 0, 0, $m, $d, $y));
            echo "El díade la semana es:  {$dia_semana}";

        }
    ?>
</body>
</html>