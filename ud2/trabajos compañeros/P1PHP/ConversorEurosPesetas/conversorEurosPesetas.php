<!--Pasar de euros a pesetas y demás monedas-->
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h2>Conversor de Monedas</h2>
    <?php
    $resultado = '';

    // Obtenemos los datos del formulario
    $cantidad = $_POST['cantidad'];
    $moneda_origen = $_POST['moneda_origen'];
    $moneda_destino = $_POST['moneda_destino'];

    /* Aquí se define cuanto de 1 tipo de moneda son en distintos tipos de moneda.
    Es decir 1€ son 1.06$, 157.81JPY y 166.386ESP y así con todas las monedas*/
    $tasas_de_cambio = [
        // Pesetas españolas
        'ESP' => [
            'EUR' => 0,00601012,
            'USD' => 0.000689,
            'JPY' => 0.95037,
        ],
        // Dólares estadounidenses
        'USD' => [
            'EUR' => 0.94,
            'JPY' => 148.95,
            'ESP' => 157.984,
        ],
        // Euros
        'EUR' => [
            'USD' => 1.06,
            'JPY' => 157.81,
            'ESP' => 166.386,
        ],
        // Yenes japoneses
        'JPY' => [
            'USD' => 0.0067,
            'EUR' => 0.0063,
            'ESP' => 1.06198,
        ],
    ];

    // Realizamos la conversión de un tipo de moneda a otra
    if (isset($tasas_de_cambio[$moneda_origen]) && isset($tasas_de_cambio[$moneda_origen][$moneda_destino])) {
        $tasa_conversion = $tasas_de_cambio[$moneda_origen][$moneda_destino];
        $resultado = "$cantidad $moneda_origen son equivalentes a " . ($cantidad * $tasa_conversion) . " $moneda_destino";
    } else {
        $resultado = 'Es lo mismo, estás intentando pasar de una moneda a un mismo tipo de moneda';
    }
     ?>

        <!--FORMULARIO-->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="cantidad">Cantidad:</label>
            <input type="text" id="cantidad" name="cantidad" required>
            <br>
            <label for="moneda_origen">De:</label>
            <!--Creamos un elemento select para poder elegir entre distintas opciones-->
            <select id="moneda_origen" name="moneda_origen" required>
                <!--Añadimos las opciones posibles anteriormente creadas ($tasas_de_cambio)-->
                <option value="USD">Dólar estadounidense (USD)</option>
                <option value="EUR">Euro (EUR)</option>
                <option value="JPY">Yen japonés (JPY)</option>
                <option value="ESP">Peseta Española (ESP)</option>
            </select>
            <br>
            <label for="moneda_destino">A:</label>
            <!--Creamos un elemento select para poder elegir entre distintas opciones-->
            <select id="moneda_destino" name="moneda_destino" required>
                <!--Añadimos las opciones posibles anteriormente creadas ($tasas_de_cambio)-->
                <option value="USD">Dólar estadounidense (USD)</option>
                <option value="EUR">Euro (EUR)</option>
                <option value="JPY">Yen japonés (JPY)</option>
                <option value="ESP">Peseta Española (ESP)</option>
            </select>
            <br>
            <input type="submit" value="Convertir">
        </form>
        
        <!--Aquí mostramos el título "Resultado de la conversión" y en un párrafo por debajo ponemos el resultado-->
        <h3>Resultado de Conversión</h3>
        <p>
            <?php echo $resultado; ?>
        </p>
    </body>
</html>