<?php

class DB
{
    private $conn;

    function __construct($host, $user, $password, $dbname)
    {
        $errorMessage = 'Невозможно подключиться к серверу базы данных';
        $this->conn = new mysqli($host, $user, $password, $dbname);
        $this->conn->set_charset('utf8');

        if (!$this->conn) {
            throw new Exception($errorMessage);
        } else {
            $query = $this->conn->query('set names utf8');
            if (!$query) {
                throw new Exception($errorMessage);
            }
        }
    }

    function getCategories()
    {
        function getElementsById($elements, $id) {
            $record = array();
            foreach($elements as $rec) {
                if ($rec['category_id'] == $id) {
                    $record[] = $rec;
                }
            }
            return $record;
        }

        $res = $this->conn->query("SELECT date_create, date_mod, description, id, parent_id, name FROM categories");
        while ($category = mysqli_fetch_assoc($res)) {
            $category['element_type'] = 'category';
            $category['category_id'] = $category['id'];
            $categories[] = $category;
        }

        $res = $this->conn->query("SELECT date_create, date_mod, id, category_id, name, other FROM elements");
        while ($element = mysqli_fetch_assoc($res)) {
            $element['element_type'] = 'element';
            $element['element_id'] = $element['id'];
            $element['id'] = '999999999' . $element['id']; // id должен быть уникальный, не пересеркаться с категорией, иначе реакт даст ошибки
            $elements[] = $element;
        }

        $itemsByReference = array();
        // Build array of item references:
        foreach ($categories as $key => &$item) {
            $elms = getElementsById($elements, $item['id']);
            $itemsByReference[$item['id']] = &$item;
            $itemsByReference[$item['id']]['children'] = $elms;
            $itemsByReference[$item['id']]['data'] = new StdClass();
        }
        // Set items as children of the relevant parent item.
        foreach ($categories as $key => &$item) {
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                $itemsByReference [$item['parent_id']]['children'][] = &$item;
            }
        }
        // Remove items that were added to parents elsewhere:
        foreach($categories as $key => &$item) {
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
               unset($categories[$key]);
            }
        }
        // iterate to make the index in a sequential order
        $record = array();
        foreach($categories as $rec) {
            $record[] = $rec;
        }
        return $record;
    }

    function createCategory($parentId, $name, $description)
    {
        // Создаю запись в БД и получаю ее идентификатор
        $sql = "INSERT INTO categories (name, date_create, date_mod, description, parent_id) VALUES ('$name', NOW(), NOW(), '$description', $parentId)";
        $res = $this->conn->query($sql);
        $lastid = mysqli_insert_id($this->conn);
        // получаю новую запись из БД
        $sql = "SELECT date_create, date_mod, description, id, parent_id, name FROM categories WHERE id='$lastid'";
        //echo $sql;
        $res = $this->conn->query($sql);
        while($row = mysqli_fetch_assoc($res)) {
            $row['element_type'] = 'category';
            $row['children'] = array();
            $category[] = $row;
        }
        //var_dump($category);
        return $category;
    }

    function createCategoryElement($categoryId, $name, $other, $typeEl)
    {
        $sql = "INSERT INTO `elements` (`id`, `name`, `category_id`, `date_create`, `date_mod`, `type_el`, `other`) VALUES (NULL, '$name', $categoryId, NOW(), NOW(), $typeEl, '$other')";
        $res = $this->conn->query($sql);
        $lastid = mysqli_insert_id($this->conn);
        // получаю новую запись из БД
        $sql = "SELECT date_create, date_mod, id, category_id, name, other FROM elements WHERE id='$lastid'";
        $res = $this->conn->query($sql);
        while($row = mysqli_fetch_assoc($res)) {
            $category[] = $row;
        }
        return $category;
    }

    function deleteCategory($categoryId)
    {
        $sql = "DELETE FROM `elements` WHERE `elements`.`category_id` = $categoryId";
        $res = $this->conn->query($sql);

        $sql = "DELETE FROM `categories` WHERE `categories`.`id` = $categoryId";
        $res = $this->conn->query($sql);


        //echo $sql;

        return array("status" => true);
    }

    function deleteCategoryElement($elementId)
    {
        $sql = "DELETE FROM `elements` WHERE `elements`.`id` = $elementId";
        echo $sql;
        $res = $this->conn->query($sql);
        return array("status" => true);
    }
}
