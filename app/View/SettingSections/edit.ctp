<div class="settingSections form">
<?php echo $this->Form->create('SettingSection'); ?>
	<fieldset>
		<legend><?php echo __('Edit Setting Section'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SettingSection.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('SettingSection.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Setting Sections'), array('action' => 'index')); ?></li>
	</ul>
</div>
