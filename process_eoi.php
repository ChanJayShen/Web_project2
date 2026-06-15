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
        $p_num = isset($_POST["P_num"]) ? $_POST["P_num"] : "";
        $skill = isset($_POST["Skill"]) ? $_POST["Skill"] : [];
        $other_skills = isset($_POST["Other skills"]) ? $_POST["Other skills"] : "";

        // skill (multiple choices)
        if (empty($skill)) {
            $err_msg .= "<p>Please select at least one skill.</p>";
        } else {
            // If it's not empty, sanitize each skill inside the array
            // and turn them into a single string separated by commas
            $sanitized_skills = array_map('sanitise_input', $skill);
            $skills_string = implode(", ", $sanitized_skills);
        }

        // job reference number
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
            if (!preg_match("/^[0-9]{2}/[0-9]{2}/[0-9]{4}$/", $sanitised_date_birth)) {
                $err_msg .= "<p>Please enter a valid date format (DD/MM/YYYY).</p>";
            }
        }

        //email
        if (trim($email) == "")
            $err_msg .= "<p>Please enter email. </p>";
        else {
            $email = sanitise_input($email);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                $err_msg .= "<p>Email is not valid. </p>";
        }

        // gender
        if (!isset($_POST["gender"]))
            $err_msg .= "<p>Please select your gender. </p>";
        else
            $gender = sanitise_input($_POST["gender"]);

        // display error msg or welcome info
        if ($err_msg != "")
            echo $err_msg;
        else
            echo "Welcome $first_name $last_name! Your email is $email. Your gender is $gender.";
    } else {
        header("location:apply.php"); //Redirect to the form
    }

    ?>
</body>

</html>