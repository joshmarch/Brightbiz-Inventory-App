<?php
include "dbconn.php";

$Product_id = intval($_GET['Product_id']);
$result = $conn->query("SELECT * FROM inventory WHERE Product_id=$Product_id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Product_name = $_POST['Product_name'];
    $Price = $_POST['Price'];
    $Stock = $_POST['Stock'];
    $Quantity = $_POST['Quantity'];

    $stmt = $conn->prepare("UPDATE inventory SET Product_name=?, Price=?, Stock=?, Quantity=? WHERE Product_id=?");
    $stmt->bind_param("sdiii", $Product_name, $Price, $Stock, $Quantity, $Product_id);
    $stmt->execute();

    header("Location: brightbizz.php");
    exit;
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Update Product</title>
    <style>
        body { font-family: Poppins, sans-serif; background-color: #f5f5f5; text-align: center; }
        form { background: #fff; display: inline-block; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        input[type=text], input[type=number] { width: 90%; padding: 8px; margin: 5px 0; }
        input[type=submit] { background-color: #28a745; color: white; border: none; padding: 8px 15px; border-radius: 5px; }
    </style>
</head>
<body>
<h2>Update Product Information</h2>
<form method="POST">
    <label>Product Name:</label><br>
    <input type="text" name="Product_name" value="<?php echo $row['Product_name']; ?>"><br>
    <label>Price:</label><br>
    <input type="number" step="0.01" name="Price" value="<?php echo $row['Price']; ?>"><br>
    <label>Stock:</label><br>
    <input type="number" name="Stock" value="<?php echo $row['Stock']; ?>"><br>
    <label>Quantity Sold:</label><br>
    <input type="number" name="Quantity" value="<?php echo $row['Quantity']; ?>"><br>
    <input type="submit" value="Update">
</form>
</body>
</html>