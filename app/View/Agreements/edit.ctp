<div class="agreements form">
    <?php echo $this->Form->create('Agreement'); ?>
    <fieldset>
        <legend><?php echo __('Edit Agreement'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name');
        echo $this->Form->input('price');
        echo $this->Form->input('contract_date');
        echo $this->Form->input('path');
        echo $this->Form->input('new_filename');
        echo $this->Form->input('disk_location');
        echo $this->Form->input('downloaded');
        echo $this->Form->input('display');
        echo $this->Form->input('agreement_type_id');
        echo $this->Form->input('purchase_id');
        echo $this->Form->input('supplier_id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Agreement.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Agreement.id')))); ?></li>
        <li><?php echo $this->Html->link(__('List Agreements'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Agreement Types'), array('controller' => 'agreement_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Agreement Type'), array('controller' => 'agreement_types', 'action' => 'add')); ?> </li>
    </ul>
</div>
