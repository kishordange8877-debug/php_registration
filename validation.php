
<?php

include "db.php";

$message = "";
$status = "error";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $age = trim($_POST["age"] ?? "");

    if ($name == "") {
        $message = "Name is required!";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $message = "Only text is allowed!";
    } elseif ($email == "") {
        $message = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email!";
    } elseif ($phone == "") {
        $message = "Phone number is required!";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $message = "Phone number must be exactly 10 digits!";
    } elseif ($age == "") {
        $message = "Age is required!";
    } elseif (
        !filter_var($age, FILTER_VALIDATE_INT)
        || $age < 1
        || $age > 120
    ) {
        $message = "Age must be between 1 and 120!";
    } else {

        $sql = "INSERT INTO users (name, email, phone, age)
                VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "sssi",
                $name,
                $email,
                $phone,
                $age
            );

            if (mysqli_stmt_execute($stmt)) {
                $message = "Registration Successful!";
                $status = "success";
            } else {
                $message = "Registration Failed!";
            }

            mysqli_stmt_close($stmt);
        } else {
            $message = "Database query failed!";
        }
    }

    session_start();
    $_SESSION["message"] = $message;
    $_SESSION["status"] = $status;

    header("Location: index.php");
    exit;
}
?>
