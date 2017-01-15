<div class="row">
    <div class="col-md-12">
        <div class="agreementTypes view">
            <h2><?php echo h($agreementType['AgreementType']['name']); ?></h2>
        </div>
        <div class="related">
            <h4><?php echo __('Ugovori sa ovom vrstom postupka'); ?></h4>
            <?php if (!empty($agreementType['Agreement'])): ?>
                <table cellpadding = "0" cellspacing = "0">
                    <tr>
                        <th><?php echo __('Name'); ?></th>
                        <th><?php echo __('Price'); ?></th>
                        <th><?php echo __('Contract Date'); ?></th>
                        <th><?php echo __('Purchase Id'); ?></th>
                        <th><?php echo __('Supplier Id'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    <?php foreach ($agreementType['Agreement'] as $agreement): ?>
                        <tr>
                            <td><?php echo $agreement['name']; ?></td>
                            <td><?php echo $agreement['price']; ?></td>
                            <td><?php echo $agreement['contract_date']; ?></td>
                            <td>
                                <?php echo $this->Html->link($agreement['Purchase']['name'], array('controller' => 'companies', 'action' => 'view', $agreement['Purchase']['id'])); ?>
                            </td>
                            <td>
                                <?php echo $this->Html->link($agreement['Supplier']['name'], array('controller' => 'companies', 'action' => 'view', $agreement['Supplier']['id'])); ?>
                            </td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('View'), array('controller' => 'agreements', 'action' => 'view', $agreement['id'])); ?>
                                <?php echo $this->Html->link(__('Edit'), array('controller' => 'agreements', 'action' => 'edit', $agreement['id'])); ?>
                                <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'agreements', 'action' => 'delete', $agreement['id']), array('confirm' => __('Are you sure you want to delete # %s?', $agreement['id']))); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>

            <div class="actions">
                <ul>
                    <li><?php echo $this->Html->link(__('New Agreement'), array('controller' => 'agreements', 'action' => 'add')); ?> </li>
                </ul>
            </div>
        </div>
    </div>
</div>