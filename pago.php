
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago Elegante</title>
    <link rel="stylesheet" href="papeleria.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="datos.php">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
        }
        .payment-form-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #333;
        }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        input:focus {
            border-color: #4CAF50;
            outline: none;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 700;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <img src="logos/cecytem-logo-57EA94498B-seeklogo.com.png" alt="" width="80" height="100">
        <div class="container">
            <center><a href="#" class="logo">Pages & Pixels</a></center>
            <br>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="papeleria.html">Papelería</a></li>
                <li><a href="integrantes.html">Integrantes</a></li>
                <li><a href="encargados.html">Encargados</a></li>
                <li><a href="login-register/Sesion.php">Iniciar Sesión</a></li>
            </ul>
        </div>
        <img src="logos/logo.png" alt="" width="250" height="100">
    </nav>
</header>
<main>
    <div class="payment-form-container">
        <h2>Formulario de Pago</h2>
        <form id="paymentForm">
            <div class="form-group">
                <label for="cardNumber">Número de Tarjeta</label>
                <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" required>
            </div>
            <div class="form-group">
                <label for="cardName">Nombre en la Tarjeta</label>
                <input type="text" id="cardName" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label for="expiryDate">Fecha de Expiración</label>
                <input type="text" id="expiryDate" placeholder="MM/AA" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" placeholder="123" required>
            </div>
            <button type="submit">Pagar Ahora</button>
        </form>
    </div>
</main>
<footer>
    <div class="container">
        <p>&copy; 2024 DeepSleep. Todos los derechos reservados.</p>
    </div>
</footer>
<script>
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Pago procesado con éxito!');
    });

    document.getElementById('cardNumber').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').replace(/(\d{4})(?=\d)/g, '$1 ');
    });

    document.getElementById('expiryDate').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').replace(/^(\d{2})(\d{0,2})/, '$1/$2');
    });

    document.getElementById('cvv').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
</body>
</html>
