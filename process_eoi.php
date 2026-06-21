<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    function sanitise_input($conn, $data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }

    if (isset($_POST["Job_ref_num"])) {
        $err_msg = "";
        require_once "settings.php";
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        if (!$conn) {
            die("<p>Database connection failed. Processing stopped.</p>");
        }

        $job_ref_num = $_POST["Job_ref_num"] ?? ""; //If there is value, assign the user input value to variable. If no value, then assign an empty string.
        $f_name = $_POST["F_name"] ?? "";
        $l_name = $_POST["L_name"] ?? "";
        $date_birth = $_POST["Date_birth"] ?? "";
        $gender = $_POST["Gender"] ?? "";
        $street_add = $_POST["Street_add"] ?? "";
        $suburb_town = $_POST["Suburb/town"] ?? "";
        $state = $_POST["State"] ?? "";
        $postcode = $_POST["Postcode"] ?? "";
        $email = $_POST["Email"] ?? "";
        $p_num = $_POST["P_num"] ?? "";
        $skill = $_POST["Skill"] ?? [];
        $other_skills = $_POST["Other skills"] ?? "";

        // job reference number (dropdown)
        if (trim($job_ref_num) == "") {
            $err_msg .= "<p>Please enter the job reference number. </p>";
        } else {
            $sanitised_job_ref_num = sanitise_input($conn, $job_ref_num);
            if (!preg_match("/^[a-zA-Z0-9]{5}$/", $sanitised_job_ref_num)) {
                $err_msg .= "<p>Job reference number must be exactly 5 alphanumeric characters.</p>";
            }
        }

        // first name
        if (trim($f_name) == "")
            $err_msg .= "<p>Please enter first name. </p>";
        else {
            $sanitised_f_name = sanitise_input($conn, $f_name);
            if (!preg_match("/^[a-zA-Z]{1,20}$/", $sanitised_f_name)) {
                $err_msg .= "<p>Only letters are allowed in the first name. </p>";
            }
        }

        // last name
        if (trim($l_name) == "")
            $err_msg .= "<p>Please enter last name. </p>";
        else {
            $sanitised_l_name = sanitise_input($conn, $l_name);
            if (!preg_match("/^[a-zA-Z]{1,20}$/", $sanitised_l_name)) {
                $err_msg .= "<p>Only leters are allowed in the last name. </p>";
            }
        }

        // date of birth
        if (trim($date_birth) == "") {
            $err_msg .= "<p>Please enter your date of birth.</p>";
        } else {
            $sanitised_date_birth = sanitise_input($conn, $date_birth);
            if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $sanitised_date_birth)) {
                $err_msg .= "<p>Please enter a valid date format (DD/MM/YYYY).</p>";
            }
        }

        // gender
        if (trim($gender) == "") {
            $err_msg .= "<p>Please select your gender.</p>";
        } else {
            $sanitised_gender = sanitise_input($conn, $gender);
            // Checks if the value matches your radio options
            if ($sanitised_gender != "Male" && $sanitised_gender != "Female" && $sanitised_gender != "-") {
                $err_msg .= "<p>Invalid gender selection.</p>";
            }
        }

        # street address
        if (trim($street_add) == "") {
            $err_msg .= "<p>Please enter your street address.</p>";
        } else {
            $sanitised_street_add = sanitise_input($conn, $street_add);
            if (strlen($sanitised_street_add) > 40) {
                $err_msg .= "<p>Street address cannot exceed 40 characters.</p>";
            }
        }

        # suburb/town
        if (trim($suburb_town) == "") {
            $err_msg .= "<p>Please enter your suburb or town.</p>";
        } else {
            $sanitised_suburb_town = sanitise_input($conn, $suburb_town);
            if (strlen($sanitised_suburb_town) > 40) {
                $err_msg .= "<p>Suburb or town cannot exceed 40 characters.</p>";
            }
        }

        // state (dropdown)
        if (trim($state) == "") {
            $err_msg .= "<p>Please select your state.</p>";
        } else {
            $sanitised_state = sanitise_input($conn, $state);
            $valid_states = ["VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"];
            if (!in_array($sanitised_state, $valid_states)) {
                $err_msg .= "<p>Please select a valid state.</p>";
            }
        }

        // postcode
        if (trim($postcode) == "") {
            $err_msg .= "<p>Please enter your postcode.</p>";
        } else {
            $sanitised_postcode = sanitise_input($conn, $postcode);
            if (!preg_match("/^[0-9]{4}$/", $sanitised_postcode)) {
                $err_msg .= "<p>Postcode must be exactly 4 digits.</p>";
            }
        }

        // email
        if (trim($email) == "")
            $err_msg .= "<p>Please enter email. </p>";
        else {
            $sanitised_email = sanitise_input($conn, $email);
            if (!filter_var($sanitised_email, FILTER_VALIDATE_EMAIL))
                $err_msg .= "<p>Email is not valid. Please enter valid format (eg. joseph@gmail.com)</p>";
        }

        // phone number
        if (trim($p_num) == "") {
            $err_msg .= "<p>Please enter your phone number.</p>";
        } else {
            $sanitised_p_num = sanitise_input($conn, $p_num);
            if (!preg_match("/^[0-9\-]{8,12}$/", $sanitised_p_num)) {
                $err_msg .= "<p>Phone number must be between 8 and 12 digits.</p>";
            }
        }

        // skill (multiple choices)
        $skills_string = "";
        if (empty($skill)) {
            $err_msg .= "<p>Please select at least one skill.</p>";
        } else {
            // Securely mapping the array fields using an anonymous connection hook
            $sanitized_skills = array_map(function ($item) use ($conn) {
                return sanitise_input($conn, $item);
            }, $skill);
            $skills_string = implode(", ", $sanitized_skills);
        }

        // other skills
        $sanitised_other_skills = "";
        if (trim($other_skills) != "") {
            $sanitised_other_skills = sanitise_input($other_skills);
        }


        // display error msg or welcome info
        if ($err_msg != "") {
            echo "<h2>Validation Errors Found</h2>";
            echo $err_msg;
            echo "<p><a href='apply.php'>Go Back to Form</a></p>";
            mysqli_close($conn); // Close connection early if we failed validation
        } else {

            $create_table_sql = "CREATE TABLE IF NOT EXISTS eoi (
                eoinumber INT AUTO_INCREMENT PRIMARY KEY,
                job_ref_num CHAR(5) NOT NULL,
                f_name VARCHAR(20) NOT NULL,
                l_name VARCHAR(20) NOT NULL,
                date_birth DATE NOT NULL,
                gender VARCHAR(10) NOT NULL,
                street_add VARCHAR(40) NOT NULL,
                suburb_town VARCHAR(40) NOT NULL,
                state CHAR(3) NOT NULL,
                postcode CHAR(4) NOT NULL,
                email VARCHAR(50) NOT NULL,
                p_num VARCHAR(12) NOT NULL,
                skills VARCHAR(200),
                other_skills TEXT,
                status ENUM('New', 'Current', 'Final') DEFAULT 'New' NOT NULL
            );";

            mysqli_query($conn, $create_table_sql);

            $insert_sql = "INSERT INTO eoi (
                job_ref_num, f_name, l_name, date_birth, gender, 
                street_add, suburb_town, state, postcode, email, p_num, skills, other_skills
            ) VALUES (
                '$sanitised_job_ref_num', '$sanitised_f_name', '$sanitised_l_name', 
                '$sanitised_date_birth', '$sanitised_gender', '$sanitised_street_add', 
                '$sanitised_suburb_town', '$sanitised_state', '$sanitised_postcode', 
                '$sanitised_email', '$sanitised_p_num', '$skills_string', '$sanitised_other_skills'
            );";

            $result = mysqli_query($conn, $insert_sql);

            if ($result) {
                $last_id = mysqli_insert_id($conn);

                echo "<h2>Application Submitted Successfully!</h2>";
                echo "<p>Your Expression of Interest number is: <strong>$last_id</strong>.</p>";

                // Side-by-side Attribute Layout Receipt Table display
                echo "<h3>Submitted Profile Details</h3>";
                echo "<table border='1' cellpadding='8' style='border-collapse: collapse; width: 100%; max-width: 600px;'>";
                echo "<tr style='background-color: #f2f2f2;'><th align='left'>Attribute Name</th><th align='left'>User Input Data</th></tr>";

                echo "<tr><td><strong>EOI Number</strong></td><td>" . $last_id . "</td></tr>";
                echo "<tr><td><strong>Job Reference</strong></td><td>" . $sanitised_job_ref_num . "</td></tr>";
                echo "<tr><td><strong>First Name</strong></td><td>" . $sanitised_f_name . "</td></tr>";
                echo "<tr><td><strong>Last Name</strong></td><td>" . $sanitised_l_name . "</td></tr>";
                echo "<tr><td><strong>Date of Birth</strong></td><td>" . $sanitised_date_birth . "</td></tr>";
                echo "<tr><td><strong>Gender</strong></td><td>" . $sanitised_gender . "</td></tr>";
                echo "<tr><td><strong>Street Address</strong></td><td>" . $sanitised_street_add . "</td></tr>";
                echo "<tr><td><strong>Suburb / Town</strong></td><td>" . $sanitised_suburb_town . "</td></tr>";
                echo "<tr><td><strong>State</strong></td><td>" . $sanitised_state . "</td></tr>";
                echo "<tr><td><strong>Postcode</strong></td><td>" . $sanitised_postcode . "</td></tr>";
                echo "<tr><td><strong>Email Address</strong></td><td>" . $sanitised_email . "</td></tr>";
                echo "<tr><td><strong>Phone Number</strong></td><td>" . $sanitised_p_num . "</td></tr>";
                echo "<tr><td><strong>Selected Skills</strong></td><td>" . $skills_string . "</td></tr>";
                echo "<tr><td><strong>Other Skills</strong></td><td>" . (!empty($sanitised_other_skills) ? nl2br($sanitised_other_skills) : "None provided") . "</td></tr>";
                echo "<tr><td><strong>Application Status</strong></td><td><span style='color: blue; font-weight: bold;'>New</span></td></tr>";
                echo "</table>";

                echo "<p><a href='apply.php'>Return to Application Form</a></p>";
            }
        }
    } else {
        header("location:apply.php"); //Redirect to the form
    }

    ?>
</body>

</html>