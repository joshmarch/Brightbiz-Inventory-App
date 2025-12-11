<?php
include "dbconn.php";

if (isset($_GET['Product_id'])) {
    $Product_id = intval($_GET['Product_id']);
    $conn->query("DELETE FROM inventory WHERE Product_id=$Product_id");
}

header("Location: brightbizz.php");
exit;
?>