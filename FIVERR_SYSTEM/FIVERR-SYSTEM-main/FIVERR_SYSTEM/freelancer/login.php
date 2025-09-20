<?php require_once 'classloader.php'; ?>
<!DOCTYPE html>

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
  <!-- Bootstrap CSS -->
  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <style>
    body {
      font-family: "Arial";
      background-image: url("https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
    }
  </style>
  <title>Hello, world!</title>

  <style>
    body {
      background-color: beige;
      color: #4B0082;
      /* deep purple */
      font-family: "Arial", sans-serif;
    }

    .navbar,
    .card-header {
      background-color: #6A0DAD !important;
      color: beige !important;
    }

    .card {
      background-color: #f9f6ef;
      /* soft beige */
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
      color: #6A0DAD !important;
      /* replace green with purple */
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 p-5">
        <div class="card shadow">
          <div class="card-header">
            <h2>Welcome to freelancer's dashboard, Login Now!</h2>
          </div>
          <form action="core/handleForms.php" method="POST">
            <div class="card-body">
              <?php
              if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

                if ($_SESSION['status'] == "200") {
                  echo "<h1 style='color: green;'>{$_SESSION['message']}";
                } else {
                  echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";
                }

              }
              unset($_SESSION['message']);
              unset($_SESSION['status']);
              ?>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input class="form-control" name="email" required="" type="email" />
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input class="form-control" name="password" required="" type="password" />
                <input class="btn btn-primary float-right mt-4" name="loginUserBtn" type="submit" />
              </div>
              <p>Don't have an account yet? You may <a href="register.php"> register here!</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>