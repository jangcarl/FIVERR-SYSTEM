<?php
require_once '../classloader.php';

$categoryId = $_GET['category_id'] ?? 0;

// return subcategories for the chosen category
$subs = $categoryObj->getSubcategories($categoryId);

// return JSON response
header('Content-Type: application/json');
echo json_encode($subs);