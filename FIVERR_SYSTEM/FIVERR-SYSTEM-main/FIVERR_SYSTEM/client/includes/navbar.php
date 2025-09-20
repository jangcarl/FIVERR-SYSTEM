<nav class="navbar navbar-expand-lg navbar-dark p-4" style="background-color: #023E8A;">
  <a class="navbar-brand" href="index.php">
    <?= ($_SESSION['role'] === 'administrator') ? 'Admin Panel' : 'Client Panel'; ?>
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="project_offers_submitted.php">Project Offers Submitted </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
      <?php if ($_SESSION['role'] === 'administrator'): ?>
        <li class="nav-item">
          <a class="nav-link" href="system.php">System</a>
        </li>
      <?php endif; ?>
      <!-- Categories Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu p-3" aria-labelledby="categoriesDropdown"
          style="max-height: 400px; overflow-y: auto; min-width: 320px;">
          <?php foreach ($categories as $cat): ?>
            <div class="mb-3">
              <h6 class="dropdown-header mb-2"><?php echo htmlspecialchars($cat['category_name']); ?></h6>
              <?php if (!empty($cat['subcategories'])): ?>
                <?php foreach ($cat['subcategories'] as $sub): ?>
                  <a class="dropdown-item" href="view_category.php?subcategory_id=<?php echo $sub['subcategory_id']; ?>">
                    <?php echo htmlspecialchars($sub['subcategory_name']); ?>
                  </a>
                <?php endforeach; ?>
              <?php else: ?>
                <span class="dropdown-item text-muted">No subcategories</span>
              <?php endif; ?>
              <div class="dropdown-divider"></div>
            </div>
          <?php endforeach; ?>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="core/handleForms.php?logoutUserBtn=1">Logout</a>
      </li>
    </ul>
  </div>
</nav>