<?php require_once 'classloader.php'; ?>
<?php
if (!$userObj->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

if (!($userObj->isAdmin())) {
    header('Location: ../freelancer/index.php');
    exit;
}

$user_id = $_SESSION['user_id']; // assuming you store logged-in user in session
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
<script src="https://cdn.tailwindcss.com"></script>
<style>
        body {
            font-family: "Arial";
        }

        .navbar .collapse {
            visibility: visible !important;
        }

        @media (min-width: 992px) {
            .navbar-expand-lg .navbar-collapse {
                display: flex !important;
            }
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
<?php include 'includes/navbar.php'; ?>
<div class="container-fluid">
<div class="display-4 text-center">Hello there and welcome! Admin <span class="text-success"><?php echo $_SESSION['username']; ?> </span>. This page is only for you.</div>
<div class="text-center">
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
        </div>
<div class="row justify-content-center">
<div class="flex flex-col gap-5 md:flex-row md:space-x-5 m-3">
<div class="card p-4 shadow-md rounded-lg">
<h3 class="text-lg font-semibold">Add a New Category</h3>
<label class="mb-3 text-gray-500" for="categories">Create a new Category &amp; its Subcategories</label>
<form action="core/handleForms.php" method="POST">
<!-- Category Input -->
<div class="mb-3">
<label class="form-label" for="category">Category Name</label>
<input class="form-control" id="category" name="category" required="" type="text"/>
</div>
<!-- Subcategories -->
<div class="mb-3" id="subcategories">
<label class="form-label">Subcategories</label>
<div class="input-group mb-2 space-x-2">
<input class="form-control rounded-lg" name="subcategories[]" placeholder="Enter subcategory" type="text"/>
<button class="btn btn-danger remove-sub" type="button">Remove</button>
</div>
</div>
<div class="flex flex-row justify-between">
<!-- Add More Button -->
<button class="btn btn-secondary" id="addSubcategory" type="button">+ Add
                                Subcategory</button>
<!-- Submit -->
<button class="btn btn-primary" name="addCategoryBtn" type="submit">Save Category</button>
</div>
</form>
</div>
</div>
</div>
</div>
<script>
        const addSubBtn = document.getElementById('addSubcategory');
        const subContainer = document.getElementById('subcategories');

        addSubBtn.addEventListener('click', () => {
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2', 'space-x-2');
            div.innerHTML = `
        <input type="text" name="subcategories[]" class="form-control" placeholder="Enter subcategory" required>
        <button type="button" class="btn btn-danger remove-sub">Remove</button>
      `;
            subContainer.appendChild(div);
        });

        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-sub')) {
                e.target.parentElement.remove();
            }
        });
    </script>
</body>
</html>