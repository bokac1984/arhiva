<div class="fileUploads view">
<h2><?php echo __('File Upload'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($fileUpload['FileUpload']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($fileUpload['FileUpload']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contractor'); ?></dt>
		<dd>
			<?php echo h($fileUpload['FileUpload']['contractor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Author'); ?></dt>
		<dd>
			<?php echo h($fileUpload['FileUpload']['author']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($fileUpload['FileUpload']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($fileUpload['FileUpload']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path'); ?></dt>
		<dd>
			<?php echo h($fileUpload['FileUpload']['path']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit File Upload'), array('action' => 'edit', $fileUpload['FileUpload']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete File Upload'), array('action' => 'delete', $fileUpload['FileUpload']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $fileUpload['FileUpload']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List File Uploads'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New File Upload'), array('action' => 'add')); ?> </li>
	</ul>
</div>
