<div class="agreementTypes form">
<?php echo $this->Form->create('AgreementType'); ?>
	<fieldset>
		<legend><?php echo __('Add Agreement Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Agreement Types'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Agreements'), array('controller' => 'agreements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agreement'), array('controller' => 'agreements', 'action' => 'add')); ?> </li>
	</ul>
</div>
