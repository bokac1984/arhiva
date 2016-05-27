<?php
$data = array();

foreach ($contracts as $contract) {
    $data[] = array(
        'title' => $contract['Contract']['name'],
        'key' => $contract['Contract']['id'],
        'tooltip' => "<span class='tooltip'>dadas</span>"
    );
}

echo json_encode($data, JSON_PRETTY_PRINT);