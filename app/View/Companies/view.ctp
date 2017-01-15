<?php
//debug($company);
?>
<div class="row">
    <div class="col-md-12">
        <h2><?php echo h($company['Company']['name']); ?></h2>
        <div class="related">
            <h3><?php echo __('Naručilac'); ?></h3>
            <?php if (!empty($company['PurchaseAgreement'])): ?>
                <table class="table" cellpadding = "0" cellspacing = "0">
                    <tr>
                        <th><?php echo __('Ugovor'); ?></th>
                        <th><?php echo __('Iznos'); ?></th>
                        <th><?php echo __('Datum'); ?></th>
                        <th><?php echo __('Vrsta'); ?></th>
                        <th></th>
                    </tr>
                    <?php foreach ($company['PurchaseAgreement'] as $agreement): ?>
                        <tr>
                            <td><?php echo $agreement['name']; ?></td>
                            <td><?php echo $agreement['price']; ?></td>
                            <td><?php echo $this->Time->format($agreement['contract_date'], '%d.%m.%Y'); ?></td>
                            <td>
                                <?php echo $this->Html->link($agreement['AgreementType']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['AgreementType']['id'])); ?>
                            </td>                          
                            <td>
                                <?php
                                echo $this->Link->cLink(__(''), array('controller' => 'agreements','action' => 'sendFile', $agreement['new_file_name']), 'fa fa-download', array(
                                    'title' => 'Skini ugovor'
                                ));
                                ?>                            
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
                        <th></th>
                    </tr>
                    <?php foreach ($company['SupplierAgreement'] as $agreement): ?>
                        <tr>
                            <td><?php echo $agreement['name']; ?></td>
                            <td><?php echo $agreement['price']; ?></td>
                            <td><?php echo $this->Time->format($agreement['contract_date'], '%d.%m.%Y'); ?></td>
                            <td>
                                <?php echo $this->Html->link($agreement['AgreementType']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['AgreementType']['id'])); ?>
                            </td>
                            <td>
                                <?php
                                echo $this->Link->cLink(__(''), array('controller' => 'agreements','action' => 'sendFile', $agreement['new_file_name']), 'fa fa-download', array(
                                    'title' => 'Skini ugovor'
                                ));
                                ?>                            
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