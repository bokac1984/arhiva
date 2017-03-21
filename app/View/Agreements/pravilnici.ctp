<?php
echo $this->Html->css('/css/institutions/icons', array('block' => 'css'));
echo $this->Html->css('/css/institutions/overview', array('block' => 'css'));
echo $this->Html->css('/css/institutions/spinner', array('block' => 'css'));
//debug($agreements);
?>
<div class="row">
    <div class="col-md-12">
        <h2>Pravilnici javnih nabavki</h2>
    </div>
</div>
<hr class="">
<div class="row">
    <div class="col-md-12">
        <div class="agreements index">
            <table class="table table-responsive table-condensed" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('purchase_id', 'Javno preduzeće'); ?></th>
                        <th><?php echo $this->Paginator->sort('contract_date', 'Datum'); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agreements as $agreement): ?>
                    <tr>
                        <td>
                            <?php echo $this->Html->link($agreement['Purchase']['name'], array('controller' => 'companies', 'action' => 'view', 'id' => $agreement['Purchase']['id'])); ?>
                        </td>
                        <td><?php echo h($this->Time->format($agreement['Agreement']['contract_date'], '%d.%m.%Y')); ?>&nbsp;</td>                                    
                        <td>
                            <?php
                            echo $this->Link->cLink(__(''), array('action' => 'sendFile', 'filename' => $agreement['Agreement']['new_file_name']), 'fa fa-download', array(
                                'title' => 'Skini ugovor'
                            ));
                            ?>                            
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo $this->element('pagination'); ?>
        </div>
    </div>
</div>      