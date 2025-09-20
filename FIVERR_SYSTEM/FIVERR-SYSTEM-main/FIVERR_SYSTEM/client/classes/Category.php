<?php
require_once 'Database.php';

class Category extends Database
{

    /**
     * Create a new category.
     * @param string $name
     * @return bool
     */
    public function createCategory($name)
    {
        $sql = "INSERT INTO categories (category_name) VALUES (?)";
        return $this->executeNonQuery($sql, [$name]);
    }

    public function getCategoryByName($name)
    {
        $normalized = strtolower(preg_replace('/\s+/', '', $name));
        $sql = "SELECT * FROM categories WHERE REPLACE(LOWER(category_name), ' ', '') = ?";
        return $this->executeQuerySingle($sql, [$normalized]);
    }



    /**
     * Get all categories.
     * @return array
     */
    public function getCategories()
    {
        $sql = "SELECT * FROM categories";
        return $this->executeQuery($sql);
    }

    /**
     * Get subcategories for a specific category.
     * @param int $categoryId
     * @return array
     */
    public function getSubcategories($categoryId)
    {
        $sql = "SELECT * FROM subcategories WHERE category_id = ?";
        return $this->executeQuery($sql, [$categoryId]);
    }

    /**
     * Get all categories along with their subcategories.
     * @return array
     */
    public function getCategoriesWithSubcategories()
    {
        $categories = $this->getCategories();
        foreach ($categories as &$cat) {
            $cat['subcategories'] = $this->getSubcategories($cat['category_id']);
        }
        return $categories;
    }

    public function addSubcategory($categoryId, $subName)
    {
        $sql = "INSERT INTO subcategories (category_id, subcategory_name) VALUES (?, ?)";
        return $this->executeNonQuery($sql, [$categoryId, $subName]);
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }


    public function normalizeName($name)
    {
        $name = trim($name);                        // remove leading/trailing spaces
        $name = preg_replace('/\s+/', ' ', $name);  // collapse multiple spaces into 1
        $name = strtolower($name);                  // lowercase everything
        $name = ucwords($name);                     // capitalize each word
        return $name;
    }

    public function getSubcategoryByName($categoryId, $name)
    {
        $normalized = strtolower(preg_replace('/\s+/', '', $name));
        $sql = "SELECT * FROM subcategories 
            WHERE category_id = ? 
            AND REPLACE(LOWER(subcategory_name), ' ', '') = ?";
        return $this->executeQuerySingle($sql, [$categoryId, $normalized]);
    }


}