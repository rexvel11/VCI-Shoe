<?php
session_start();
@include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $shoeId = intval($_POST['id']);
    $quantity = intval($_POST['quantity']);

    if ($shoeId > 0 && $quantity > 0) {
        $query = "UPDATE shoes SET stocks = stocks - $quantity WHERE id = $shoeId";

        if (mysqli_query($conn, $query)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }
}
?>
