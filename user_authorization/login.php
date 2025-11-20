<?php
session_start();
require_once 'user_registrationdb.php';

$errors = [];
if($_SERVER['REQUEST_METHOD' === 'POST']){
  $email = trim($_POST['email'] ?? '');
  $password = trim($_POST['passward'] ?? '');

  if($email === '' || $password === ''){
    $errors[] = 'Email and password are required';
  };
  if(empty($errors)){
    $stmt = $mysql->prepare('SELECT id, email, password FROM users WHERE email = ? LIMIT 1');
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result = $stmt -> get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if($user && password_verify($password,$user['password'])){
      //successfull login
      session_regenerate_id(true);
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['name'];
      header('Location: dashboard.php');
      exit;
    }else {
            $errors[] = 'Invalid email or password.';
        }
  }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <h2>Login</h2>

  <?php if (!empty($_SESSION['success'])): ?>
    <div style="color: green;"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
  <?php endif; ?>

  <?php if (!empty($errors)): ?>
    <div style="color: red;">
      <ul>
        <?php foreach ($errors as $e): ?>
          <li><?php echo htmlspecialchars($e); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="post" action="login.php">
    <label>
      Email:<br>
      <input type="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
    </label><br><br>

    <label>
      Password:<br>
      <input type="password" name="password">
    </label><br><br>

    <button type="submit">Login</button>
  </form>

  <p>No account? <a href="register.php">Register Here</a></p>
  
</body>
</html>