<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/php-practice/forum/index.php">Forum</a> <!-- Adjusted URL -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/php-practice/forum/index.php">Home</a> <!-- Adjusted URL -->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/php-practice/forum/about.php">About</a> <!-- Adjusted URL -->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/php-practice/forum/posts/index.php">Posts</a> <!-- Adjusted URL -->
        </li>
        <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
          
          <li class="nav-item">
            <a class="nav-link" href="/php-practice/forum/users/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/php-practice/forum/users/register.php">Register</a>
          </li>
          <?php if ($_SESSION["role"] === "admin") { ?>
            <li class="nav-item">
              <a class="nav-link" href="/admin/dashboard.php">Admin Dashboard</a>
            </li>
          <?php } ?>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="/php-practice/forum/users/logout.php">Logout</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
