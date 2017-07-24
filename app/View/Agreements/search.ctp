<?php
echo $this->Html->css('search', array('block' => 'css'));
echo $this->Html->script('/plugins/bootstrap3-editable/js/bootstrap-editable.min', array('block' => 'scriptBottom'));
echo $this->Html->css('/plugins/bootstrap3-editable/css/bootstrap-editable', array('block' => 'css'));

echo $this->Html->script('/js/agreements/search', array('block' => 'scriptBottom'));

$var = "var types = [";
$varValues = array();
foreach($types as $k=>$v) {
    $varValues[] = "{value: $k, text: '$v'}";
}

$var .= implode(",", $varValues). "];";

echo $this->Html->scriptBlock("$var; searchFun.init();", array('block' => 'scriptBottom'));

?>
<?php echo $this->element('search'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="agreements index">
            <table class="table table-responsive table-hover search-table" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('name', 'Naziv'); ?></th>
                        <th><?php echo $this->Paginator->sort('price', 'Cijena'); ?></th>
                        <th><?php echo $this->Paginator->sort('contract_date', 'Datum (dd.mm.gggg)'); ?></th>
                        <th><?php echo $this->Paginator->sort('purchase_id', 'Narucilac'); ?></th>
                        <th><?php echo $this->Paginator->sort('supplier_id', 'Dobavljac'); ?></th>
                        <th><?php echo $this->Paginator->sort('agreement_type', 'Tip'); ?></th>
                        <th><?php echo $this->Paginator->sort('new_file_name', 'Fajl'); ?></th>
                        <th><?php echo $this->Paginator->sort('path', 'Path'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agreements as $agreement): ?>
                        <tr>
                            <td><?php echo h($agreement['Agreement']['name']); ?>&nbsp;</td>
                            <td><?php echo h($agreement['Agreement']['price']); ?>&nbsp;</td>
                            <td>
                                <?php
                                echo $this->Html->link($this->Time->format($agreement['Agreement']['contract_date'], '%d.%m.%Y'), '#', array(
                                    'data-pk' => $agreement['Agreement']['id'],
                                    'data-type' => 'date',
                                    'class' => 'contract_date',
                                    'data-url' => Router::url(array('controller' => 'agreements', 'action' => 'editable')),
                                    'data-title' => 'Odaberi datum',
                                    'data-name' => 'contract_date'
                                ));
                                ?>                                
                                &nbsp;</td>
                            <td>
                                <?php echo $this->Html->link($agreement['Purchase']['name'], array('controller' => 'companies', 'action' => 'view', $agreement['Purchase']['id'])); ?>
                            </td>
                            <td>
                                <?php echo $this->Html->link($agreement['Supplier']['name'], array('controller' => 'companies', 'action' => 'view', $agreement['Supplier']['id'])); ?>
                            </td>  
                            <td>
                                <?php echo $this->Html->link(
                                        $agreement['AgreementType']['name'], 
                                        '#',
                                        array(
                                            'data-pk' => $agreement['AgreementType']['id'],
                                            'data-type' => 'select',
                                            'class' => 'agreement-type',
                                            'data-url' => Router::url(array('controller' => 'agreements', 'action' => 'editable')),
                                            'data-title' => 'Odaberi tip',
                                            'data-name' => 'agreement_type_id'
                                        )); ?>
                            </td> 
                            <td><?php echo h($agreement['Agreement']['new_file_name']); ?>&nbsp;</td>  
                            <td><?php echo h($agreement['Agreement']['path']); ?>&nbsp;</td>  
                            <td class="actions">
                                <?php
                                echo $this->Link->cLink(__(''), array('action' => 'view', $agreement['Agreement']['id']), 'fa fa-eye', array(
                                    'title' => 'Pregledaj ugovor'
                                ));
                                ?>
                                <?php
                                echo $this->Link->cLink(__(''), array('action' => 'edit', $agreement['Agreement']['id']), 'fa fa-edit', array(
                                    'title' => 'Uredi'
                                ));
                                ?>
                                <?php echo $this->Link->dLink("", array('action' => 'delete', $agreement['Agreement']['id']), 'fa fa-trash-o', $agreement['Agreement']['id']); ?>

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