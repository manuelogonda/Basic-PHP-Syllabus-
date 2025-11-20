<?php
session_start();
require_once "user_registrationdb.php";

$errors = [];
//Basic input validation
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_cornfirm = $_POST['password_cornfirm'] ?? '';

    if($name === '' || $email === '' || $password === ''  || $password_cornfirm === ''){
        $errors[] = "All fields are required";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[] = "Please enter a valid email address";

    }
    if(strlen($password) < 6){
      $errors[] = "Password must be atleast 6 characters";
    }
    if($password !== $password_cornfirm){
       $errors[] = "Passwords do not match";
    };
}
// TO check existing email if no errors
if(empty($errors)){
$stmt = $mysqli -> prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
$stmt->bind_param('s',$email);
$stmt->execute();
$stmt->store_result();
if($stmt -> num_rows > 0){
    $errors[] = "Email already registered";
}
$stmt -> close();
};

// Inserting a new user
if(empty($errors)){
    $password_hash = password_hash($password,PASSWORD_DEFAULT);
    $stmt = $mysqli -> prepare('INSERT INTO users(name,email,password) VALUES(?,?,?)');
    $stmt -> bind_param('sss',$name,$email,$password_hash);
    $stmt -> execute();
    $stmt -> close();

    $_SESSION['success'] = "Registration successfull.Please login";
    header('location : login.php');
    exit();
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php if(empty($errors)) :?>
        <div style = "color : red;">
            <ul>
            <?php foreach($errors as $e) :?>
                <li><?php echo htmlspecialchars($e);?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="register.php" method="POST">
        <label>
            Name: <br>
            <input type="text" name="name" value = "<?php echo isset($name) ? htmlspecialchars($name) : '';?>">
        </label>
        <br><br>
        <label>
            Email: <br>
            <input type="text" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : '';?>">
        </label>
        <br><br>
        <label>
            Password: <br>
            <input type="text" name="password">
        </label>
        <br><br>
        <label>
          Confirm Password:<br>
          <input type="password" name="password_confirm">
        </label><br><br>
         <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
