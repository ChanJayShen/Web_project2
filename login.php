<?php
session_start();

require_once "settings.php";
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("❌ Connection failed: " . mysqli_connect_error()); //shows error message
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //Put ? instead of '$username' at the end of the query, to prevent hacker from typing ' OR '1'='1
    $query = "SELECT id, username, password FROM users WHERE username = ?";
    //primary defense against SQL Injection Attacks
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username); // Links actual username to the ? placeholder ("s" means treat username as literal string)
        mysqli_stmt_execute($stmt); // Execute the finalized and safe search statement inside database tables
        $result = mysqli_stmt_get_result($stmt); // Read result

        // Check if username exist in row
        if ($row = mysqli_fetch_assoc($result)) {
            // Check the submitted password against the hash saved in the database
            if (password_verify($password, $row['password'])) {
                session_regenerate_id(true); // Issues a new session tracking ID, to prevent bad actors from mimicking an active user
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['username'];
                header("Location: manage.php");
                exit();
            } else {
                // If password_verify failed, check if it's the student fallback to auto-fix it
                if ($username === "student" && $password === "INTI") {
                    $fresh_hash = password_hash("INTI", PASSWORD_DEFAULT);
                    $repair = "UPDATE users SET password = ? WHERE username = 'student'";
                    $r_stmt = mysqli_prepare($conn, $repair);
                    mysqli_stmt_bind_param($r_stmt, "s", $fresh_hash);
                    mysqli_stmt_execute($r_stmt);
                    mysqli_stmt_close($r_stmt);

                    // Log them in directly
                    session_regenerate_id(true);
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = "student";
                    header("Location: manage.php");
                    exit();
                }
                $error = "Invalid username or password.";
            }
        } else {
            // Fallback: If the 'student' account was deleted from the database, recreate it 
            if ($username === "student" && $password === "INTI") {
                $fresh_hash = password_hash("INTI", PASSWORD_DEFAULT);
                $insert = "INSERT INTO users (username, password) VALUES ('student', ?)";
                $i_stmt = mysqli_prepare($conn, $insert);
                mysqli_stmt_bind_param($i_stmt, "s", $fresh_hash);
                mysqli_stmt_execute($i_stmt);
                mysqli_stmt_close($i_stmt);

                session_regenerate_id(true);
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = "student";
                header("Location: manage.php");
                exit();
            }
            $error = "Invalid username or password.";
        }
        mysqli_stmt_close($stmt);
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HR Manager Login</title>
    <style>
        .back-home {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #555;
            font-size: 0.9em;
        }

        .back-home:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h2>HR Manager Login</h2>

    <?php if (!empty($error))
        echo "<p style='color:red;'>" . htmlspecialchars($error) . "</p>"; ?>

    <form action="login.php" method="POST">
        <p>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </p>
        <p>
            <input type="submit" value="Login">
        </p>
    </form>

    <a href="index.php" class="back-home">← Return to Public Website</a>
</body>

</html>