<?php
$data = array();

foreach ($contracts as $contract) {
    $datum = date("d.m.Y", strtotime($contract['Contract']['datum']));
//    $data[] = array(
//        'name' => $contract['Contract']['name'],
//        'date' => $datum,
//        'price' => $contract['Contract']['price'],
//        'data' => array(
            $download = $this->Html->url(array(
                'controller' => 'contracts',
                'action' => 'sendFile',
                $contract['Contract']['new_file_name']
            ),array(
                'target' => '_blank',
                'role' => 'button',
                'class' => 'btn btn-block btn-primary',
                'escape' => false
            ));
//        )
//    );
?>

    <li class="files">
        <a id="<?php echo $contract['Contract']['id']; ?>" href="<?php echo $download; ?>" title="<?php echo $contract['Contract']['name']; ?>" class="files">
            <span class="icon file f-pdf">.pdf</span>
            <span class="name"><?php echo $contract['Contract']['name']; ?></span> 
            <span class="details"><?php echo $datum; ?></span>
        </a>
    </li>    
<?php
    
} 
?>