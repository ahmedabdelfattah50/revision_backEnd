<?php
session_start();
    
    if(isset($_SESSION['username'])) {
        include "init.php";
        
        if(!isset($_GET['do'])) {
            $do = "Manage";
        } else {
            $do = $_GET['do'];
        }
        echo "<div class='container'>";

        if($do == "Manage") {
            
            $stmt = $con->prepare("SELECT * FROM hosters");
            $stmt->execute();
            $rows = $stmt->fetchAll();

            echo "<br><h2>Table of data</h2><br>";
            echo "<div class='total_table'>";
            echo "<table class='table table-striped table-dark'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th scope='col'>#</th>";
                        echo "<th scope='col'>Name</th>";
                        echo "<th scope='col'>username</th>";
                        echo "<th scope='col'>Email</th>";
                        echo "<th scope='col'>Register Date</th>";
                        echo "<th scope='col'>Status</th>";
                        echo "<th scope='col'>Options</th>";
                    echo "</tr>";
                echo "</thead>";
            foreach($rows as $row) { 
                echo "<tbody>";
                    if ($_SESSION['ID'] == $row['ID']) {
                        echo "<tr style='background:#303960;'>";
                    } else {
                        echo "<tr>";
                    }                   
                        echo "<th scope='row'>" . $row['ID'] . "</th>";
                        if ($_SESSION['ID'] == $row['ID']) {
                            echo "<td>" . $row['name'] . " <i class='fas fa-star'></i></td>";
                        } else {
                            echo "<td>" . $row['name'] . "</td>";
                        }
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>";
                            if($row['trust_status'] == 1) {
                                echo "<p class='status_para alert alert-primary'>Admin</p>";
                            } else {
                                echo "<p class='status_para alert alert-warning'>User</p>";
                            }
                        echo "</td>";

                        if(($_SESSION['username'] == $row['username']) || ($row['trust_status'] == 2)){
                            echo "<td>
                            <a href='?do=Edit&ID=" . $row['ID']  . "'> <button style='border:none; padding: 0 10px; font-size:18px;' class='btn btn-info'>Edit</button></a>
                            <a href='?do=Delete&ID=" . $row['ID']  . "'><button style='border:none; padding: 0 10px; font-size:18px;' class='btn btn-danger'>Delete</button></a>
                            </td>";
                        } else {
                            echo "<td>
                            <a href='?do=View&ID=" . $row['ID']  . "'> <button style='border:none; padding: 0 10px; font-size:18px;' class='btn btn-warning'>View Data</button></a>
                            </td>";
                        }
                            echo "</tr>";
                echo "</tbody>";
            }
            echo "</table>";
            echo "</div>";
            echo "<a href='?do=Add'><button style='border:none; padding: 5px 10px; font-size:18px; margin-bottom: 30px;' class='btn btn-success'>Add Member  <i class='fas fa-user-plus'></i></button></a>";

        } else if($do == "Add") { ?>
            <br><h2>Add Member</h2><br>        
            <form  method="POST" action="?do=Insert">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name_add" placeholder="Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password_add" placeholder="Password" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username_add" placeholder="Userame" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email_add" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="tel" class="form-control" name="phone_add" placeholder="Phone" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Trust Status</label>
                        <select name="status_add" class="form-control" id="">
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        <?php
        } else if($do == "Insert") {
            if( $_SERVER['REQUEST_METHOD'] == "POST") {
                $name_add       = $_POST['name_add'];
                $password_add   = $_POST['password_add'];
                $password_add_hased = password_hash($password_add, PASSWORD_DEFAULT);
                $username_add   = $_POST['username_add'];
                $email_add      = $_POST['email_add'];
                $phone_add      = $_POST['phone_add'];
                $status_add     = $_POST['status_add'];

                $stmt = $con->prepare("INSERT INTO hosters(name,username,password,email,phone,date,trust_status) VALUES(:nameInsert,:username,:passwordInsert,:emailInsert,:phoneInsert,now(),:trust_status)");
            
                $stmt->execute(array(
                    ":nameInsert"           => $name_add,                    
                    ":username"             => $username_add,
                    ":passwordInsert"       => $password_add_hased,
                    ":emailInsert"          => $email_add,
                    ":phoneInsert"          => $phone_add,
                    ":trust_status"         => $status_add
                ));

                // echo "<br><br><h2 class='alert alert-success'>Success One Member added<h2>";               
                // timer(3,"members.php");

                echo "<br><br><h2 class='alert alert-success'>Success One Member added<h2>";
                timer(3,"?members.php");
                
            } else {
                header("location:index.php");
                exit();
            }
        } else if($do == "Edit") {
            
            if ( isset($_GET['ID']) && is_numeric($_GET['ID'])) {

            $ID_Edit = $_GET['ID'];

            $stmt = $con->prepare("SELECT * FROM hosters WHERE ID = ?");
            $stmt->execute( array($ID_Edit) );
            $row_edt = $stmt->fetch();

        ?>
            <br><h2>Edit the data of Member</h2><br>        
            <form  method="POST" action="?do=Update">
                <div class="form-row">
                    <input type="text" value="<?php echo $row_edt['ID']?>" name="ID_edit" style="display:none;">
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name_edit" 
                        value="<?php echo $row_edt['name']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <?php
                            if($_SESSION['ID'] != $row_edt['ID']){
                                echo "<input type='password' name='password_edit' class='form-control' readonly>";
                            } else {
                                echo "<input type='password' class='form-control' name='password_edit'>";
                            }
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username_edit" 
                        value="<?php echo $row_edt['username']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email_edit" 
                        value="<?php echo $row_edt['email']?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="tel" class="form-control" name="phone_edit" 
                        value="<?php echo $row_edt['phone']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Trust Status</label>
                        <select name="status_edit" class="form-control" id="">
                            <?php 
                                if($row_edt['trust_status'] == 1) {
                                    echo "<option value='1' selected>Admin</option>";
                                    echo "<option value='2'>User</option>"; 
                                } else {
                                    echo "<option value='1'>Admin</option>";
                                    echo "<option value='2' selected>User</option>"; 
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        <?php
            } else {
                header("location:index.php");
            }
        } else if($do == "Update") {

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $ID_update              = $_POST['ID_edit'];
                $name_update            = $_POST['name_edit'];
                // the taken password from the update form
                $password_update        = $_POST['password_edit'];
                $password_update_hased  = password_hash($password_update,PASSWORD_DEFAULT);

                $username_update        = $_POST['username_edit'];
                $email_update           = $_POST['email_edit'];
                $phone_update           = $_POST['phone_edit'];
                $status_update          = $_POST['status_edit'];

                // this to bring the past password from the database
                $stmt_pass = $con->prepare("SELECT password FROM hosters WHERE ID=?");
                $stmt_pass->execute(array($ID_update));
                $run_past_pass = $stmt_pass->fetch();
                // the hased past password from the database 
                $past_pass = $run_past_pass['password'];

                $stmt = $con->prepare("UPDATE hosters SET name=?,username=?,password=?,email=?,phone=?,trust_status=? WHERE ID = ?");
               
                    /* if the input box of Edit password is empty<doesn't have any data> it will return the last password stored in the database */                    
                    if( empty($password_update) ) {              
                        $stmt->execute(array(
                            $name_update,
                            $username_update,
                            $past_pass,     
                            $email_update,
                            $phone_update,
                            $status_update,
                            $ID_update
                        )); 
                    /* if the input box of Edit password is not empty<have data> it will save the new password in the database */
                    } else {   
                        $stmt->execute(array(
                            $name_update,
                            $username_update,
                            $password_update_hased,
                            $email_update,
                            $phone_update,
                            $status_update,
                            $ID_update
                        ));
                    }

                echo "<br><br><h2 class='alert alert-success'>One Record Updated</h2>";
                timer(3,"?members.php");

            } else {
                header("location:index.php");
            }
            
        } else if($do == "View") {
            
            if ( isset($_GET['ID']) && is_numeric($_GET['ID'])) {

            $ID_View = $_GET['ID'];

            $stmt = $con->prepare("SELECT * FROM hosters WHERE ID = ?");
            $stmt->execute( array($ID_View) );
            $row_view = $stmt->fetch();

        ?>
            <br><h2>View the data</h2><br>        
            <form>
                <div class="form-row">
                    <input type="text" value="<?php echo $row_view['ID']?>" style="display:none;">
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" class="form-control"
                        value="<?php echo $row_view['name']?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <input type="password" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Username</label>
                        <input type="text" class="form-control"
                        value="<?php echo $row_view['username']?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control"
                        value="<?php echo $row_view['email']?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="tel" class="form-control" 
                        value="<?php echo $row_view['phone']?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Trust Status</label>
                            <?php 
                                if($row_view['trust_status'] == 1) {
                                    echo "<input type='text' class='form-control' 
                                        value='Admin' readonly>";
                                } else {
                                    echo "<input type='text' class='form-control' 
                                        value='User' readonly>";
                                }
                            ?>
                    </div>
                </div>
                <a href="?do=Manage"><button type="submit" class="btn btn-primary">Members Page</button></a>
            </form>
        <?php
            } else {
                header("location:index.php");
            }
        } else if($do == "Delete") {
            
            if(isset($_GET['ID']) && is_numeric($_GET['ID'])) {
                $del_member = $_GET['ID'];

                if( $_SESSION['ID'] == $del_member ) {
                    $stmt = $con->prepare("DELETE FROM hosters WHERE ID = :del_member");
                    $stmt->bindParam(":del_member" , $del_member);
                    $stmt->execute();

                    echo "<br><br><h2 class='alert alert-secondary'>One Record Deleted</h2>";
                    echo "<p class='alert alert-info'>Thank You For Your Time With US</p>";
                    timer(3,"logout.php");
                } else {
                    $stmt = $con->prepare("DELETE FROM hosters WHERE ID = :del_member");
                    $stmt->bindParam(":del_member" , $del_member);
                    $stmt->execute();
                    echo "<br><br><h2 class='alert alert-secondary'>One Record Deleted</h2>";
                    timer(3,"?members.php");
                }                                                             

            } else {
                header("location:index.php");
            }            
        }        
    ?>
        
<?php
    echo "</div>";
    } else {
        header("Location:index.php");
        exit();
    }