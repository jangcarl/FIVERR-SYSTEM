<?php require_once 'classloader.php'; ?>
<?php
if (!$userObj->isLoggedIn()) {
  header("Location: login.php");
}

if (!$userObj->isFreelancer()) {
  header("Location: ../client/index.php");
}

?>
<!DOCTYPE html>

<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
<!-- Bootstrap CSS -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" rel="stylesheet"/>

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
<div class="display-4 text-center">Hello there and welcome! <span class="text-success"><?php echo $_SESSION['username']; ?></span>. Add Proposal Here!</div>
<div class="row">
<div class="col-md-5">
<div class="card mt-4 mb-4">
<div class="card-body">
<form action="core/handleForms.php" enctype="multipart/form-data" method="POST">
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
                <h1 class="mb-4 mt-4">Add Proposal Here!</h1>
<div class="form-group">
<label for="exampleInputEmail1">Description</label>
<input class="form-control" name="description" required="" type="text"/>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Minimum Price</label>
<input class="form-control" name="min_price" required="" type="number"/>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Max Price</label>
<input class="form-control" name="max_price" required="" type="number"/>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Image</label>
<input class="form-control" name="image" required="" type="file"/>
<input class="btn btn-primary float-right mt-4" name="insertNewProposalBtn" type="submit"/>
</div>
</div>
</form>
</div>
</div>
</div>
<div class="col-md-7">
<?php $getProposals = $proposalObj->getProposals(); ?>
        <?php foreach ($getProposals as $proposal) { ?>
<div class="card shadow mt-4 mb-4">
<div class="card-body">
<h2><a href="&lt;?= $_SESSION['user_id'] == $proposal['user_id'] ? 'profile.php' : 'other_profile_view.php?user_id=' . $proposal['user_id'] ?>">
<?= htmlspecialchars($proposal['username']) ?>
</a></h2>
<img alt="" src="&lt;?php echo '../images/' . $proposal['image']; ?>"/>
<p class="mt-4"><i><?php echo $proposal['proposals_date_added']; ?></i></p>
<p class="mt-2"><?php echo $proposal['description']; ?></p>
<p class="mt-2">
<?php echo $proposal['category_name'] . ' - ' . $proposal['subcategory_name']; ?>
</p>
<h4><i><?php echo number_format($proposal['min_price']) . " - " . number_format($proposal['max_price']); ?>
                  PHP</i></h4>
<div class="float-right">
<a href="#">Check out services</a>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<script crossorigin="anonymous" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js">
</script>
</body>
</html>