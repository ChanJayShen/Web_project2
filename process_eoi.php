<!DOCTYPE html>
<html lang="en">
<body>
    <?php
        function sanitise_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if (isset($_POST["Job_ref_num"])) {
            $err_msg="";
            $job_ref_num = $_POST["Job_ref_num"];
            $f_name = $_POST["F_name"];
            $l_name = $_POST["L_name"];
            $date_birth = $_POST["Date_birth"];
            $gender = $_POST["Gender"];
            $street_add = $_POST["Street_add"];
            $suburb_town = $_POST["Suburb/town"];
            $state = $_POST["State"];
            $postcode = $_POST["Postcode"];
            $email = $_POST["Email"];
            $p_num = $_POST["P_num"];
            $skill = isset($_POST["Skill"]) ? $_POST["Skill"] : [];
            $other_skills = $_POST["Other skills"];

            

            // first name
            if (trim($first_name)=="")
                $err_msg .= "<p>Please enter first name. </p>";
            else {
                $first_name=sanitise_input($first_name);
                if (!preg_match("/^[a-zA-Z]{2,40}$/",$first_name)) {
                    $err_msg .= "<p>Only letters are allowed in the first name. </p>";
                }
            }

            // last name
            if (trim($last_name)=="")
                $err_msg .= "<p>Please enter last name. </p>";
            else {
                $last_name=sanitise_input($last_name);
                if (!preg_match("/^[a-zA-Z]{2,40}$/",$last_name)) {
                    $err_msg .= "<p>Only leters are allowed in the last name. </p>";
                }
            }

            //email
            if (trim($email)=="")
                $err_msg .= "<p>Please enter email. </p>";
            else {
                $email=sanitise_input($email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                    $err_msg .= "<p>Email is not valid. </p>";
            }

            // gender
            if (!isset($_POST["gender"]))
                $err_msg .= "<p>Please select your gender. </p>";
            else 
                $gender=sanitise_input($_POST["gender"]);

            // display error msg or welcome info
            if ($err_msg != "")
                echo $err_msg;
            else 
                echo "Welcome $first_name $last_name! Your email is $email. Your gender is $gender.";
        }
        else {
            header ("location:apply.php"); //Redirect to the form
        }
            
    ?>
</body>
</html>