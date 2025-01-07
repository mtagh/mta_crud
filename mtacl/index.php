<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// Include functions
require 'functions.php';

// Pagination configuration
$numberofDataperPage = 4;
$numberofData = count(query("SELECT * FROM contacts"));
$numberofPages = ceil($numberofData / $numberofDataperPage);

// Determine active page
$activePage = isset($_GET["page"]) ? $_GET["page"] : 1;
$startingData = ($numberofDataperPage * $activePage) - $numberofDataperPage;

// Retrieve contacts for the current page
$contacts = query("SELECT * FROM contacts LIMIT $startingData, $numberofDataperPage");

// Handle search functionality
if (isset($_POST["search"])) {
    $contacts = search($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTA | Contact List</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .table td, .table th {
            vertical-align: middle; /* Align content vertically center */
        }
        .pagination {
            justify-content: center; /* Center align pagination */
        }
        .table th {
            white-space: nowrap; /* Prevent column text wrapping */
        }
        .btn-action {
            width: 70px; /* Set width for Edit and Delete buttons */
        }
        .notes-column {
            width: 20%; /* Make Notes column wider */
        }
        .name-column, .institution-column, .email-column, .phone-column, .role-column {
            width: 12%; /* Evenly distribute column widths */
        }
        .pagination {
            width: 100%; /* Set pagination width to 100% */
        }
        .pagination > .page-item > .page-link {
            width: 100%; /* Set page link width to 100% */
            text-align: center; /* Center align text within page link */
        }
    </style>
</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>MTA | Contact List</h1>
        <div>
            <a href="logout.php" class="btn btn-danger">Logout</a>
            <a href="add.php" class="btn btn-primary ml-2">Add Contact</a>
        </div>
    </div>

    <!-- Search form -->
    <form action="" method="post" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Enter keyword" autofocus autocomplete="off">
            <div class="input-group-append">
                <button type="submit" name="search" class="btn btn-outline-secondary">Search</button>
            </div>
        </div>
    </form>

    <!-- Contacts table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Picture</th>
                    <th class="name-column">Name</th>
                    <th class="institution-column">Institution</th>
                    <th class="email-column">Email</th>
                    <th class="phone-column">Cellphone</th>
                    <th class="role-column">Role</th>
                    <th class="notes-column">Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($contacts as $rct) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <?php if (!empty($rct["picture"])) : ?>
                                <img src="img/<?= $rct["picture"]; ?>" width="40" class="img-thumbnail">
                            <?php else : ?>
                                n/a
                            <?php endif; ?>
                        </td>
                        <td><?= $rct["name"]; ?></td>
                        <td><?= $rct["institution"]; ?></td>
                        <td><?= $rct["email"]; ?></td>
                        <td><?= $rct["phone"]; ?></td>
                        <td><?= $rct["role"]; ?></td>
                        <td><?= $rct["notes"]; ?></td>
                        <td>
                            <a href="edit.php?id=<?= $rct["id"]; ?>" class="btn btn-sm btn-primary btn-action">Edit</a>
                            <a href="delete.php?id=<?= $rct["id"]; ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav aria-label="Contacts Pagination">
        <ul class="pagination justify-content-center">
            <?php if ($activePage > 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $activePage - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $numberofPages; $i++) : ?>
                <li class="page-item <?php if ($i == $activePage) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($activePage < $numberofPages) : ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $activePage + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">Next &raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
