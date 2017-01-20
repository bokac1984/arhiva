<div class="errorLogs form">
<?php echo $this->Form->create('ErrorLog'); ?>
	<fieldset>
		<legend><?php echo __('Add Error Log'); ?></legend>
	<?php
		echo $this->Form->input('type');
		echo $this->Form->input('error');
		echo $this->Form->input('ip');
		echo $this->Form->input('user_agent');
		echo $this->Form->input('url');
		echo $this->Form->input('port');
		echo $this->Form->input('method');
		echo $this->Form->input('path');
		echo $this->Form->input('query_string');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Error Logs'), array('action' => 'index')); ?></li>
	</ul>
</div>
