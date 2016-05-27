<?php
//{title: "Folder 2", key: "2", folder: true, lazy: true}
$data = array();

foreach ($institutions as $key => $name) {
    $data[] = array(
        'title' => $name,
        'key' => $key,
        'folder' => true,
        'lazy' => true
    );
}

echo json_encode($data, JSON_PRETTY_PRINT);