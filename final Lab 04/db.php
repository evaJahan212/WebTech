<?php
include "config.php";

$success = $error="";

if($_SERVER["REQUEST_METHOD"]=="POST")
    {

$id=$_POST["id"];
$name=$_POST["name"];
$email=$_POST["email"];
$regNo=$_POST["regNo"];
$department=$_POST["department"];

if (empty($name)||empty($email)||empty($regNo)||empty($department))
    {
        $error="Please fill all the field";
    }
   else
    {
        $sql="INSERT INTO students(id,name,email,regNo,department) VALUES ('$id','$name','$email','$regNo','$department')";

        if(mysqli_query($conn, $sql) === TRUE)
            $success="Registration complete";
        else
            {
                $error= "Error" . mysqli_error($conn);
            }
        
    
        } 


    }

/* DELETE STUDENT */
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    $sql = "DELETE FROM students WHERE id='$id'";

    if(mysqli_query($conn,$sql))
        $success = "Student Deleted Successfully";
    else
        $error = "Error deleting record";
}

/* UPDATE STUDENT */
if(isset($_POST['update']))
{
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $department = $_POST["department"];

    $sql = "UPDATE students 
            SET name='$name', email='$email', department='$department'
            WHERE id='$id'";

    if(mysqli_query($conn,$sql))
        $success = "Student Updated Successfully";
    else
        $error = "Error updating record";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="">
       
        Name: <input type="text" name="name"><br><br>
        Email: <input type="email" name="email"><br><br>
        Registration Number: <input type="text" name="regNo"><br><br>
        Department: <input type="text" name="department"><br><br>
        <input type="submit" value="Register">
    </form>

    <p style="color:green;"><?php echo $success; ?></p>
    <p style="color:red;"><?php echo $error; ?></p>

    <hr>

<h2>Student List</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Registration No</th>
    <th>Department</th>
    <th>Action</th>
</tr>

<?php
$sql = "SELECT * FROM students";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result))
{
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['regNo']; ?></td>
    <td><?php echo $row['department']; ?></td>
    <td>
        <a href="?edit=<?php echo $row['id']; ?>">Edit</a> |
        <a href="?delete=<?php echo $row['id']; ?>">Delete</a>
    </td>
</tr>
<?php
}
?>
</table>

<hr>

<?php
/* EDIT FORM */
if(isset($_GET['edit']))
{
    $id = $_GET['edit'];

    $sql = "SELECT * FROM students WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
?>

<h2>Edit Student</h2>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>

    Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br><br>

    regNo: <input type="text" name="regNo" value="<?php echo $row['regNo']; ?>"><br><br>
    
    Department: <input type="text" name="department" value="<?php echo $row['department']; ?>"><br><br>
    

    <input type="submit" name="update" value="Update Student">
</form>

<?php
}
?>

</body>
</html>
