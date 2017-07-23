<?php
//debug($company);
?>
<div class="row hidden">
    <div class="col-md-12">
        <?php echo '<pre>';
        print_r($company);
        echo '</pre>'; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h2 class="center"><?php echo h($company['Company']['name']); ?></h2>
    </div>
</div>
<?php if (!empty($company['PurchaseAgreement'])): ?>
    <div class="row">
        <div class="col-md-12">
            <h4>Ugovori gdje se <b><?php echo __($company['Company']['name']); ?></b> pojavljuje kao <i>naručilac</i></h4>
            <p>Ukupan iznos ugovora: <b><?php echo number_format($purchasePrice['Suma'], 2, ',', '.'); ?> KM</b></p>
            <p>Broj  ugovora: <b><?php echo $purchasePrice['brojUgovora']; ?></b></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="related">
                <table id="narucilac" class="table table-hover table-condensed" cellpadding = "0" cellspacing = "0">
                    <tr>
                        <th><?php echo __('Dobavljač'); ?></th>
                        <th><?php echo __('Ugovor'); ?></th>
                        <th><?php echo __('Postupak'); ?></th>                        
                        <th><?php echo __('Iznos'); ?></th>
                        <th><?php echo __('Datum'); ?></th>
                        <?php if ($admin): ?>
                        <th><?php echo __('Akcije'); ?></th>
                        <?php endif; ?>                        
                        <th></th>
                    </tr>
                            <?php foreach ($company['PurchaseAgreement'] as $agreement): ?>
                        <tr>
                            <td>
                                <?php
                                echo $this->Html->link($agreement['Supplier']['name'], array('controller' => 'companies',
                                    'action' => 'view', 'id' => $agreement['Supplier']['id']));
                                ?>
                            </td>                             
                            <td><?php echo $agreement['name']; ?></td>
                            <td>
                                <?php echo $this->Html->link($agreement['AgreementType']['name'], array('controller' => 'agreement_types', 'action' => 'view', 'id' => $agreement['AgreementType']['id'])); ?>
                            </td>                             
                            <td><?php echo number_format($agreement['price'], 2, ',', '.'); ?></td>
                            <td><?php echo $this->Time->format($agreement['contract_date'], '%d.%m.%Y'); ?></td>                         
                            <td>
                                <?php
                                echo $this->Link->cLink(__(''), array(
                                    'controller' => 'agreements',
                                    'action' => 'sendFile',
                                    'filename' => $agreement['new_file_name']), 'fa fa-download', array(
                                    'title' => 'Skini ugovor'
                                        )
                                );
                                ?>                            
                            </td>  
                            <?php if ($admin): ?>
                            <td class="actions">
                                <?php
                                echo $this->Link->cLink(__(''), array('controller' => 'agreements','action' => 'view', $agreement['id']), 'fa fa-eye', array(
                                    'title' => 'Pregledaj ugovor'
                                ));
                                ?>
                                <?php
                                echo $this->Link->cLink(__(''), array('controller' => 'agreements','action' => 'edit', $agreement['id']), 'fa fa-edit', array(
                                    'title' => 'Uredi'
                                ));
                                ?>
                                <?php echo $this->Link->dLink("", array('controller' => 'agreements','action' => 'delete', $agreement['id']), 'fa fa-trash-o', $agreement['id']); ?>
                            </td> 
                            <?php endif; ?>                               
                        </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-md-8">
            <h5><i class="clip-info"></i> <?php echo __('Nema ugovora kao naručilac'); ?></h5>
        </div>
    </div>

<?php endif; ?>
<hr>
<?php if (!empty($company['SupplierAgreement'])): ?>
    <div class="row">
        <div class="col-md-12">
            <h4>Ugovori gdje se <b><?php echo __($company['Company']['name']); ?></b> pojavljuje kao <i>dobavljač</i></h4>
            <p>Ukupan iznos ugovora: <b><?php echo number_format($supplierPrice['Suma'], 2, ',', '.'); ?> KM</b></p>
            <p>Broj  ugovora: <b><?php echo $supplierPrice['brojUgovora']; ?></b></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="related">
                <table  class="table" cellpadding = "0" cellspacing = "0">
                    <tr>
                        <th><?php echo __('Naručilac'); ?></th>
                        <th><?php echo __('Ugovor'); ?></th>
                        <th><?php echo __('Postupak'); ?></th>
                        <th><?php echo __('Iznos'); ?></th>
                        <th><?php echo __('Datum'); ?></th>
                        <?php if ($admin): ?>
                        <th><?php echo __('Akcije'); ?></th>
                        <?php endif; ?>
                        <th></th>
                    </tr>
                    <?php foreach ($company['SupplierAgreement'] as $agreement): ?>
                        <tr>
                            <td>
                                <?php
                                echo $this->Html->link($agreement['Purchase']['name'], array('controller' => 'companies',
                                    'action' => 'view', 'id' => $agreement['Purchase']['id']));
                                ?>
                            </td>                            
                            <td><?php echo $agreement['name']; ?></td>
                            <td>
        <?php echo $this->Html->link($agreement['AgreementType']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['AgreementType']['id'])); ?>
                            </td>                            
                            <td><?php echo number_format($agreement['price'], 2, ',', '.'); ?></td>
                            <td><?php echo $this->Time->format($agreement['contract_date'], '%d.%m.%Y'); ?></td>
                            <td>
                                <?php
                                echo $this->Link->cLink(__(''), array(
                                    'controller' => 'agreements',
                                    'action' => 'sendFile',
                                    'filename' => $agreement['new_file_name']), 'fa fa-download', array(
                                    'title' => 'Skini ugovor'
                                        )
                                );
                                ?>                            
                            </td>
                            <?php if ($admin): ?>
                            <td class="actions">
                                <?php
                                echo $this->Link->cLink(__(''), array('controller' => 'agreements','action' => 'view', $agreement['Agreement']['id']), 'fa fa-eye', array(
                                    'title' => 'Pregledaj ugovor'
                                ));
                                ?>
                                <?php
                                echo $this->Link->cLink(__(''), array('controller' => 'agreements','action' => 'edit', $agreement['Agreement']['id']), 'fa fa-edit', array(
                                    'title' => 'Uredi'
                                ));
                                ?>
                                <?php echo $this->Link->dLink("", array('controller' => 'agreements','action' => 'delete', $agreement['Agreement']['id']), 'fa fa-trash-o', $agreement['Agreement']['id']); ?>
                            </td> 
                            <?php endif; ?>                            
                        </tr>
    <?php endforeach; ?>
                </table>
            </div>                
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-md-8">
            <h5><i class="clip-info"></i> <?php echo __('Nema ugovora kao dobavljač'); ?></h5>
        </div>
    </div>

<?php endif; ?>