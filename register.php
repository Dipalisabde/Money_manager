<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit'])) {
    $fname = $_POST['name'];
    $mobno = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatpassword'];

    // Perform basic validation
    if (empty($fname) || empty($mobno) || empty($email) || empty($password) || empty($repeatPassword)) {
        $msg = "All fields are required.";
    } elseif ($password != $repeatPassword) {
        $msg = "Password and Repeat Password do not match.";
    } else {
        // Check if email already exists
        $query = "SELECT Email FROM tbluser WHERE Email = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $msg = "This email is associated with another account.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into database
            $query = "INSERT INTO tbluser (FullName, MobileNumber, Email, Password) VALUES (?, ?, ?, ?)";
            $stmt = $con->prepare($query);
            $stmt->bind_param("ssss", $fname, $mobno, $email, $hashedPassword);
            
            if ($stmt->execute()) {
                $msg = "You have successfully registered.";
            } else {
                $msg = "Something went wrong. Please try again.";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script type="text/javascript">
    function checkpass() {
        if (document.signup.password.value != document.signup.repeatpassword.value) {
            alert('Password and Repeat Password field does not match');
            document.signup.repeatpassword.focus();
            return false;
        }
        return true;
    } 
    </script>
</head>
<body>
    <div class="row">
        <h2 align="center">Money Manager</h2>
        <hr />
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Sign Up</div>
                <div class="panel-body">
                    <form role="form" action="register.php" method="post" id="signup" name="signup" onsubmit="return checkpass();">
                        <p style="font-size:16px; color:red" align="center"><?php echo isset($msg) ? $msg : ''; ?></p>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Full Name" name="name" type="text" required="true" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" required="true" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number" maxlength="10" pattern="[0-9]{10}" required="true" value="<?php echo isset($_POST['mobilenumber']) ? $_POST['mobilenumber'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" required="true">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="Repeat Password" required="true">
                            </div>
                            <div class="checkbox">
                                <button type="submit" value="submit" name="submit" class="btn btn-primary">Register</button>
                                <span style="padding-left:250px"><br><br>
                                <a href="index.php" class="btn btn-primary">Login</a></span>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->    

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
