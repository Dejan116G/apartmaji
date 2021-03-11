<?php
include_once "database.php";
include_once "session.php";

$email = $_POST['email'];
$pass = $_POST['pass'];

if (!empty($email) && !empty($pass)) {
    $query = "SELECT * FROM osebe WHERE enaslov = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);

    if ($stmt->rowCount() == 1) {
        $user= $stmt->fetch(); // $user['first_name'],$user['last_name'],$user['id'],$user['pass']....
        

        if (password_verify($pass, $user['geslo'])) {
            $_SESSION['user_id'] = $user['id_osebe'];
            $_SESSION['admin'] = $user['admin'];
            $_SESSION['first_name'] = $user['ime'];
            $_SESSION['last_name'] = $user['priimek'];

            odziv("Dobrodošli!");

            header("Location: index.php");
            die();
        }
    }
}
header("Location: login.php");
die();
?>