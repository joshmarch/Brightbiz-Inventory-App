<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BrightBizz Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>

body, html { margin: 0; padding: 0; font-family: 'Poppins', sans-serif; background: #f5f7fa; }
a { text-decoration: none; }


header {
    background: linear-gradient(90deg, #4CAF50, #43a047);
    color: white;
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
header h1 { margin: 0; font-size: 24px; }
header .logout-btn {
    background: #fff;
    color: #4CAF50;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: 600;
    transition: 0.3s;
}
header .logout-btn:hover { background: #f1f1f1; }

.dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    padding: 40px;
}

.card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    padding: 30px;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}
.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 25px rgba(0,0,0,0.15);
}
.card h2 {
    margin-top: 0;
    color: #333;
    font-size: 20px;
}
.card p {
    color: #666;
    font-size: 14px;
}
.card a {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    background: #4CAF50;
    color: white;
    border-radius: 5px;
    transition: 0.3s;
}
.card a:hover {
    background: #43a047;
}
</style>
</head>
<body>

<header>
    <h1>📊 BrightBizz Dashboard</h1>
    <a class="logout-btn" href="logout.php">Logout</a>
</header>

<div class="dashboard">
    <div class="card">
        <h2>Inventory Management</h2>
        <p>Add, update, or delete products in your inventory.</p>
        <a href="GRAPH.PHP">Go to Inventory</a>
    </div>
    <div class="card">
        <h2>Sales Graph</h2>
        <p>View your sales statistics and track performance.</p>
        <a href="brightbizz.php">View Graph</a>
    </div>
</div>

</body>
</html>
