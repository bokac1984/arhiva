<div class="settings form">
<?php echo $this->Form->create('Setting'); ?>
	<fieldset>
		<legend><?php echo __('Edit Setting'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('setting_section_id');
		echo $this->Form->input('name');
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Setting.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Setting.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Settings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Setting Sections'), array('controller' => 'setting_sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setting Section'), array('controller' => 'setting_sections', 'action' => 'add')); ?> </li>
	</ul>
</div>
