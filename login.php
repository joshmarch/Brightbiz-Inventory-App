<?php
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    header("Location: index.php");
    exit();
}

include "dbconn.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['admin'] = true;
            header("Location: index.php");
            exit();
        }
    }

    $error = "Invalid credentials. Admin access only.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<style>
body { font-family: Arial; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f1f1f1; margin: 0; }
.login-box { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 350px; }
h2 { text-align: center; margin-bottom: 20px; }
input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
button { width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
button:hover { background: #0056b3; }
.error { color: red; text-align: center; }
</style>
</head>
<body>
<div class="login-box">
<h2>Admin Login</h2>
<?php if ($error) echo "<p class='error'>$error</p>"; ?>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
</div>
</body>
</html>
