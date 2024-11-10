<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Ufficio</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            padding: 20px;
            flex-direction: column;
            align-items: center;
        }

        form {
            width: 300px;
            border: 1px solid #ccc;
            padding: 16px;
            border-radius: 8px;
        }

        label {
            margin-top: 10px;
        }

        input,button {
            width: 90%;
            padding: 8px;
            margin-top: 6px;
        }

        .dato {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }
    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "classicmodels";
    $conn = new mysqli($host, $username, $password, $db_name);
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $officeCode = $_POST['officeCode'];
        $city = $_POST['city'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $country = $_POST['country'];
        $postalCode = $_POST['postalCode'];
        $territory = $_POST['territory'];
        //query
        $query = "INSERT INTO offices (officeCode, city, phone, addressLine1, country, postalCode, territory) VALUES ('$officeCode', '$city', '$phone', '$address', '$country', '$postalCode', '$territory')";
        $conn->query($query);
        echo "ufficio aggiunto corretamente";
    }
    $conn->close();
    ?>
    <form method="post" action="aggiungiUfficio.php">
        <div class="dato">
            <label for="officeCode">Codice Ufficio:</label>
            <input type="text" id="officeCode" name="officeCode" required>
        </div>
        <div class="dato">
            <label for="city">Città:</label>
            <input type="text" id="city" name="city" required>
        </div>
        <div class="dato">
            <label for="phone">Telefono:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div class="dato">
            <label for="address">Indirizzo:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="dato">
        <label for="country">Paese:</label>
        <input type="text" id="country" name="country" required>
        </div>
        <div class="dato">
            <label for="postalCode">Codice Postale:</label>
            <input type="text" id="postalCode" name="postalCode" required>
        </div>
        <div class="dato">
            <label for="territory">Territorio:</label>
            <input type="text" id="territory" name="territory" required>
        </div>
        <button type="submit">Aggiungi Ufficio</button>
    </form>
    <a href="elencoUffici.php"> Visualizza l'ufficio aggiunto </a><br>
    <a href="login.php"> Torna al login </a>
</body>

</html>