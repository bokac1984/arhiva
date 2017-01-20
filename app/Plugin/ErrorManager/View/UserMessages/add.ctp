<div class="userMessages form">
<?php echo $this->Form->create('UserMessage'); ?>
	<fieldset>
		<legend><?php echo __('Add User Message'); ?></legend>
	<?php
		echo $this->Form->input('message');
		echo $this->Form->input('display');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List User Messages'), array('action' => 'index')); ?></li>
	</ul>
</div>
