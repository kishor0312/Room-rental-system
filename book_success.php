<?php
session_start();
include "config.php";

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$prop_id = $_GET["id"];
$user_id = isset($_SESSION["id"]) ? $_SESSION["id"] : null;

// If user is not logged in, redirect
if (!$user_id) {
    header("Location: login.php");
    exit;
}

// Check if this property already exists for the user in interaction_log
$query = "SELECT * FROM interaction_log WHERE prop_id = ? AND uid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $prop_id, $user_id);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row["weight"] < 0.9) {
        $query = "UPDATE interaction_log SET weight = 0.9 WHERE prop_id = ? AND uid = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $prop_id, $user_id);
        $stmt->execute();
    }
} else {
    $query = "INSERT INTO interaction_log (prop_id, weight, uid) VALUES (?, 0.9, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $prop_id, $user_id);
    $stmt->execute();
}

header("Location: owner_info.php?id=" . $prop_id);
exit;
?>
