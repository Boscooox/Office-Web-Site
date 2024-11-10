<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            flex-direction: column;
        }
        form{
            display: flex;
            flex-direction: column;
            width: 300px;
        }
        form > input{
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<?php
    $host="localhost";
    $username = "root";
    $password = "";
    $db_name = "classicmodels";
    //crea la connessione con il db
    $conn = new mysqli($host,$username,$password,$db_name);
    //controllo la connessione, ipotizzando non sia andata a buon fine
    if($conn->connect_error){
        echo "<h2>Connessione al server fallita</h2>";
        echo "<h3>" . $conn -> connect_error . "</h3>";
        exit();
    }
    //creo la tabella credenziali
    $sql = "CREATE TABLE IF NOT EXISTS credenziali(
        user varchar(30) NOT NULL PRIMARY KEY,
        password varchar(16) NOT NULL,
        email varchar(30), 
        eta numeric(2)
        )";
    $conn->query($sql);
    $user = 'Paperino';
    $controllo = "SELECT * FROM credenziali WHERE user = '$user'";
    $risultato = $conn->query($controllo);
    if ($risultato->num_rows == 0) {
    //Il nome utente non esiste, quindi lo inserisce
    $sql ="INSERT INTO credenziali (user, password, email) VALUES ('Paperino', '12345', 'Paperino34@gmoil.com')";
    $conn->query($sql);
    } //se l'utente esiste già non la crea 
?>
<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$db_name = "classicmodels";
// Connessione al database
$conn = new mysqli($host, $username, $password, $db_name);
// Controllo dell'esito della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
// Controllo del login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $userPassword = $_POST['password'];
    // Query 
    $query = "SELECT * FROM credenziali WHERE user = '$user' AND password = '$userPassword'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $_SESSION['user'] = $user;
    //ti rimanda alla pagina degli uffici
        header("Location: elencoUffici.php"); 
        exit;
    } else {
        $error = "Credenziali non valide";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="post" action="login.php">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
