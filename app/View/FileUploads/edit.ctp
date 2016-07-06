<div class="fileUploads form">
<?php echo $this->Form->create('FileUpload'); ?>
	<fieldset>
		<legend><?php echo __('Edit File Upload'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('filename');
		echo $this->Form->input('contractor');
		echo $this->Form->input('author');
		echo $this->Form->input('date');
		echo $this->Form->input('price');
		echo $this->Form->input('path');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FileUpload.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('FileUpload.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List File Uploads'), array('action' => 'index')); ?></li>
	</ul>
</div>
