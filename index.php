<?php
include 'db.php';

if (isset($_POST['insert'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $roll = $_POST['roll'];
    $pass = $_POST['pass'];
    $contact = $_POST['contact'];

    if (!preg_match("/^[0-9]{10}$/", $contact)) {
        echo "Invalid contact number!";
    } else {
        mysqli_query($conn, "INSERT INTO students(firstname, lastname, rollno, password, contact)
        VALUES('$fname','$lname','$roll','$pass','$contact')");
        echo "Inserted Successfully!";
    }
}

if (isset($_POST['update'])) {
    $roll = $_POST['roll'];
    $contact = $_POST['contact'];

    mysqli_query($conn, "UPDATE students SET contact='$contact' WHERE rollno='$roll'");
    echo "Updated Successfully!";
}

if (isset($_POST['delete'])) {
    $roll = $_POST['roll'];

    mysqli_query($conn, "DELETE FROM students WHERE rollno='$roll'");
    echo "Deleted Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student CRUD</title>
</head>
<body>

<h2>Student Form</h2>

<form method="POST">
First Name: <input type="text" name="fname" required><br><br>
Last Name: <input type="text" name="lname" required><br><br>
Roll No: <input type="text" name="roll" required><br><br>
Password: <input type="password" name="pass" required><br><br>
Contact: <input type="text" name="contact" required><br><br>

<input type="submit" name="insert" value="Insert">
<input type="submit" name="update" value="Update">
<input type="submit" name="delete" value="Delete">
</form>

<hr>

<h2>Student Records</h2>

<table border="1">
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Roll No</th>
<th>Contact</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM students");

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
    <td>{$row['firstname']}</td>
    <td>{$row['lastname']}</td>
    <td>{$row['rollno']}</td>
    <td>{$row['contact']}</td>
    </tr>";
}
?>

</table>

</body>
</html>