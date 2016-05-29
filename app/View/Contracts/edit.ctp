<div class="contracts form">
<?php echo $this->Form->create('Contract'); ?>
	<fieldset>
		<legend><?php echo __('Edit Contract'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('institution_id');
		echo $this->Form->input('name');
		echo $this->Form->input('datum');
		echo $this->Form->input('price');
		echo $this->Form->input('file_location');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Contract.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Contract.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Contracts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('controller' => 'institutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('controller' => 'institutions', 'action' => 'add')); ?> </li>
	</ul>
</div>
