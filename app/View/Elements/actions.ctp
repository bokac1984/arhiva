<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<td class="actions">
<?php
echo $this->Link->cLink(__(''), array('action' => 'view', $data['id']), 'fa fa-eye', array(
    'title' => 'Pregledaj'
));
?>
    <?php
    echo $this->Link->cLink(__(''), array('action' => 'edit', $data['id']), 'fa fa-edit', array(
        'title' => 'Uredi'
    ));
    ?>
    <?php echo $this->Link->dLink("", array('action' => 'delete', $data['id']), 'fa fa-trash-o', $data['id']); ?>
</td>