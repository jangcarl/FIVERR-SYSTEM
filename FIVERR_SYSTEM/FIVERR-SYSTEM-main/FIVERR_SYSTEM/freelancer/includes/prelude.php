<?php
require_once 'classes/Category.php';
$categoryObj = $categoryObj ?? new Category();
$categories = $categoryObj->getCategoriesWithSubcategories();