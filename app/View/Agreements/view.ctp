<div class="row agreements view">
    <div class="col-md-12">
    <h2><?php echo __('Agreement'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Price'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['price']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Contract Date'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['contract_date']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['modified']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Path'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['path']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Old Path'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['old_path']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Original Price'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['original_price']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Size'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['size']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('New File Name'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['new_file_name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('File Location'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['file_location']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Old File Location'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['old_file_location']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Downloaded'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['downloaded']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Display'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['display']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Agreement Type'); ?></dt>
        <dd>
            <?php echo $this->Html->link($agreement['AgreementType']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['AgreementType']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Purchase'); ?></dt>
        <dd>
            <?php echo $this->Html->link($agreement['Purchase']['name'], array('controller' => 'companies', 'action' => 'view', $agreement['Purchase']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Supplier'); ?></dt>
        <dd>
            <?php echo $this->Html->link($agreement['Supplier']['name'], array('controller' => 'companies', 'action' => 'view', $agreement['Supplier']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Dvd'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['dvd']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Old Purchaser Id'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['old_purchaser_id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Old Supplier Id'); ?></dt>
        <dd>
            <?php echo h($agreement['Agreement']['old_supplier_id']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Agreement'), array('action' => 'edit', $agreement['Agreement']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Agreement'), array('action' => 'delete', $agreement['Agreement']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $agreement['Agreement']['id']))); ?> </li>
        <li><?php echo $this->Html->link(__('List Agreements'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Agreement'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Agreement Types'), array('controller' => 'agreement_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Agreement Type'), array('controller' => 'agreement_types', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Purchase'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
    </ul>
</div>
