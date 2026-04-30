<?php

$name = $age = $email = $password = $confirm_password = $phone = $username = $gender = $course = "";
$nameErr = $ageErr = $emailErr = $passwordErr = $confirmErr = $phoneErr = $usernameErr = $genderErr = $courseErr = $termsErr = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and spaces allowed";
        }
    }

    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
        if (strlen($username) < 5) {
            $usernameErr = "Username must be at least 5 characters";
        }
    }

    if (empty($_POST["age"])) {
        $ageErr = "Age is required";
    } else {
        $age = test_input($_POST["age"]);
        if (!is_numeric($age) || $age < 18) {
            $ageErr = "Age must be 18 or above";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
        if (strlen($password) < 6) {
            $passwordErr = "Password must be at least 6 characters";
        }
    }

    if (empty($_POST["confirm_password"])) {
        $confirmErr = "Confirm your password";
    } else {
        $confirm_password = $_POST["confirm_password"];
        if ($password != $confirm_password) {
            $confirmErr = "Passwords do not match";
        }
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]{11}$/", $phone)) {
            $phoneErr = "Must be 11 digits";
        }
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Select gender";
    } else {
        $gender = $_POST["gender"];
    }

    if (empty($_POST["course"])) {
        $courseErr = "Select a course";
    } else {
        $course = $_POST["course"];
    }

    if (empty($_POST["terms"])) {
        $termsErr = "You must accept terms";
    }

    if (empty($nameErr) && empty($ageErr) && empty($emailErr) && empty($passwordErr) &&
        empty($confirmErr) && empty($phoneErr) && empty($usernameErr) &&
        empty($genderErr) && empty($courseErr) && empty($termsErr)) {

        $success = "Registration Successful!";
    }
}

function test_input($data) {
    return trim($data);
}
?>

<form method="post">

Name: <input type="text" name="name" value="<?php echo $name; ?>">
<span><?php echo $nameErr; ?></span><br><br>

Username: <input type="text" name="username" value="<?php echo $username; ?>">
<span><?php echo $usernameErr; ?></span><br><br>

Age: <input type="number" name="age" value="<?php echo $age; ?>">
<span><?php echo $ageErr; ?></span><br><br>

Email: <input type="email" name="email" value="<?php echo $email; ?>">
<span><?php echo $emailErr; ?></span><br><br>

Password: <input type="password" name="password">
<span><?php echo $passwordErr; ?></span><br><br>

Confirm Password: <input type="password" name="confirm_password">
<span><?php echo $confirmErr; ?></span><br><br>

Phone: <input type="text" name="phone" value="<?php echo $phone; ?>">
<span><?php echo $phoneErr; ?></span><br><br>

Gender:
<input type="radio" name="gender" value="Male"> Male
<input type="radio" name="gender" value="Female"> Female
<span><?php echo $genderErr; ?></span><br><br>

Course:
<select name="course">
    <option value="">Select</option>
    <option value="CSE">CSE</option>
    <option value="EEE">EEE</option>
    <option value="BBA">BBA</option>
</select>
<span><?php echo $courseErr; ?></span><br><br>

<input type="checkbox" name="terms"> Accept Terms
<span><?php echo $termsErr; ?></span><br><br>

<input type="submit" value="Register">

</form>

<?php
if ($success) {
    echo "<h3>$success</h3>";
    echo "Name: $name <br>";
    echo "Email: $email <br>";
    echo "Username: $username <br>";
    echo "Age: $age <br>";
    echo "Gender: $gender <br>";
    echo "Course: $course <br>";
}
?>