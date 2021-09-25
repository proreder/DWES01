<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos.css" type="text/css"/>
    <title>DWES Tarea01</title>
</head>
<body>
    
    
    <header>
        
            <h1 class="titulo">Tarea01- Ejercicio1: Normas de uso</h1>
            

    </header>
    <main>
        <div class="contenido">
            <span class="fecha">
                <?php
                    include('cabecera_fecha.php');
                ?>
            </span>
            
            <div class="normas">
                <?php
               
                $norma="";
                    //se incluye el array que contiene la ruta de los archivos
                    include_once("config/normas.php");
                    //se verifica si existen parámetros de entrada via GET
                    if (!(isset($_GET['ver_norma'])) || (empty($_GET['ver_norma']))){
                        
                            echo "<span class='error'>";
                            echo "<h3>No se ha indicado una norma<h3>";
                            echo "</span>";
                             
                    }else{
                        //se obtiene la norma y se compara con las tres posibles
                        $norma=$_GET['ver_norma'];
                        switch ($norma) {
                            case 'np':
                                $url=$url_normas['np'];
                                readfile($url);
                                break;
                            case 'ng':
                                $url=$url_normas['ng'];
                                include_once($url);
                                break;
                            case 'ns':
                                $url=$url_normas['ns'];
                                include_once($url);
                                break;
                            default:
                                echo "<span class='error'>";
                                echo "<h3>La norma no existe<h3>";
                                echo "</span>";
                            break;
                        }
                    }
                ?>
            </div>
            
            <span class="fecha">
                <?php
                    include('cabecera_fecha.php');
                ?>
            </span>
        </div>
    </main>
    <footer>
        <div class="pie">
           <h2> DWES 2021-2021-Juan Francisco Vico Martínez </h2>
        </div>
    </footer>
    
</body>
</html>