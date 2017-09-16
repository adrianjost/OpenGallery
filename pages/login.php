<h1>Login-Form</h1>
<?php 
//$pdo = new PDO('mysql:host=localhost;dbname=php-einfach', 'root', '');
 
if(isset($_POST['email']) && isset($_POST['passwort'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    /*
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }
    */
}
?>
 
<?php 
if(isset($errorMessage)) {
 echo $errorMessage;
}
?>
 
<form action="" method="post">
    E-Mail:<br>
    <input type="email" size="40" maxlength="250" name="email"><br><br>
     
    Dein Passwort:<br>
    <input type="password" size="40"  maxlength="250" name="passwort"><br>
     
    <input type="submit" value="Abschicken">
</form> 
