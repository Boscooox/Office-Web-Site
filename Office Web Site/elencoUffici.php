<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Uffici</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            padding: 20px;
            flex-direction: column;
            align-items: center;
        }
        table {
            width: 80%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .verticale{
            display: flex;
            flex-direction: column;
        }
        .flex{
            display: flex;
            padding: 10px;
            gap: 3px;
        }
    </style>
</head>
<body>
<a href="aggiungiUfficio.php">Aggiungi nuovi uffici</a><br>
<a href="login.php">Torna al login</a>
<form class="flex" method="post" action="elencoUffici.php">
<div class="verticale">
    <label for="officeCode">Inserisci il code dell'ufficio da cancellare:</label>
    <input type="text" name="CodiceUfficio">
</div>
    <button type="submit" name="cancella"> CANCELLA </button>
</form>
    <?php
    session_start();
    // Verifica se l'utente è loggato
    if (!isset($_SESSION['user'])) {
        // Non loggato, reindirizza al login
        header("Location: login.php");
        exit;
    }
    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "classicmodels";
    // Connessione al database
    $conn = new mysqli($host, $username, $password, $db_name);
    // Controllo connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancella'])) {
        $ufficioCancellato = $_POST['CodiceUfficio'];
        $query = "DELETE FROM offices where officeCode = $ufficioCancellato";
        $result = $conn->query($query);
    }
    // Query per ottenere dati degli uffici
    $query = "SELECT officeCode, city, phone, addressLine1, country, postalCode, territory FROM offices";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Ottieni tutti i risultati come un array
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        echo "<table><tr><th>Codice Ufficio</th><th>Città</th><th>Telefono</th><th>Indirizzo</th><th>Paese</th></tr>";
        // Itera sull'array di risultati
        foreach ($rows as $row) {
            echo "<tr><td>".$row["officeCode"]."</td><td>".$row["city"]."</td><td>".$row["phone"]."</td><td>".$row["addressLine1"]."</td><td>".$row["country"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 risultati";
    }
    $conn->close();
    ?>
</body>
</html>
