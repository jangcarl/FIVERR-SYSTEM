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
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
  <!-- Bootstrap CSS -->
  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" rel="stylesheet" />
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
  <?php require_once 'includes/prelude.php'; ?>
  <?php include 'includes/navbar.php'; ?>
  <div class="container-fluid">
    <div class="display-4 text-center">Double click to edit!</div>
    <div class="text-center">
      <?php
      if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

        if ($_SESSION['status'] == "200") {
          echo "<h1 style='color: green;'>{$_SESSION['message']}";
        } else {
          echo "<h1 style= 'color: red;'>{$_SESSION['message']}</h1>";
        }

      }
      unset($_SESSION['message']);
      unset($_SESSION['status']);
      ?>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <?php $getProposalsByUserID = $proposalObj->getProposalsByUserID($_SESSION['user_id']); ?>
        <?php foreach ($getProposalsByUserID as $proposal) { ?>
          <div class="card proposalCard shadow mt-4 mb-4">
            <div class="card-body">
              <h2><a href="#"><?php echo $proposal['username']; ?></a></h2>
              <img src="<?php echo "../images/" . $proposal['image']; ?>" class="img-fluid" alt="">
              <p class="mt-4"><i><?php echo $proposal['proposals_date_added']; ?></i></p>
              <p class="mt-2"><?php echo $proposal['description']; ?></p>
              <h4>
                <i><?php echo number_format($proposal['min_price']) . " - " . number_format($proposal['max_price']); ?></i>
              </h4>
              <form action="core/handleForms.php" method="POST">
                <div class="form-group">
                  <input type="hidden" name="proposal_id" value="<?php echo $proposal['proposal_id']; ?>">
                  <input type="hidden" name="image" value="<?php echo $proposal['image']; ?>">
                  <input type="submit" name="deleteProposalBtn" class="btn btn-danger float-right" value="Delete">
                </div>
              </form>
              <form action="core/handleForms.php" method="POST" class="updateProposalForm d-none">
                <div class="row mt-4">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="#">Minimum Price</label>
                      <input type="number" class="form-control" name="min_price"
                        value="<?php echo $proposal['min_price']; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="#">Maximum Price</label>
                      <input type="number" class="form-control" name="max_price"
                        value="<?php echo $proposal['max_price']; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="category">Category</label>
                      <select class="form-control" id="category" name="category_id" required>
                        <option value="">-- Select Category --</option>
                        <?php
                        $categories = $categoryObj->getCategories();
                        foreach ($categories as $cat):
                          ?>
                          <option value="<?php echo $cat['category_id']; ?>" <?php echo (isset($proposal['category_id']) && $proposal['category_id'] == $cat['category_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['category_name']); ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="subcategory">Subcategory</label>
                      <select class="form-control" id="subcategory" name="subcategory_id" required>
                        <option value="">-- Select Subcategory --</option>
                      </select>
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="#">Description</label>
                      <input type="hidden" name="proposal_id" value="<?php echo $proposal['proposal_id']; ?>">
                      <textarea name="description" class="form-control"><?php echo $proposal['description']; ?></textarea>
                      <input type="submit" class="btn btn-primary form-control mt-2" name="updateProposalBtn">
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <script>
    $('.proposalCard').on('dblclick', function (event) {
      var updateProposalForm = $(this).find('.updateProposalForm');
      updateProposalForm.toggleClass('d-none');
    });
  </script>
  <script>
    function loadSubcategories(categoryId, preselectId) {
      const subSelect = document.getElementById('subcategory');
      if (!categoryId) {
        subSelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
        return;
      }
      fetch('core/get_subcategories.php?category_id=' + categoryId)
        .then(res => res.json())
        .then(data => {
          subSelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
          data.forEach(sub => {
            const opt = document.createElement('option');
            opt.value = sub.subcategory_id;
            opt.textContent = sub.subcategory_name;
            if (preselectId && String(preselectId) === String(sub.subcategory_id)) opt.selected =
              true;
            subSelect.appendChild(opt);
          });
        })
        .catch(err => console.error('Error loading subcategories:', err));
    }

    document.getElementById('category').addEventListener('change', function () {
      loadSubcategories(this.value, null);
    });

    // On page load: populate and preselect
    document.addEventListener('DOMContentLoaded', function () {
      const categoryId = document.getElementById('category').value;
      const preselectSubId =
        '<?php echo isset($proposal["subcategory_id"]) ? $proposal["subcategory_id"] : ""; ?>';
      if (categoryId) loadSubcategories(categoryId, preselectSubId);
    });
  </script>
  <script crossorigin="anonymous" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>