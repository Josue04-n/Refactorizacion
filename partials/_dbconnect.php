<?php
$con = mysqli_connect("localhost", "root", "", "refactoricacion");
if (!$con) {
    die("not connected" . mysqli_connect_error($con));
}
?>