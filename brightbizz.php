<?php
include "dbconn.php";
$data = $conn->query("SELECT Product_name, Price, Quantity FROM inventory");
$products = [];
$totals = [];
while ($row = $data->fetch_assoc()) {
    $products[] = $row['Product_name'];
    $totals[] = $row['Price'] * $row['Quantity']; // CALCULATED TOTAL
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Sales Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Poppins, sans-serif; text-align: center; background: #eef2f3; }
        canvas { width: 90%; max-width: 700px; margin: 20px auto; }
        button { padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
<h2>📈 BrightBizz Sales Overview</h2>
<canvas id="salesChart"></canvas>
<button onclick="window.location.href='graph.php'">🔙 Back to Inventory</button>

<script>
const ctx = document.getElementById('salesChart');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($products); ?>,
        datasets: [{
            label: 'Total Sales (₱)',
            data: <?php echo json_encode($totals); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.6)'
        }]
    },
});
</script>
</body>
</html>