```php
<?php

include "db.php";

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: display.php");
            exit;
        } else {
            echo "Delete failed!";
        }

        mysqli_stmt_close($stmt);

    } else {
        echo "Query preparation failed!";
    }

} else {
    echo "User ID not found!";
}

?>

