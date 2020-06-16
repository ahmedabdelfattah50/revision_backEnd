<?php

// this the timer to return to main page after do any action like (add - delete - update)
function timer($seconds,$page) {
    echo "<p class='alert alert-warning'>Your will leave this page after " . $seconds . "s</p>";
    header("Refresh:" . $seconds . ";url=" . $page);
}

// the counter to calculate the number of (Admins & Users in the database)
function counter($status){
    global $con;
    $stmt = $con->prepare("SELECT COUNT(*) FROM hosters WHERE trust_status = " . $status . "");
    $stmt->execute();
    return $stmt->fetchColumn();
}