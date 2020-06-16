<?php    
    session_start();
    
    if(isset($_SESSION['username'])) {
        include "init.php";
    ?>

    <div class='container'>        
        <div style="border:none; text-align: center; box-shadow: 0 0 40px #ddC; border-radius: 10px; padding: 50px 0; margin-top: 100px">
            <div style="margin:20px 0;">
                <h2>Total Admins</h2>
                <span style="color:#f30; font-weight:700; font-size: 50px">
                <?php echo counter(1); ?>
                </span>
            </div>
            <div style="margin:20px 0;">                
                <h2>Total Users</h2>
                <span style="color:#f30; font-weight:700; font-size: 50px">
                <?php echo counter(2); ?>
                </span>
            </div>
            <a href="members.php?do=Manage">
                <button style="border:none; font-weight:700; padding:10px 40px; font-size: 20px; box-shadow: 0 0 20px #393e46; border-radius: 10px">View members data</button>
            </a>
        </div>
    </div>

<?php
    } else {
        header("Location:index.php");
        exit();
    }