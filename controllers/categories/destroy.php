<?php

use Core\Database;

$config = require base_path("config.php");
$db = new Database($config);

$category = $db->query("select * from categories where id = :id", [
    "id" => $_POST['id']
])->findOrFail();


$db->query("delete from categories where id = :id", [
    "id" => $_POST['id']
]);

redirect("/categories");
