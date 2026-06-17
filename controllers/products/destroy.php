<?php

use Core\Database;

$config = require base_path("config.php");
$db = new Database($config);

$product = $db->query("select * from products where id = :id", [
    "id" => $_POST['id']
])->findOrFail();


$db->query("delete from products where id = :id", [
    "id" => $_POST['id']
]);

redirect("/products");
