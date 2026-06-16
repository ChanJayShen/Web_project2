<?php
require_once "db_connect.php"; 

if ($conn) {
    $sql = "SELECT * FROM eoi WHERE 1=1"; 

    if (isset($_GET['job_reference']) && $_GET['job_reference'] != "") {
        $job_ref = mysqli_real_escape_string($conn, $_GET['job_reference']);
        $sql .= " AND job_reference = '$job_ref'";
    }

    if (isset($_GET['first_name']) && $_GET['first_name'] != "") {
        $fname = mysqli_real_escape_string($conn, $_GET['first_name']);
        $sql .= " AND first_name LIKE '%$fname%'";
    }

    if (isset($_GET['last_name']) && $_GET['last_name'] != "") {
        $lname = mysqli_real_escape_string($conn, $_GET['last_name']);
        $sql .= " AND last_name LIKE '%$lname%'";
    }

    if (isset($_GET['sort']) && $_GET['sort'] != "") {
        $sort = mysqli_real_escape_string($conn, $_GET['sort']);
        // Security check: only allow specific columns to be sorted to prevent SQL errors
        $allowed_sorts = array('id', 'job_reference', 'first_name', 'last_name', 'status');
        if (in_array($sort, $allowed_sorts)) {
            $sql .= " ORDER BY $sort";
        }
    }

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='5'>";
        echo "<tr>
                <th>ID</th>
                <th>Job Reference</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Status</th>
              </tr>";
              
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['job_reference'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No Expressions of Interest found matching your criteria.</p>";
    }
    
} else {
    echo "<p>Unable to connect to the db.</p>";
}

mysqli_close($conn);
?>