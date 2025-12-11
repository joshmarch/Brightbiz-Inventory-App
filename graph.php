<?php include "dbconn.php"; ?>

<!DOCTYPE HTML>
<html>
<head>
    <title>BrightBizz Inventory</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            text-align: center;
        }
        h2 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            margin: 20px auto;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        input[type=text], input[type=number] {
            width: 90%;
            padding: 8px;
            margin: 5px 0;
        }
        input[type=submit] {
            padding: 8px 15px;
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 90%;
            background: white;
        }
        th, td {
            border: 1px solid #888;
            padding: 10px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .buttons {
            margin: 20px;
        }
        button {
            padding: 10px;
            margin: 5px;
            border: none;
            background: #007BFF;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<h2>BrightBizz Inventory Management </h2>

<form method="POST">
    <label>Product Name:</label><br>
    <input type="text" name="Product_name" required><br>
    <label>Price:</label><br>
    <input type="number" name="Price" step="0.01" required><br>
    <label>Stock:</label><br>
    <input type="number" name="Stock" required><br>
    <label>Quantity Sold:</label><br>
    <input type="number" name="Quantity" required><br>
    <input type="submit" name="Submit" value="Add Product">
</form>

<div class="buttons">
    <button onclick="window.location.href='brightbizz.php'">📊 View Graph</button>
    <button onclick="window.print()">🖨️ Print / Download</button>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Product_name = $_POST['Product_name'];
    $Price = $_POST['Price'];
    $Stock = $_POST['Stock'];
    $Quantity = $_POST['Quantity'];

    $stmt = $conn->prepare("INSERT INTO inventory (Product_name, Price, Stock, Quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdii", $Product_name, $Price, $Stock, $Quantity);
    $stmt->execute();
    echo "<script>window.location='brightbizz.php';</script>";
    exit;
}


$result = $conn->query("SELECT * FROM inventory ORDER BY Product_id DESC");
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Quantity Sold</th>
                <th>Remaining Stock</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['Product_id']}</td>
            <td>{$row['Product_name']}</td>
            <td>{$row['Price']}</td>
            <td>{$row['Stock']}</td>
            <td>{$row['Quantity']}</td>
            <td>{$row['Remaining_stock']}</td>
            <td>{$row['Total_amount']}</td>
            <td>
                <a href='update.php?Product_id={$row['Product_id']}'>Update</a> | 
                <a href='delete.php?Product_id={$row['Product_id']}' onclick='return confirm(\"Delete this item?\")'> Delete</a>
            </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No products yet.</p>";
}
?>
</body>
</html>