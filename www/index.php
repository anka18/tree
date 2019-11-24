<?
define('DB_HOST', 'mysql');
define('DB_USER', 'docker');
define('DB_PASSWORD', 'docker');
define('DB_NAME', 'docker');

// Подключаемся к базе данных
function connectDB() {
    $errorMessage = 'Невозможно подключиться к серверу базы данных';
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $conn->set_charset('utf8');

    //echo mb_internal_encoding();
    if (!$conn)
        throw new Exception($errorMessage);
    else {
        $query = $conn->query('set names utf8');
        if (!$query) {
            throw new Exception($errorMessage);
        } else {
            return $conn;
        }
    }
}

function getCategories($db) {
    $query = "
        SELECT
           *
        FROM
           categories
        ORDER BY
           `id`
    ";
    $data = $db->query($query);
    $categories = array();
    while ($row = $data->fetch_assoc()) {
        array_push($categories, array(
            'id' => $row['id'],
            'text' => $row['category'],
            'isLeaf' => 'true',
            'date_create' => $row['date_create'],
            'date_mod' => $row['date_mod'],
            'description' => $row['description'],
            'parent_id' => $row['parent_id']
        ));
    }
    return $categories;
}

function getElements($db) {
    $query = "
        SELECT
           *
        FROM
           elements
        ORDER BY
           `id`
    ";
    $data = $db->query($query);
    $elements = array();
    while ($row = $data->fetch_assoc()) {
        array_push($elements, array(
            'id' => $row['id'],
            'title' => $row['title'],
            'section_id' => $row['section_id'],
            'date_create' => $row['date_create'],
            'date_mod' => $row['date_mod'],
            'type_el' => $row['type_el'],
            'other' => $row['other']
        ));
    }
    return $elements;
}

/**
 * Функция для формирования иерархического дерева
 */
function build_tree($data, $childs){
    $tree = array();
    foreach($data as $id => &$row){
        if(empty($row['parent_id'])){
            $tree[$id] = &$row;
            foreach ($childs as $child_id => $child) {
                if ($child['section_id'] == $row['parent_id']) {
                    $data[$row['parent_id']]['childs'][$id] = $child;
                }
            }
        }
        else{
            $data[$row['parent_id']]['childs'][$id] = &$row;
        }
    }
    return $tree;
}

try {
    // Подключаемся к базе данных
    $conn = connectDB();

    // Получаем данные из массива GET
    $result = getCategories($conn);
    $result_elem = getElements($conn);

    $tree = build_tree($result, $result_elem);

    // Возвращаем клиенту успешный ответ
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    header('Content-Type: application/json');
    echo json_encode(array(
        //'code' => 'success',
        'id' => '111111',
        'text' => 'Root node',
        'children' => $result
        //'elements' => $result_elem,
        //'children' => $tree
    )
    );

    //echo var_dump($tree);
    //echo var_dump($result_elem);
}
catch (Exception $e) {
    // Возвращаем клиенту ответ с ошибкой
    echo json_encode(array(
        'code' => 'error',
        'message' => $e->getMessage()
    ));
}

?>
