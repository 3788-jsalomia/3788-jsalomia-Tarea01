<?php
    echo '
        <!doctype html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <title>TAREA INDIVIDUAL</title>
            
            <style type="text/css">
                #background{position:absolute; width:99%; height:130%;}
                #fixed {position:absolute; top: 0px; left: 0px;}
            </style>
            <link rel="stylesheet" href="../css/bootstrap.css">
        </head>
        <body>
            <div>
                <img id="background" src="../Imagenes/fondo.jpg"/> 
            </div>
            
            <div class="container">
                <div class="col-md-6 col-md-offset-3">
                    
                        </br></br></br>
                        <div style="padding-left: 90px;">
                            <img src="../Imagenes/selloespe.jpg" alt="ESPE" height="100" >
                        </div>
                        <div>
                            <h2>
                                <p style="text-align: center" style="color:#165014" ;>DEPARTAMENTO DE CIENCIAS DE LA COMPUTACIÓN</p>
                                <p style="text-align: center" style="color:#165014" ;>INGENIERÍA EN TECNOLOGIAS</p>
                            </h2>
                            <h3>
                                <p style="text-align: center" style="color:#165014" ;>APLICACIONES DE TECNOLOGIAS WEB - PHP BASICO</p>
                            </h3>
                        </div>
                        <div>
                        <h3>
                            <p style="text-align: center" style="color:#165014" ;>MENU 1</p>
                        </h3>
                        </div>
                        
                            
                        <ul style="text-align: center; list-style: none;">
                            <li  class="list-group-item list-group-item-success"><a href="?opcion=1">1. Factorial</a></li>
                            <li  class="list-group-item list-group-item-warning"><a href="?opcion=2">2. Primo</a></li>
                            <li  class="list-group-item list-group-item-success"><a href="?opcion=3">3. Serie Matemática</a></li>
                            <li  class="list-group-item list-group-item-warning"><a href="../index.html">S. Salir</a></li>
                        </ul>
                    
                </div>
            </div>            
        </body>
    </html>';

/* Funciones */

function calcularFactorial($num) {
    $factorial = 1;
    for ($i = 1; $i <= $num; $i++) {
        $factorial *= $i;
    }
    return $factorial;
}

function esPrimo($num) {
    if ($num < 2) return false;
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i === 0) return false;
    }
    return true;
}

function calcularSerieMatematica($num) {
    $resultado = 0;
    for ($i = 1; $i <= $num; $i++) {
        $termino = pow($i, 2) / calcularFactorial($i);
        $resultado += ($i % 2 === 0) ? -$termino : $termino;
        echo "
        <div class='container'>
                    <div class='col-md-6 col-md-offset-3'>
                        <p>serie: $resultado</p>
                    </div>
                </div>
        ";
    }
    return $resultado;
}

function validarEntero($input, $min, $max) {
    return filter_var($input, FILTER_VALIDATE_INT, ["options" => ["min_range" => $min, "max_range" => $max]]) !== false;
}


 /*
    GET: Usado para recuperar datos del servidor (como cuando accedes a una URL en el navegador).
    isset() verifica si una variable está definida y no es null.
*/

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['opcion'])) {
    $opcion = $_GET['opcion'];

    switch ($opcion) {
        case '1': // Factorial
            if (isset($_GET['num']) && validarEntero($_GET['num'], 0, 10)) {
                $num = $_GET['num'];
                $factorial = calcularFactorial($num);
                
                echo "
                <div class='container'>
                    <div class='col-md-6 col-md-offset-3'>
                        <p>El factorial de $num es: $factorial</p>
                    </div>
                </div>
                ";
            } else {
                echo "
                <div class='container'>
                    <div class='col-md-6 col-md-offset-3'>
                        <form method='GET'>
                            <label>Ingrese un número entero entre 0 y 10: </label>
                            <input type='hidden' name='opcion' value='1'>
                            <input type='number' name='num' min='0' max='10' required>
                            <button type='submit' class='btn btn-primary'>Calcular</button>
                        </form>
                    </div>
                </div>";
            }
            break;

        case '2': // Primo
            if (isset($_GET['num']) && validarEntero($_GET['num'], 0, 10)) {
                $num = $_GET['num'];
                $primo = esPrimo($num) ? 'es primo' : 'no es primo';
                echo "
                <div class='container'>
                    <div class='col-md-6 col-md-offset-3'>
                        <p>El número $num $primo.</p>
                    </div>
                </div>
                ";
            } else {
                echo "
                
                    <div class='container'>
                        <div class='col-md-6 col-md-offset-3'>
                            <form method='GET'>
                                <label>Ingrese un número entero entre 0 y 10: </label>
                                <input type='hidden' name='opcion' value='2'>
                                <input type='number' name='num' min='0' max='10' required>
                                <button type='submit'>Verificar</button>
                            </form>
                        </div>
                    </div>";
            }
            break;

        case '3': // Serie Matemática
            if (isset($_GET['num']) && validarEntero($_GET['num'], 0, 10)) {
                $num = $_GET['num'];
                $serie = calcularSerieMatematica($num);
                
                echo "
                <div class='container'>
                        <div class='col-md-6 col-md-offset-3'>
                        <p>El resultado de la serie matemática con $num términos es: $serie</p>
                    </div>
                 </div>
                ";
            } else {
                echo "
                 <div class='container'>
                        <div class='col-md-6 col-md-offset-3'>
                         <form method='GET'>
                            <label>Ingrese un número entero entre 0 y 10: </label>
                            <input type='hidden' name='opcion' value='3'>
                            <input type='number' name='num' min='0' max='10' required>
                            <button type='submit'>Calcular</button>
                        </form>
                    </div>
                 </div>";
            }
            break;

        default:
            echo "<p>Opción inválida. Por favor, intente nuevamente.</p>";
    }
}

?>