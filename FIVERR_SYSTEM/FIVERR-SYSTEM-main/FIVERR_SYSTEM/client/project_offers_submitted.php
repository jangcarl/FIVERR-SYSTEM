<?php require_once 'classloader.php'; ?>
<?php
if (!$userObj->isLoggedIn()) {
  header("Location: login.php");
  exit;
}

if (!($userObj->isClient() || $userObj->isAdmin())) {
  header('Location: ../freelancer/index.php');
  exit;
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
<!-- Bootstrap CSS -->
<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" rel="stylesheet"/>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<style>
    body {
      font-family: "Arial";
    }
  </style>

<style>
    body {
        background-color: beige;
        color: #4B0082; /* deep purple */
        font-family: "Arial", sans-serif;
    }
    .navbar, .card-header {
        background-color: #6A0DAD !important;
        color: beige !important;
    }
    .card {
        background-color: #f9f6ef; /* soft beige */
        border: 1px solid #6A0DAD;
    }
    .btn-primary {
        background-color: #6A0DAD !important;
        border-color: #6A0DAD !important;
        color: beige !important;
    }
    .btn-primary:hover {
        background-color: #4B0082 !important;
        border-color: #4B0082 !important;
    }
    .text-success {
        color: #6A0DAD !important; /* replace green with purple */
    }
</style>
</head>
<body>
<?php require_once 'includes/prelude.php'; ?>
<?php include 'includes/navbar.php'; ?>
<div class="container-fluid">
<div class="display-4 text-center">Hello there and welcome! Here are all the submitted project offers!</div>
<div class="row justify-content-center">
<div class="col-md-12">
</div>
</div>
</div>
<script crossorigin="anonymous" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js">
</script>
</body>
</html>