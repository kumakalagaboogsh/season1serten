<?php 
$email = $password = "";

$emailErr = $passwordErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
    }


if ($email && $password) {

    include('connections.php');

    $check_email = mysqli_query($connections, "SELECT * FROM mytbl WHERE email='$email'");
    $check_email_rows = mysqli_num_rows($check_email);

    if ($check_email_rows > 0) {

while ($row = mysqli_fetch_assoc($check_email)) {

$db_password = $row['password'];
$db_account_type = $row['account_type'];

if($password == $db_password) {

if($db_account_type == 1) {
    echo "<script>window.location.href='admin';</script>";

}else{

    echo "<script>window.location.href='user';</script>";
}

}else{



    
    $passwordErr = "Incorrect password!";
}

}

    }else{

        $emailErr = "Email not registered!";

}
}
}


?>



<style>
    .error {color: #FF0000;}
</style>



<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Email: <input type="text" name="email" value="<?php echo $email;?>">
    <span class="error"><?php echo $emailErr;?></span>
    <br><br>
    Password: <input type="password" name="password">
    <span class="error"><?php echo $passwordErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Login">
</form>