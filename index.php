<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Amortización</title>
    <link rel="stylesheet" href="styles.css">   
</head>
<body>
    <div class="container">
        <h1>Tabla de Amortización</h1>
        <form action="" method="post">
            <label for="monto">Monto del préstamo:</label>
            <input type="number" id="monto" name="monto" step="0.01" value="<?php echo isset($_POST['monto']) ? $_POST['monto'] : ''; ?>" required><br>
            
            <label for="plazo">Plazo en meses:</label>
            <input type="number" id="plazo" name="plazo" value="<?php echo isset($_POST['plazo']) ? $_POST['plazo'] : ''; ?>" required><br>
            
            <label for="tasa">Tasa de Interés (%):</label>
            <input type="number" id="tasa" name="tasa" step="0.01" value="<?php echo isset($_POST['tasa']) ? $_POST['tasa'] : ''; ?>" required><br>
            
            <button type="submit">Generar Tabla de Amortización</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener valores del formulario
            $monto = $_POST['monto'];
            $plazo = $_POST['plazo'];
            $tasa = $_POST['tasa'] / 100; // Convertir tasa de interés a decimal

            // Calcular el abono fijo al capital
            $abono_fijo = round($monto / $plazo, 2);

            // Mostrar tabla de amortización
            echo "<h2>Tabla de Amortización:</h2>";
            echo "<table>";
            echo "<tr><th>Periodo</th><th>Saldo</th><th>Interés</th><th>Abono</th><th>Pago</th></tr>";

            $saldo = $monto;
            for ($i = 1; $i <= $plazo; $i++) {
                $interes = round($saldo * $tasa, 2);
                $pago = round($interes + $abono_fijo, 2);
                $saldo = round($saldo - $abono_fijo, 2);

                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>Q " . number_format($saldo, 2) . "</td>";
                echo "<td>Q " . number_format($interes, 2) . "</td>";
                echo "<td>Q " . number_format($abono_fijo, 2) . "</td>";
                echo "<td>Q " . number_format($pago, 2) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
    </div>
</body>
</html>