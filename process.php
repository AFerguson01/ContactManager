<?php

session_start();

$mysqli = new mysqli("localhost", "root", "15uBgvhgCXy5e2f2", "ContactManager") or die(mysqli_error($mysqli));

$update = false;
$id="0";
$first = "";
$last = "";
$email = "";

if (isset($_POST["save"])){
    $validationsuccess = true;

    preg_match("/^([a-zA-Z' ]+)$/", $_POST['firstname']) ? $first = $_POST['firstname'] : $validationsuccess = false;
    preg_match("/^([a-zA-Z' ]+)$/", $_POST['lastname']) ? $last = $_POST['lastname'] : $validationsuccess = false;
    preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['email']) ? $email = $_POST['email'] : $validationsuccess = false;
    
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $dob = $year."-".$month."-".$day; 

    if ($validationsuccess == true){
        $mysqli->query("INSERT INTO contacts (First, Last, Email, `DOB`, ID) VALUES('$first', '$last', '$email', '$dob', 'NULL')") or die($mysqli->error());

        $_SESSION['message'] = "Record Saved!";
        $_SESSION['msg_type'] = "success";
    } else{
        $_SESSION['message'] = "Invalid Entry!";
        $_SESSION['msg_type'] = "danger";
    }

    header("location: index.php");
}

if (isset($_GET["delete"])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM contacts WHERE ID=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record Deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM Contacts WHERE id=$id") or die($mysqli->error());
    if(mysqli_num_rows($result) > 0){
        $row = $result->fetch_array();
        $first = $row['First'];
        $last = $row['Last'];
        $email = $row['Email'];
        $dob = explode("-", $row['DOB']);
        $day = $dob[2];
        $month = $dob[1];
        $year = $dob[0];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['update'];
    
    $validationsuccess = true;

    preg_match("/^([a-zA-Z' ]+)$/", $_POST['firstname']) ? $first = $_POST['firstname'] : $validationsuccess = false;
    preg_match("/^([a-zA-Z' ]+)$/", $_POST['lastname']) ? $last = $_POST['lastname'] : $validationsuccess = false;
    preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['email']) ? $email = $_POST['email'] : $validationsuccess = false;
    
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $dob = $year."-".$month."-".$day; 

    if ($validationsuccess == true){
        // $mysqli->query("UPDATE contacts SET First='$first', Last='$last', Email= '$email', D.O.B = '$dob' WHERE contacts.ID = $id;") or die($mysqli->error());
        $mysqli->query("UPDATE contacts SET First='$first', Last='$last', Email= '$email', DOB='$dob' WHERE ID=42") or die($mysqli->error());

        $_SESSION['message'] = "Record Saved!";
        $_SESSION['msg_type'] = "success";
    } else{
        $_SESSION['message'] = "Invalid Entry!";
        $_SESSION['msg_type'] = "danger";
    }

    header("location: index.php");
}



?>