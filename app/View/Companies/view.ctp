<?php
//debug($company);
?>
<div class="row">
    <div class="col-md-12">
        <h2><?php echo h($company['Company']['name']); ?></h2>
    </div>
</div>
<?php if (!empty($company['PurchaseAgreement'])): ?>
<!--<div class="row">
    <div class="col-md-4">
        Ukupan iznos plaćenih ugovora: <?php debug($purchasePrice);echo $purchasePrice[0][0]['Suma']; ?>
    </div>
</div>-->
<?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <div class="related">
            <h4>Ugovori gdje se <b><?php echo __($company['Company']['name']); ?></b> pojavljuje kao <i>naručilac</i></h4>
            <?php if (!empty($company['PurchaseAgreement'])): ?>
                <table class="table" cellpadding = "0" cellspacing = "0">
                    <tr>
                        <th><?php echo __('Dobavljač'); ?></th>
                        <th><?php echo __('Ugovor'); ?></th>
                        <th><?php echo __('Iznos'); ?></th>
                        <th><?php echo __('Datum'); ?></th>
                        <th><?php echo __('Vrsta'); ?></th>
                        <th></th>
                    </tr>
                    <?php foreach ($company['PurchaseAgreement'] as $agreement): ?>
                        <tr>
                            <td>
                                <?php echo $this->Html->link($agreement['Supplier']['name'], 
                                        array('controller' => 'companies', 
                                            'action' => 'view', 'id' => $agreement['Supplier']['id'])); ?>
                            </td>                             
                            <td><?php echo $agreement['name']; ?></td>
                            <td><?php echo number_format($agreement['price'], 2, ',', '.'); ?></td>
                            <td><?php echo $this->Time->format($agreement['contract_date'], '%d.%m.%Y'); ?></td>
                            <td>
                                <?php echo $this->Html->link($agreement['AgreementType']['name'], array('controller' => 'agreement_types', 'action' => 'view', 'id' => $agreement['AgreementType']['id'])); ?>
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
                <h5><?php echo __('Nema ugovora kao naručilac'); ?></h5>
            <?php endif; ?>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="related">
            <h4>Ugovori gdje se <b><?php echo __($company['Company']['name']); ?></b> pojavljuje kao <i>dobavljač</i></h4>
            <?php if (!empty($company['SupplierAgreement'])): ?>
                <table  class="table" cellpadding = "0" cellspacing = "0">
                    <tr>
                        <th><?php echo __('Naručilac'); ?></th>
                        <th><?php echo __('Ugovor'); ?></th>
                        <th><?php echo __('Iznos'); ?></th>
                        <th><?php echo __('Datum'); ?></th>
                        <th><?php echo __('Vrsta'); ?></th>
                        <th></th>
                    </tr>
                    <?php foreach ($company['SupplierAgreement'] as $agreement): ?>
                        <tr>
                            <td>
                                <?php echo $this->Html->link($agreement['Purchase']['name'], 
                                        array('controller' => 'companies', 
                                            'action' => 'view', 'id' => $agreement['Purchase']['id'])); ?>
                            </td>                            
                            <td><?php echo $agreement['name']; ?></td>
                            <td><?php echo number_format($agreement['price'], 2, ',', '.'); ?></td>
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
                <h5><?php echo __('Nema ugovora kao dobavljač'); ?></h5>
            <?php endif; ?>
        </div>                
    </div>
</div>