<?php
//debug($agreements);
?>

<div class="row">
    <div class="col-md-12">
        <h2><?php echo h($company['Company']['name']); ?></h2>
        <div class="related">
            <h3><?php echo __('Naručilac'); ?></h3>
            <?php if (!empty($company['PurchaseAgreement'])): ?>
                <table class="table" cellpadding = "0" cellspacing = "0">
                    <tr>
                        <th><?php echo __('Name'); ?></th>
                        <th><?php echo __('Price'); ?></th>
                        <th><?php echo __('Contract Date'); ?></th>
                        <th><?php echo __('Agreement Type Id'); ?></th>
                        <th><?php echo __('Purchase Id'); ?></th>
                        <th><?php echo __('Supplier Id'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    <?php foreach ($company['PurchaseAgreement'] as $agreement): ?>
                        <tr>
                            <td><?php echo $agreement['name']; ?></td>
                            <td><?php echo $agreement['price']; ?></td>
                            <td><?php echo $agreement['contract_date']; ?></td>
                            <td>
                                <?php echo $this->Html->link($agreement['AgreementType']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['AgreementType']['id'])); ?>
                            </td>
                            <td><?php echo $agreement['supplier_id']; ?></td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('Download'), array('controller' => 'agreements', 'action' => 'sendFile', $agreement['new_file_name'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <h4><?php echo __('Nema ugovora kao naručilac'); ?></h4>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="related">
            <h3><?php echo __('Dobavljač'); ?></h3>
            <?php if (!empty($company['SupplierAgreement'])): ?>
                <table  class="table" cellpadding = "0" cellspacing = "0">
                    <tr>
                        <th><?php echo __('Ugovor'); ?></th>
                        <th><?php echo __('Iznos'); ?></th>
                        <th><?php echo __('Datum'); ?></th>
                        <th><?php echo __('Vrsta'); ?></th>
                        <th><?php echo __('Naručilac'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    <?php foreach ($company['SupplierAgreement'] as $agreement): ?>
                        <tr>
                            <td><?php echo $agreement['name']; ?></td>
                            <td><?php echo $agreement['price']; ?></td>
                            <td><?php echo $agreement['contract_date']; ?></td>
                            <td>
                                <?php echo $this->Html->link($agreement['AgreementType']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['AgreementType']['id'])); ?>
                            </td>
                            <td><?php echo $agreement['purchase_id']; ?></td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('Download'), array('controller' => 'agreements', 'action' => 'sendFile', $agreement['new_file_name'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <h4><?php echo __('Nema ugovora kao dobavljač'); ?></h4>
            <?php endif; ?>
        </div>                
    </div>
</div>