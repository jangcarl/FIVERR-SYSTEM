<?php require_once 'classloader.php'; ?>
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
      background-image: url("https://img.freepik.com/premium-photo/pastel-tone-purple-pink-blue-gradient-defocused-abstract-photo-smooth-lines_49683-4702.jpg?w=1380");
    }
  </style>
<title>Hello, world!</title>

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
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 p-5">
<div class="card shadow">
<?php  
         if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

          if ($_SESSION['status'] == "200") {
            echo "<h1 style='color: green;'>{$_SESSION['message']}";
          }

          else {
            echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>"; 
          }

        }
        unset($_SESSION['message']);
        unset($_SESSION['status']);
        ?>
        <div class="card-header">
<h2>Welcome to cliet panel! Register Now as client!</h2>
</div>
<form action="core/handleForms.php" method="POST">
<div class="card-body">
<div class="form-group">
<label for="exampleInputEmail1">Username</label>
<input class="form-control" name="username" required="" type="text"/>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Email</label>
<input class="form-control" name="email" required="" type="email"/>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Password</label>
<input class="form-control" name="password" required="" type="password"/>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Confirm Password</label>
<input class="form-control" name="confirm_password" required="" type="password"/>
<input class="btn btn-primary float-right mt-4" name="insertNewUserBtn" type="submit"/>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</body>
</html>