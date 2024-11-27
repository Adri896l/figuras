<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geometry Calculator</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="assets/js/main.js"></script>
</head>
<body>
<div class="container">
    <h1>Geometry Calculator</h1>

    <div class="entrada">
        <form id="geometryForm" class="form-control">
            <div class="text-right mt-3">
                <a href="../service/logout.php" class="btn btn-danger">Cerrar sesión</a>
            </div>
        
            <h2 class="text-center mt-4">Bienvenido <?php echo $_SESSION['usuario']; ?></h2>
            
            <label for="shape" class="col-form-label">Selecciona una figura:</label>
            <select id="shape" class="form-select" name="shape" onchange="showInputs()">
                <option selected>............</option>
                <option value="square">Cuadrado</option>
                <option value="heptagono">Heptágono</option>
                <option value="triangulo">Triángulo Equilatero</option>
                <option value="hexagono">Hexágono regular</option>
                <option value="pentagono">Pentágono regular</option>
            </select>

            <div id="inputs"></div>

            <button type="button" onclick="calculate()" class="btn btn-outline-info mt-3">Calcular</button>
        </form>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <canvas id="myCanvas" width="500" height="500"></canvas>
        </div>
        <div class="col-md-6">
            <h3>Resultados</h3>
            <div id="resultados" class="p-3 bg-light text-dark border rounded">
                <p>Área: <span id="areaResultado">-</span></p>
                <p>Perímetro: <span id="perimetroResultado">-</span></p>
            </div>

            <div id="paypal-button-container" class="mt-4">  </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AZd1G3xzLWdIulPq9YsIiueeyFtVo-uK773g3GAZDgtaR0KtguhuwT70d5yJvOMzmRE5-23Owwfcncss&currency=USD"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: calculateTotal()
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Pago completado por ' + details.payer.name.given_name);
                // Aquí puedes realizar otras acciones después de que el pago sea exitoso
            });
        },
        onCancel: function(data) {
            alert('Pago cancelado');
        }
    }).render('#paypal-button-container'); 

    function calculateTotal() {
        return 10; 
    }
</script>
</body>
</html>
