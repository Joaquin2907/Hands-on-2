<?php
class SimpleLinearRegression {
    private $beta0;
    private $beta1;

    // Constructor que recibe el dataset y calcula los coeficientes
    public function __construct($data) {
        $sumX = 0;
        $sumY = 0;
        $sumXY = 0;
        $sumX2 = 0;
        $n = count($data);

        // Calcular sumas necesarias
        foreach ($data as $point) {
            $x = $point[0];
            $y = $point[1];
            $sumX += $x;
            $sumY += $y;
            $sumXY += $x * $y;
            $sumX2 += $x * $x;
        }

        // Calcular beta1 (pendiente) y beta0 (intersección)
        $this->beta1 = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - $sumX * $sumX);
        $this->beta0 = ($sumY - $this->beta1 * $sumX) / $n;
    }

    // Método para devolver la ecuación de regresión
    public function getEquation() {
        return "y = " . $this->beta0 . " + " . $this->beta1 . " * x";
    }

    // Método para predecir el valor de y dado un valor de x
    public function predict($x) {
        return $this->beta0 + $this->beta1 * $x;
    }
}

// Clase principal para gestionar la ejecución del programa
class Main {
    private $model;

    // Constructor que inicializa el modelo con el dataset
    public function __construct() {
        $data = [
            [23, 651],
            [26, 762],
            [30, 856],
            [34, 1063],
            [43, 1190],
            [48, 1298],
            [52, 1421],
            [57, 1440],
            [58, 1518]
        ];
        $this->model = new SimpleLinearRegression($data);
    }

    // Método para ejecutar el programa
    public function run() {
        // Imprimir la ecuación de regresión
        echo "La ecuación de regresión es: " . $this->model->getEquation() . "\n";

        // Pedir al usuario un valor de x
        echo "Introduce un valor para x: ";
        $x = trim(fgets(STDIN));

        // Predecir y basándose en el valor de x
        $y = $this->model->predict($x);
        echo "Para x = $x, el valor estimado de y es: $y\n";
    }
}

// Ejecutar el programa
$main = new Main();
$main->run();
