<div class="fileUploads index">
	<h2><?php echo __('File Uploads'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('filename'); ?></th>
			<th><?php echo $this->Paginator->sort('contractor'); ?></th>
			<th><?php echo $this->Paginator->sort('author'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('path'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($fileUploads as $fileUpload): ?>
	<tr>
		<td><?php echo h($fileUpload['FileUpload']['id']); ?>&nbsp;</td>
		<td><?php echo h($fileUpload['FileUpload']['filename']); ?>&nbsp;</td>
		<td><?php echo h($fileUpload['FileUpload']['contractor']); ?>&nbsp;</td>
		<td><?php echo h($fileUpload['FileUpload']['author']); ?>&nbsp;</td>
		<td><?php echo h($fileUpload['FileUpload']['date']); ?>&nbsp;</td>
		<td><?php echo h($fileUpload['FileUpload']['price']); ?>&nbsp;</td>
		<td><?php echo h($fileUpload['FileUpload']['path']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $fileUpload['FileUpload']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $fileUpload['FileUpload']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fileUpload['FileUpload']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $fileUpload['FileUpload']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New File Upload'), array('action' => 'add')); ?></li>
	</ul>
</div>
