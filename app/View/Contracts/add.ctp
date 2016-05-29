<div class="contracts form">
<?php echo $this->Form->create('Contract'); ?>
	<fieldset>
		<legend><?php echo __('Add Contract'); ?></legend>
	<?php
		echo $this->Form->input('institution_id');
		echo $this->Form->input('name');
		echo $this->Form->input('datum');
		echo $this->Form->input('price');
		echo $this->Form->input('file_location');
		echo $this->Form->input('original_name');
		echo $this->Form->input('new_file_name');
		echo $this->Form->input('file_size');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Contracts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('controller' => 'institutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('controller' => 'institutions', 'action' => 'add')); ?> </li>
	</ul>
</div>
