<div class="row">
    <div class="col-md-12">
        <div class="agreementTypes view">
            <h2><?php echo h($agreementType['AgreementType']['name']); ?></h2>
        </div>
        <div class="related">
            <h4><?php echo __('Ugovori sa ovom vrstom postupka'); ?></h4>
            <?php if (!empty($agreementType['Agreement'])): ?>
                <table class="table" cellpadding = "0" cellspacing = "0">
                    <tr>
                        <th><?php echo __('Naručilac'); ?></th>
                        <th><?php echo __('Ugovor'); ?></th>
                        <th><?php echo __('Iznos'); ?></th>
                        <th><?php echo __('Datum'); ?></th>
                        <th><?php echo __('Dobavljač'); ?></th>
                        <th class="actions"></th>
                    </tr>
                    <?php foreach ($agreementType['Agreement'] as $agreement): ?>
                        <tr>
                            <td>
                                <?php echo $this->Html->link($agreement['Purchase']['name'], 
                                        array('controller' => 'companies', 
                                            'action' => 'view', 
                                            'id' => $agreement['Purchase']['id']
                                        )); ?>
                            </td>                            
                            <td><?php echo $agreement['name']; ?></td>
                            <td><?php echo number_format($agreement['price'], 2, ',', '.'); ?></td>
                            <td><?php echo $this->Time->format($agreement['contract_date'], '%d.%m.%Y'); ?></td>
                            <td>
                                <?php echo $this->Html->link($agreement['Supplier']['name'], 
                                        array('controller' => 'companies', 
                                            'action' => 'view', 
                                            'id' => $agreement['Supplier']['id']
                                        )); ?>
                            </td>
                            <td>
                                <?php
                                echo $this->Link->cLink(__(''), 
                                    array(
                                        'controller' => 'agreements',
                                        'action' => 'sendFile', 
                                        'filename' => $agreement['new_file_name']), 
                                    'fa fa-download', 
                                    array(
                                        'title' => 'Skini ugovor'
                                    )
                                );
                                ?>                            
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>