
<?php
session_start();
include "db.php";

$message = $_SESSION["message"] ?? "";
$status = $_SESSION["status"] ?? "";

unset($_SESSION["message"], $_SESSION["status"]);

$sql = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>

<html>
<head>
    <title>Registration Form</title>


<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>


<div class="container">
        
<?php if ($message != ""): ?>
<script>
    alert(<?php echo json_encode($message); ?>);
</script>
<?php endif; ?>


    <div class="card">

        <div class="card-header">
            <h4>Registration Form</h4>
        </div>

        <div class="card-body">

           <form action="validation.php" method="POST">

                <label class="form-label">Name:</label>
                <input type="text" name="name" class="form-control mb-2"
                       placeholder="Enter your name" required>

                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control mb-2"
                       placeholder="Enter your email" required>

                <label class="form-label">Phone:</label>
                <input type="tel" name="phone" class="form-control mb-2"
                       placeholder="Enter your phone" required>

                <label class="form-label">Age:</label>
                <input type="number" name="age" class="form-control mb-3"
                       placeholder="Enter your age" required>

                <button type="submit" class="btn btn-primary w-100">
                    Register
                </button>

                
                <div class="text-center mt-3">
                <a href="display.php">Registered Users</a>
               </div>



            </form>

        </div>
    </div>

</div>


</body>
</html>
