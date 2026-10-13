
<?php
include "db.php";

$id = $_GET['id'] ?? $_POST['id'];

// Update data
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];

    $sql = "UPDATE users SET name='$name', email='$email',
            phone='$phone', age='$age' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: display.php");
        exit;
    }
}

// Get user data
$sql = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit User</h2>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        Name:
        <input type="text" name="name" class="form-control mb-3"
               value="<?php echo htmlspecialchars($row['name']); ?>" required>

        Email:
        <input type="email" name="email" class="form-control mb-3"
               value="<?php echo htmlspecialchars($row['email']); ?>" required>

        Phone:
        <input type="text" name="phone" class="form-control mb-3"
               value="<?php echo htmlspecialchars($row['phone']); ?>" required>

        Age:
        <input type="number" name="age" class="form-control mb-3"
               value="<?php echo $row['age']; ?>" required>

        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="display.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>

