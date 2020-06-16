<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container"> 
        <a class="navbar-brand" href="dashboard.php" style="color: #fff;">Main dashboard</a>
        <!-- <a href="#" style="color:$fff !important; text-decoration:none;"></a> -->
        <button class="navbar-toggler" style="border:1px solid #fff; outline:none;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-ellipsis-v" style="color:#fff"></i>
        </button>
 
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">         
                <li class="nav-item" >
                    <a class="nav-link spec_link" href="members.php">Members Page</a>
                </li>     
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: #fff;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['username']?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                        <?php
                            $stmt = $con->prepare("SELECT ID FROM hosters WHERE username = ?");
                            $stmt->execute(array($_SESSION['username']));
                            $row = $stmt->fetch();
                        ?>

                        <a class="dropdown-item" href="members.php?do=Edit&ID= <?php echo $row['ID']?> ">Edit</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>  
</nav>