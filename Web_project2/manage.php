<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
require_once 'settings.php';

$query = "SELECT * FROM eoi WHERE 1=1"; 
$params = [];
$types = "";

if (!empty($_GET['job_reference'])) {
    $query .= " AND job_reference = ?";
    $params[] = $_GET['job_reference'];
    $types .= "s";
}

if (!empty($_GET['first_name'])) {
    $query .= " AND first_name LIKE ?";
    $params[] = "%" . $_GET['first_name'] . "%";
    $types .= "s";
}
if (!empty($_GET['last_name'])) {
    $query .= " AND last_name LIKE ?";
    $params[] = "%" . $_GET['last_name'] . "%";
    $types .= "s";
}

$allowed_sorts = ['id', 'job_reference', 'first_name', 'last_name', 'status'];
$sort_by = isset($_GET['sort']) && in_array($_GET['sort'], $allowed_sorts) ? $_GET['sort'] : 'id';
$query .= " ORDER BY $sort_by ASC";

if (isset($_POST['update_status'])) {
    $eoi_id = $_POST['eoi_id'];
    $new_status = $_POST['status']; // e.g., 'New', 'Current', 'Final'

    $stmt = $conn->prepare("UPDATE eoi SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $eoi_id);
    $stmt->execute();
}

if (isset($_POST['delete_by_ref'])) {
    $job_ref_to_delete = $_POST['job_reference_delete'];

    $stmt = $conn->prepare("DELETE FROM eoi WHERE job_reference = ?");
    $stmt->bind_param("s", $job_ref_to_delete);
    $stmt->execute();
}
?>