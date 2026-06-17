<?php
session_start();

// 1. HD GATEKEEPER: Prevent unauthorized access instantly
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

require_once "settings.php"; 
// Connect using your exact settings variables
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("<p>Unable to connect to the database engine.</p>");
}

// -------------------------------------------------------------------------
// ACTION ENGINE A: PROCESS STATUS UPDATE REQUESTS
// -------------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    // FIX: Using your exact column 'eoinumber'
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);
    
    $update_sql = "UPDATE eoi SET status = '$new_status' WHERE eoinumber = '$update_id'";
    if (mysqli_query($conn, $update_sql)) {
        echo "<p style='color:green;'>✅ EOI Number $update_id updated successfully to $new_status.</p>";
    } else {
        echo "<p style='color:red;'>❌ Status update operation failed: " . mysqli_error($conn) . "</p>";
    }
}

// -------------------------------------------------------------------------
// ACTION ENGINE B: PROCESS MASS DELETION REQUESTS
// -------------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete') {
    // FIX: Using your exact column 'job_ref_num'
    $del_job_ref = mysqli_real_escape_string($conn, $_POST['delete_job_reference']);
    
    $delete_sql = "DELETE FROM eoi WHERE job_ref_num = '$del_job_ref'";
    if (mysqli_query($conn, $delete_sql)) {
        echo "<p style='color:green;'>✅ All records matching Job Reference '$del_job_ref' purged successfully.</p>";
    } else {
        echo "<p style='color:red;'>❌ Purge operation failed: " . mysqli_error($conn) . "</p>";
    }
}

// -------------------------------------------------------------------------
// REGENERATIVE QUERY CONSTRUCTION (READ ENGINE)
// -------------------------------------------------------------------------
$sql = "SELECT * FROM eoi WHERE 1=1"; 

// FIX: Aligned all search filters to match your actual table columns
if (isset($_GET['job_reference']) && $_GET['job_reference'] != "") {
    $job_ref = mysqli_real_escape_string($conn, $_GET['job_reference']);
    $sql .= " AND job_ref_num = '$job_ref'";
}
if (isset($_GET['first_name']) && $_GET['first_name'] != "") {
    $fname = mysqli_real_escape_string($conn, $_GET['first_name']);
    $sql .= " AND f_name LIKE '%$fname%'";
}
if (isset($_GET['last_name']) && $_GET['last_name'] != "") {
    $lname = mysqli_real_escape_string($conn, $_GET['last_name']);
    $sql .= " AND l_name LIKE '%$lname%'";
}

// FIX: Sorting logic configured for your real column variables
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'eoinumber';
$allowed_sorts = array('eoinumber', 'job_ref_num', 'f_name', 'l_name', 'status');
if (in_array($sort, $allowed_sorts)) {
    $sql .= " ORDER BY $sort";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Dashboard</title>
</head>
<body>
    <header>
        <p>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> | <a href="logout.php">Logout</a></p>
    </header>

    <h2>EOI Management Control Console</h2>
    <hr>

    <form action="manage.php" method="GET">
        <fieldset>
            <legend>Filter Data Sets</legend>
            <label for="job_reference">Job Reference:</label>
            <input type="text" name="job_reference" id="job_reference" value="<?php echo isset($_GET['job_reference']) ? htmlspecialchars($_GET['job_reference']) : ''; ?>">
            
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="<?php echo isset($_GET['first_name']) ? htmlspecialchars($_GET['first_name']) : ''; ?>">
            
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" value="<?php echo isset($_GET['last_name']) ? htmlspecialchars($_GET['last_name']) : ''; ?>">
            
            <label for="sort">Sort By Field:</label>
            <select name="sort" id="sort">
                <option value="eoinumber" <?php if($sort=='eoinumber') echo 'selected'; ?>>EOI Number</option>
                <option value="job_ref_num" <?php if($sort=='job_ref_num') echo 'selected'; ?>>Job Reference</option>
                <option value="f_name" <?php if($sort=='f_name') echo 'selected'; ?>>First Name</option>
                <option value="l_name" <?php if($sort=='l_name') echo 'selected'; ?>>Last Name</option>
                <option value="status" <?php if($sort=='status') echo 'selected'; ?>>Status</option>
            </select>
            
            <input type="submit" value="Apply Selection">
        </fieldset>
    </form>
    <br>

    <form action="manage.php" method="POST">
        <fieldset>
            <legend>Administrative Interventions</legend>
            <input type="hidden" name="action" value="delete">
            <label for="delete_job_reference">Purge all EOIs by Job Reference Number:</label>
            <input type="text" name="delete_job_reference" id="delete_job_reference" required>
            <input type="submit" value="Mass Delete" onclick="return confirm('Execute permanent removal? This cannot be reversed.');">
        </fieldset>
    </form>
    <br>

    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='5'>";
        echo "<tr>
                <th>EOI Number</th>
                <th>Job Reference</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Status</th>
                <th>Administrative Operational Status Shifts</th>
              </tr>";
              
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            // FIX: Updated all output cells to use your exact layout columns
            echo "<td>" . htmlspecialchars($row['eoinumber']) . "</td>";
            echo "<td>" . htmlspecialchars($row['job_ref_num']) . "</td>";
            echo "<td>" . htmlspecialchars($row['f_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['l_name']) . "</td>";
            echo "<td><strong>" . htmlspecialchars($row['status']) . "</strong></td>";
            echo "<td>
                    <form action='manage.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='action' value='update'>
                        <input type='hidden' name='update_id' value='" . $row['eoinumber'] . "'>
                        <select name='new_status'>
                            <option value='New' " . ($row['status'] == 'New' ? 'selected' : '') . ">New</option>
                            <option value='Current' " . ($row['status'] == 'Current' ? 'selected' : '') . ">Current</option>
                            <option value='Final' " . ($row['status'] == 'Final' ? 'selected' : '') . ">Final</option>
                        </select>
                        <input type='submit' value='Change'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No Expressions of Interest found matching your criteria.</p>";
    }
    mysqli_close($conn);
    ?>
</body>
</html>