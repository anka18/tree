<?
include_once 'DB.php';
include_once 'Router.php';

define('DB_HOST', 'mysql');
define('DB_USER', 'docker');
define('DB_PASSWORD', 'docker');
define('DB_NAME', 'docker');

$database = new DB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$router = new Router($database);

$router->get("/api/catalog/", function($db) {
    $categories = $db->getCategories();
    return json_encode($categories);
});


// Создаю новую запись категории
$router->post("/api/catalog/category/", function($db, $json) {
    $parentId = $json['data']['parent_id'];
    $name = $json['data']['name'];
    $description = $json['data']['description'];
    $category = $db->createCategory($parentId, $name, $description);
    return json_encode($category);
});
// Удаляю категорию
$router->delete("/api/catalog/category/", function($db, $json) {
    $categoryId = $json['id'];
    $category = $db->deleteCategory($categoryId);
    return json_encode($category);
});



// Создать новую запись элемента
$router->post("/api/catalog/category/element/", function($db, $json) {
    $categoryId = $json['data']['category_id'];
    $name = $json['data']['name'];
    $other = $json['data']['other'];
    //$typeEl = $json['data']['type_el'];
    $typeEl = 1;
    $element = $db->createCategoryElement($categoryId, $name, $other, $typeEl);
    return json_encode($element);
});

// Удаляю элемент
$router->delete("/api/catalog/category/element/", function($db, $json) {
    $elementId = $json['id'];
    $element = $db->deleteCategoryElement($elementId);
    return json_encode($element);
});



$router->do();
