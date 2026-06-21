<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Job application form page">
    <meta name="keywords" content="Job application, User information">
    <meta name="author" content="Joseph">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="styles/layout.css" rel="stylesheet">
    <title> Job application form </title>
</head>

<body>
    <?php include('inc_files/header.inc'); ?>

    <form method="post" action="process_eoi.php" id="forms" novalidate>
        <h1>Application form</h1>
        <label for="Job_ref_num">Job reference number</label>
        <select name="Job_ref_num" id="Job_ref_num" required>
            <option value="">Please Select</option>
            <option value="UI011"> UI011</option>
            <option value="JP020">JP020</option>
            <option value="DO130">DO130</option>
        </select>

        <div class="name-row">
            <div class="field">
                <label for="F_name">First name</label>
                <input type="text" name="F_name" id="F_name" required>
            </div>
            <div class="field">
                <label for="L_name">Last name</label>
                <input type="text" name="L_name" id="L_name" required>
            </div>
        </div>

        <label for="Date_birth">Date of birth</label>
        <input type="date" name="Date_birth" id="Date_birth" required><br>

        <fieldset>
            <legend><strong>Gender</strong></legend>
            <input type="radio" name="Gender" id="M" value="Male" required>
            <label for="M">Male</label>
            <input type="radio" name="Gender" id="F" value="Female">
            <label for="F">Female</label>
            <input type="radio" name="Gender" id="-" value="-">
            <label for="-">Prefer not to say</label>
        </fieldset>

        <label for="Street_add">Street address</label>
        <input type="text" name="Street_add" id="Street_add" required maxlength="40">
        <label for="Town">Suburb/Town</label>
        <input type="text" name="Suburb/town" id="Town" required maxlength="40">

        <label for="State">State</label>
        <select name="State" id="State" required>
            <option value="">Please Select</option>
            <option value="VIC">VIC</option>
            <option value="NSW">NSW</option>
            <option value="QLD">QLD</option>
            <option value="NT">NT</option>
            <option value="SA">SA</option>
            <option value="TAS">TAS</option>
            <option value="ACT">ACT</option>
        </select>

        <label for="Pcode">Postcode</label>
        <input type="text" name="Postcode" id="Pcode" required pattern="[0-9]{4}"><br>
        <label for="Email">Email</label>
        <input type="email" name="Email" id="Email" required>
        <label for="P_num">Phone number</label>
        <input type="text" name="P_num" id="P_num" required pattern="[0-9\-]{8,12}" placeholder="eg.012-3456789">
        <br>

        <fieldset class="Skill">
            <legend><strong>Skill</strong></legend>
            <input type="checkbox" name="Skill[]" id="Math_foun" value="Math foundation" checked>
            <label for="Math_foun">Mathematical foundations</label>
            <input type="checkbox" name="Skill[]" id="Game_engine" value="Game engine proficiency">
            <label for="Game_engine">Game engine proficiency</label><br>
            <input type="checkbox" name="Skill[]" id="S_thinking" value="Systemic Thinking">
            <label for="S_thinking">Systemic Thinking</label>
            <input type="checkbox" name="Skill[]" id="Rapid_proto" value="Rapid Prototyping">
            <label for="Rapid_proto">Rapid Prototyping</label>
            <input type="checkbox" name="Skill[]" id="Others" value=" and others...">
            <label for="Others">Other skills</label>
        </fieldset>
        <br>
        <label>Other skills:<br>
            <textarea name="Other skills" rows="6" cols="33" Placeholder="Write your other skills here..."></textarea>
        </label>


        <input type="submit" value="Submit form">
    </form>

    <?php include('inc_files/footer.inc'); ?>
</body>

</html>