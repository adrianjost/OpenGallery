<?php 
//$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
?>

<?php
$showFormular = true; //Variable ob das Registrierungsformular angezeigt werden soll

if(
    isset($_POST['firstname'])
  &&isset($_POST['lastname'])
  &&isset($_POST['email'])
  &&isset($_POST['passwort'])
  &&isset($_POST['passwort2'])
  ) {
    $error = false;
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if(strlen($firstname) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if(strlen($lastname) == 0) {
        echo 'please enter your last name<br>';
        $error = true;
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    } 
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) { 
        /*
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        } 
        */
    }

    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) { 
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        /*
        $statement = $pdo->prepare("INSERT INTO users (email, passwort) VALUES (:email, :passwort)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash));
        
        if($result) { 
            echo 'Du wurdest erfolgreich registriert. <a href="login">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }*/
        $showFormular = false;
    } 
}

if($showFormular) {
?>
 
<form action="" method="post">
    First Name:<br>
    <input type="text" maxlength="255" name="firstname" required><br>

    Last Name:<br>
    <input type="text" maxlength="255" name="lastname" required><br><br>


    E-Mail:<br>
    <input type="email" maxlength="250" name="email" required><br>
     
    your password:<br>
    <input type="password" maxlength="250" name="passwort" required><br>
     
    repeat password:<br>
    <input type="password" maxlength="250" name="passwort2" required><br><br>
     
    <input type="submit" value="register">
</form>
 
<?php
} //Ende von if($showFormular)
?>