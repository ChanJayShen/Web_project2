<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_POST["Job_ref_num"])) {
        $err_msg = "";
        $job_ref_num = isset($_POST["Job_ref_num"]) ? $_POST["Job_ref_num"] : "";
        $f_name = isset($_POST["F_name"]) ? $_POST["F_name"] : "";
        $l_name = isset($_POST["L_name"]) ? $_POST["L_name"] : "";
        $date_birth = isset($_POST["Date_birth"]) ? $_POST["Date_birth"] : "";
        $gender = isset($_POST["Gender"]) ? $_POST["Gender"] : "";
        $street_add = isset($_POST["Street_add"]) ? $_POST["Street_add"] : "";
        $suburb_town = isset($_POST["Suburb/town"]) ? $_POST["Suburb/town"] : "";
        $state = isset($_POST["State"]) ? $_POST["State"] : "";
        $postcode = isset($_POST["Postcode"]) ? $_POST["Postcode"] : "";
        $email = isset($_POST["Email"]) ? $_POST["Email"] : "";
        $p_num = isset($_POST["P_num"]) ? $_POST["P_num"] : "";
        $skill = isset($_POST["Skill"]) ? $_POST["Skill"] : [];
        $other_skills = isset($_POST["Other skills"]) ? $_POST["Other skills"] : "";


        // job reference number (dropdown)
        if (trim($job_ref_num) == "") {
            $err_msg .= "<p>Please enter the job reference number. </p>";
        } else {
            $sanitised_job_ref_num = sanitise_input($job_ref_num);
            if (!preg_match("/^[a-zA-Z0-9]{5}$/", $sanitised_job_ref_num)) {
                $err_msg .= "<p>Job reference number must be exactly 5 alphanumeric characters.</p>";
            }
        }

        // first name
        if (trim($f_name) == "")
            $err_msg .= "<p>Please enter first name. </p>";
        else {
            $sanitised_f_name = sanitise_input($f_name);
            if (!preg_match("/^[a-zA-Z]{1,20}$/", $sanitised_f_name)) {
                $err_msg .= "<p>Only letters are allowed in the first name. </p>";
            }
        }

        // last name
        if (trim($l_name) == "")
            $err_msg .= "<p>Please enter last name. </p>";
        else {
            $sanitised_l_name = sanitise_input($l_name);
            if (!preg_match("/^[a-zA-Z]{1,20}$/", $sanitised_l_name)) {
                $err_msg .= "<p>Only leters are allowed in the last name. </p>";
            }
        }

        // date of birth
        if (trim($date_birth) == "") {
            $err_msg .= "<p>Please enter your date of birth.</p>";
        } else {
            $sanitised_date_birth = sanitise_input($date_birth);
            if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $sanitised_date_birth)) {
                $err_msg .= "<p>Please enter a valid date format (DD/MM/YYYY).</p>";
            }
        }

        // gender
        if (trim($gender) == "") {
            $err_msg .= "<p>Please select your gender.</p>";
        } else {
            $sanitised_gender = sanitise_input($gender);
            // Checks if the value matches your radio options
            if ($sanitised_gender != "Male" && $sanitised_gender != "Female" && $sanitised_gender != "-") {
                $err_msg .= "<p>Invalid gender selection.</p>";
            }
        }

        # street address
        if (trim($street_add) == "") {
            $err_msg .= "<p>Please enter your street address.</p>";
        } else {
            $sanitised_street_add = sanitise_input($street_add);
            if (strlen($sanitised_street_add) > 40) {
                $err_msg .= "<p>Street address cannot exceed 40 characters.</p>";
            }
        }

        # suburb/town
        if (trim($suburb_town) == "") {
            $err_msg .= "<p>Please enter your suburb or town.</p>";
        } else {
            $sanitised_suburb_town = sanitise_input($suburb_town);
            if (strlen($sanitised_suburb_town) > 40) {
                $err_msg .= "<p>Suburb or town cannot exceed 40 characters.</p>";
            }
        }

        // state (dropdown)
        if (trim($state) == "") {
            $err_msg .= "<p>Please select your state.</p>";
        } else {
            $sanitised_state = sanitise_input($state);
            $valid_states = ["VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"];
            if (!in_array($sanitised_state, $valid_states)) {
                $err_msg .= "<p>Please select a valid Australian state.</p>";
            }
        }

        // postcode
        if (trim($postcode) == "") {
            $err_msg .= "<p>Please enter your postcode.</p>";
        } else {
            $sanitised_postcode = sanitise_input($postcode);
            if (!preg_match("/^[0-9]{4}$/", $sanitised_postcode)) {
                $err_msg .= "<p>Postcode must be exactly 4 digits.</p>";
            }
        }

        // email
        if (trim($email) == "")
            $err_msg .= "<p>Please enter email. </p>";
        else {
            $sanitised_email = sanitise_input($email);
            if (!filter_var($sanitised_email, FILTER_VALIDATE_EMAIL))
                $err_msg .= "<p>Email is not valid. Please enter valid format (eg. joseph@gmail.com)</p>";
        }

        // phone number
        if (trim($p_num) == "") {
            $err_msg .= "<p>Please enter your phone number.</p>";
        } else {
            $sanitised_p_num = sanitise_input($p_num);
            if (!preg_match("/^[0-9\-]{8,12}$/", $sanitised_p_num)) {
                $err_msg .= "<p>Phone number must be between 8 and 12 digits.</p>";
            }
        }

        // skill (multiple choices)
        if (empty($skill)) {
            $err_msg .= "<p>Please select at least one skill.</p>";
        } else {
            // If it's not empty, sanitize each skill inside the array
            // and turn them into a single string separated by commas
            $sanitized_skills = array_map('sanitise_input', $skill);
            $skills_string = implode(", ", $sanitized_skills);
        }

        // other skills
        $sanitised_other_skills = "";
        if (trim($other_skills) != "") {
            $sanitised_other_skills = sanitise_input($other_skills);
        }


        // display error msg or welcome info
        if ($err_msg != "")
            echo $err_msg;
        else
            require_once "settings.php";
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        // 1. Check if the connection to your XAMPP MySQL database works
        if ($conn) {

            // 2. Instead of 'cars', use your EOI table name
            // (Assuming you want to display submissions or check values)
            $sql = "SELECT * FROM eoi";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // 3. Update the table headers to match your application form fields
                echo "<table border='1' cellpadding='5'>";
                echo "<tr>
                <th>EOI Number</th>
                <th>Job Ref</th>
                <th>First Name</th>
                <th>Gender</th>
                <th>Skills</th>
              </tr>";

                // 4. Update the array keys to match your database column names exactly
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['eoi_number'] . "</td>"; // Your primary key
                    echo "<td>" . $row['job_ref_num'] . "</td>";
                    echo "<td>" . $row['f_name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['skills'] . "</td>"; // Where your imploded string lives!
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No job applications found in the database.</p>";
            }

            // Always close the connection at the very end
            mysqli_close($conn);

        }
    } else {
        header("location:apply.php"); //Redirect to the form
    }

    ?>
</body>

</html>