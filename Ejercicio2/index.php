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
            p { color:#165014; }
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
                        <p style="text-align: center">DEPARTAMENTO DE CIENCIAS DE LA COMPUTACIÓN</p>
                        <p style="text-align: center">INGENIERÍA EN TECNOLOGIAS</p>
                    </h2>
                    <h3>
                        <p style="text-align: center">APLICACIONES DE TECNOLOGIAS WEB - PHP BASICO</p>
                    </h3>
                </div>
                <div>
                <h3>
                    <p style="text-align: center">MENU 2</p>
                </h3>
                </div>

                <div class="list-group">
                    <ul style="text-align: center; list-style: none;">
                        <li class="list-group-item list-group-item-success"><a href="?opcion=1">1. FIBONACCI</a></li>
                        <li class="list-group-item list-group-item-warning"><a href="?opcion=2">2. CUBO</a></li>
                        <li class="list-group-item list-group-item-success"><a href="?opcion=3">3. FRACCIONARIOS</a></li>
                        <li class="list-group-item list-group-item-warning"><a href="../index.html">S. Salir</a></li>
                    </ul>
                </div>
            </div>
        </div>            
    </body>
    </html>';

    /* Funciones */
    define('MAX', 1000000);

    function calcularFibonacci($n) {
        $fibonacci = [1, 1];
        for ($i = 2; $i < $n; $i++) {
            $fibonacci[] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
        }
        return $fibonacci;
    }

    function numerosCubo() {
        $resultados = [];
        for ($i = 1; $i <= MAX; $i++) {
            $sumaCubos = 0;
            $numero = $i;
            while ($numero > 0) {
                $digito = $numero % 10;
                $sumaCubos += pow($digito, 3);
                $numero = (int)($numero / 10);
            }
            if ($sumaCubos === $i) {
                $resultados[] = $i;
            }
        }
        return $resultados;
    }

    function calcularFraccionarios($a, $b, $c, $d) {
        return $a + ($b * $c) - $d;
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
            case '1':
                echo "
                <div class='container'>
                    <div class='col-md-6 col-md-offset-3'>
                        <form method='GET'>
                            <input type='hidden' name='opcion' value='1'> <!-- Mantener opcion=1 -->
                            <label>Ingrese un número entero positivo entre 1 y 50: </label>
                            <input type='number' name='n' min='1' max='50' required>
                            <button type='submit'>Calcular</button>
                        </form>                                  
                    </div>
                </div>";
                
                // Validar si 'n' está presente y es un entero válido
                if (isset($_GET['n']) && validarEntero($_GET['n'], 1, 50)) {
                    $n = $_GET['n'];
                    $fibonacci = calcularFibonacci($n);
            
                    // Mostrar resultado
                    echo "
                    <div class='container'>
                        <div class='col-md-6 col-md-offset-3'>
                            <p>Los primeros $n números de Fibonacci son: " . implode(', ', $fibonacci) . "</p>                            
                        </div>
                    </div>";
                }
                break;

            case '2':
                echo "
                <div class='container'>
                        <div class='col-md-6 col-md-offset-3'>
                            <p>Los números cuyo cubo de sus dígitos suma el mismo número son:</p>                        
                        </div>
                    </div>
                ";

                $resultados = numerosCubo();

                echo "
                <div class='container'>
                    <div class='col-md-6 col-md-offset-3'>
                        <p>" . implode(', ', $resultados) . "</p>                         
                    </div>
                </div>";

                
                break;

            case '3':
                // Mostrar el formulario
                echo "
                <div class='container'>
                    <div class='col-md-6 col-md-offset-3'>
                        <form method='GET'>
                            <h3>Ingrese las fracciones:</h3>";
                for ($i = 1; $i <= 4; $i++) {
                    echo "<label>Fracción $i - Numerador:</label>
                          <input type='number' name='numerador$i' required><br>
                          <label>Denominador:</label>
                          <input type='number' name='denominador$i' min='1' required><br>";
                }
                echo "<input type='hidden' name='opcion' value='3'>
                      <button type='submit'>Calcular</button>
                      </form>
                    </div>
                </div>";

                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $fracciones = [];
                    for ($i = 1; $i <= 4; $i++) {
                        $num = $_GET["numerador$i"];
                        $den = $_GET["denominador$i"];
                        if ($den > 0) {
                            $fracciones[] = $num / $den;
                        } else {
                            echo "<p>Error: denominador no puede ser 0.</p>";
                            exit;
                        }
                    }
                    $resultado = $fracciones[0] + ($fracciones[1] * $fracciones[2]) - $fracciones[3];
                    echo "
                    <div class='container'>
                        <div class='col-md-6 col-md-offset-3'>
                            <p>Resultado: $resultado</p>
                        </div>
                    </div>";
                }
                break;
                

        default:
            echo "<p>Opción inválida. Por favor, intente nuevamente.</p>";
        }
    }
?>
