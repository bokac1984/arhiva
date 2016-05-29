<?php
$data = array();

foreach ($contracts as $contract) {
    $datum = date("d.m.Y", strtotime($contract['Contract']['datum']));
    $data[] = array(
        'title' => $contract['Contract']['name'] . ', ' . $datum,
        'key' => $contract['Contract']['id'],
        'tooltip' => "<span class='tooltip'>dadas</span>",
        'data' => array(
            'download' => $this->Html->link('Skini <i class="fa fa-download"></i>', array(
                'controller' => 'contracts',
                'action' => 'sendFile',
                $contract['Contract']['new_file_name']
            ),array(
                'target' => '_blank',
                'role' => 'button',
                'class' => 'btn btn-block btn-primary',
                'escape' => false
            )),
            'naziv' => $contract['Contract']['name']
        )
    );
}

echo json_encode($data, JSON_PRETTY_PRINT);