<?php
include 'db.php';

$limit = 5;

$page = $_GET['page'] ?? 1;
$page = max(1, (int)$page);

$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM users LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

$count_sql = "SELECT COUNT(*) AS total FROM users";
$count_result = mysqli_query($conn, $count_sql);
$count_row = mysqli_fetch_assoc($count_result);

$total_records = $count_row['total'];
$total_pages = ceil($total_records / $limit);
?>

<!DOCTYPE html>

<html>
<head>
    <title>Registered Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Registered Users</h2>


<table class="table table-bordered table-striped">
    <thead class="table-success">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Age</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                echo "<td>
               <a href='edit.php?id=" . (int)$row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>

                <a href='delete.php?id=" . (int)$row['id'] . "' class='btn btn-danger btn-sm'
                 onclick='return confirm(\"Are you sure you want to delete this user?\");'> Delete </a>
                 </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
        }
        ?>
    </tbody>
</table>
<div class="text-center mt-3">

    <?php if ($page > 1) { ?>
        <a href="?page=<?= $page - 1 ?>" class="btn btn-primary">Previous</a>
    <?php } ?>

    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>

        <a href="?page=<?= $i ?>"
           class="btn <?= ($page == $i) ? 'btn-success' : 'btn-secondary' ?>">
            <?= $i ?>
        </a>

    <?php } ?>

    <?php if ($page < $total_pages) { ?>
        <a href="?page=<?= $page + 1 ?>" class="btn btn-primary">Next</a>
    <?php } ?>

</div>
<a href="index.php" class="btn btn-success">Add New User</a>
</div>
</body>
</html>
