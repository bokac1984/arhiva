<?php
//debug($agreements);
?>

<div class="row">
    <div class="col-md-12">
        <div class="agreements index">
            <h2><?php echo __('Agreements'); ?></h2>
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('id', '#'); ?></th>
                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                        <th><?php echo $this->Paginator->sort('price'); ?></th>
                        <th><?php echo $this->Paginator->sort('contract_date'); ?></th>
                        <th><?php echo $this->Paginator->sort('agreement_type_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('purchase_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('supplier_id'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agreements as $agreement): ?>
                        <tr>
                            <td><?php echo h($agreement['Agreement']['id']); ?>&nbsp;</td>
                            <td><?php echo h($agreement['Agreement']['name']); ?>&nbsp;</td>
                            <td><?php echo h($agreement['Agreement']['price']); ?>&nbsp;</td>
                            <td><?php echo h($this->Time->format($agreement['Agreement']['contract_date'], '%d.%m.%Y')); ?>&nbsp;</td>                                    
                            <td>
                                <?php echo $this->Html->link($agreement['AgreementType']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['AgreementType']['id'])); ?>
                            </td>
                            <td>
                                <?php echo $this->Html->link($agreement['Purchase']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['Purchase']['id'])); ?>
                            </td>    
                            <td>
                                <?php echo $this->Html->link($agreement['Supplier']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['Purchase']['id'])); ?>
                            </td>                  
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
                            </td>                                    
                        </tr>
<?php endforeach; ?>
                </tbody>
            </table>
<?php echo $this->element('pagination'); ?>
        </div>
    </div>
</div>

