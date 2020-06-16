<?php
    $noNavbar = "";
            
        session_start();        
        include "init.php";
        
        if(isset($_SESSION['username'])) {
            header("Location:dashboard.php");
            exit();
        }
        
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $username = $_POST['form_username'];
            $password = $_POST['form_password'];

            $hasedPass = password_hash($password,PASSWORD_DEFAULT);
            
            $stmt = $con->prepare("SELECT * FROM hosters WHERE (trust_status = 1 && username = ?)");
            $stmt->execute(array($username));
            $member = $stmt->fetch();
                        
            if ( ($member['username'] == $username) && (password_verify($password,$member['password'])) ) {
                $_SESSION['username'] = $member['username'];
                $_SESSION['ID'] = $member['ID'];
                header("Location:dashboard.php");
                echo $_SESSION['username'];
                exit();
            } else {
                header("Location:index.php");
            }           

        }               
?>

<div class="container">
    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <br><br><h2>Admin login form</h2><br>
        <div class="form-group">
            <label>username</label>
            <input name="form_username" type="text" class="form-control" required>            
        </div>
        <div class="form-group">
            <label>Password</label>
            <input name= "form_password" type="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>