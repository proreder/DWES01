<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/calendario.css" type="text/css"/>
    <title>Ejercicio 2.1- Calendario mejorado</title>
</head>
<body>
    <?php
        //definimos la constante SEMANAS que corresponde con las filas de la tabla
        define ('SEMANAS', 8);

        //definimos las variables
        $diaSemana;
        $diasDelMes;
        //$annio;
        $dia; 
        $mes;
        
        $annioEntrada;
        $texto_error="";
        $errorEntrada=false;

        if(!(isset($_GET['d']) || isset($_GET['m']) || isset($_GET['a']))){
            $errorEntrada=true;
            $texto_error="El formato de entrada no es correcto, ejemplo: http://localhost/DWES01/ejercicio2.1.php?d=1&m=1&a=2021";
        }
        //si no hay error de entrada procesamos los parámetros que no esten vacios
        elseif(empty($_GET['d']) || empty($_GET['m']) || empty($_GET['a'])){
            $errorEntrada=true;
            $texto_error="Falta un parámetro de entrada, ejemplo: 12/05/2021";
        }
        //verificamos que la fecha sea válida
        if(!$errorEntrada){
            $d=$_GET['d'];
            $m=$_GET['m'];
            $a=$_GET['a'];
            $fechaEntrada=$d.'/'.$m.'/'.$a;
            
            $error_fecha=validarFecha($fechaEntrada);
            if(!$error_fecha){
                $errorEntrada=true;
                $texto_error="La fecha no es válida, ejemplo: http://localhost/DWES01/ejercicio2.1.php?d=1&m=1&a=2021";  
            }else{
               //Se dibuja la tabla pasando la fecha introducida por via get
               pintarTabla($d, $m, $a);
               
            }
        }
        if($errorEntrada){
            echo "<span class='error'>";
            echo $texto_error;
            echo "</span>";
        }

        /**
        * Se dibuja el calendario
        * @param integer $dia 
        * @param integer $mes
        * @param integer $annio 
        */
        function pintarTabla($dia, $mes, $annio){
            //se obtiene el dia de la semana del mes que se le pasa como parámetro
            $diaComienzoSemana=diaSemana($dia, $mes, $annio);
            //se obtiene los dias que tiene un mes que se le pasa como parametro
            $diasDelMes=diasMes($mes,$annio);
            $filasTitulos=true;
            $celdasEnBlanco=true;
            $columnas=7;
            $enBlanco=false;
            $arrayMeses= ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            $arrayDiasSemana= ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
            
            $mes=intval($mes);
            echo "<table>";

            for ($fila=1;$fila<=SEMANAS;$fila++){//bucle para las filas/SEMANAS
                //para cada nueva fila posicionamos la celda 1
                $celda=1;
                if($filasTitulos==true){
                    
                    //pintamos el mes
                    echo ("<tr><td class='mes' colspan='7'>${arrayMeses[$mes-1]}</td></tr>");
                    //pintamos la cabecera de la tabla
                    echo "<tr>";
                    for ($i=0;$i<7;$i++){
                        echo ("<td class='cabecera'>${arrayDiasSemana[$i]}</td>");
                    }
                    echo "</tr>";
                    //agregamos las celdas en blanco si hay
                    //$enBlanco= celdaEnBlanco($celda, $diaSemana, $fila);
                    
                    
                    $filasTitulos=false;
                }
                if($diaComienzoSemana>1 && $celdasEnBlanco){
                        echo"<tr>";
                        for($i=1;$i<$diaComienzoSemana;$i++){
                         echo "<td class='blanco'>---</td>";
                         $celda++;
                        }
                        $celdasEnBlanco=false;
                    }
                if($diaComienzoSemana==1){
                    echo "<tr>";
                }    
                
                do{//bucle para las celdas/días
                   
                    
                    if($celda<6){
                        echo "<td class='laboral'>${dia}/${mes}/${annio}</td>";
                        $dia++;
                    }
                    if(($celda==6 || $celda==7)){
                        echo "<td class='festivo'>${dia}/${mes}/${annio}</td>";
                        $dia++;
                    }
                     
                    //si $dia supera $diasDelMes ponemos a 1 $dia y sumamos un mes
                    if($dia>$diasDelMes){
                        $dia=1;
                        $mes++;
                        if($mes==13) {
                            $mes=1;
                            $annio++;
                            
                        }
                        $celdasEnBlanco=true;
                        $celda=7;
                        //echo "<br>";
                        //pintamos el mes
                        echo ("<tr><td class='mes' colspan='7'>${arrayMeses[$mes-1]}</td></tr>");
                        //pintamos la cabecera de la tabla
                        echo "<tr>";
                        for ($i=0;$i<7;$i++){
                            echo ("<td class='cabecera'>${arrayDiasSemana[$i]}</td>");
                        }
                        echo "</tr>";
                        //si el mes llega a 13, ponemos mes a 1 (enero) y sumamos un año
                        
                        $diaComienzoSemana=diaSemana($dia, $mes, $annio);
                        //obtenems los días del siguiente mes
                        $diasDelMes=diasMes($mes, $annio);
                        
                    }
                    $celda++;
                }while($celda<8);
                echo "</tr>";
                
            }
            echo "</table>";
        }
        /**
         * Se verifica si para la fila 1 existen celdas en blanco que no tienen días
         * @param integer $celda
         * @param integer $diaSemana
         * @returm boolean true si la clda estará en blanco
         */
        function celdaEnBlanco($celda, $diaSemana, $fila){
            if($celda<$diaSemana && $fila==1){
                return true;
            }else{
                return false;
            }
            
        }
        /**
         * Se valida que la fecha sea valida
         * @param string $fecha 
         * @return boolean true si la fecha es válida
         */
        function validarFecha($fecha){
            $valores = explode('/', $fecha);
            if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
                return true;
            }
                return false;
        }

        /**
         * Devuelve el numero de dias de un mes
         * @param int $mes Mes del que se quiere conocer los dias que tiene
         * @param int $annio Año para realizar el cálculo
         * @return int Número de dias que contiene el mes
         */
        function diasMes($mes, $annio)
        {
            $numero_dias = cal_days_in_month(CAL_GREGORIAN, $mes, $annio); 
            //echo "El mes {$mes} del {$annio} tiene {$numero_dias}";
            return $numero_dias;
        }
        
        /**
         * devuelve el dia de la semana de una fecha
         * @param int $d Día del que se quiere conocer el día de la semana
         * @param int $m Mes del que se quiere conocer el día de la semana
         * @param int $a Año del que se quiere conocer el día de la semana
         * @return int Número que coresponde con el día de la semana de lunes a domingo
         */
        
        function diaSemana($d, $m, $y){
            $dia_semana = date("w", mktime(0, 0, 0, $m, $d, $y));
            //Si dia de la semana es 0, domingo, lo ponemos a día 7
            if($dia_semana==0) $dia_semana=7;
            //echo "El díade la semana es:  {$dia_semana}";
            
            return $dia_semana;

        }
        ?>
</body>
</html>