<div class="contracts index">
	<h2><?php echo __('Contracts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('institution_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('datum'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('file_location'); ?></th>
			<th><?php echo $this->Paginator->sort('original_name'); ?></th>
			<th><?php echo $this->Paginator->sort('new_file_name'); ?></th>
			<th><?php echo $this->Paginator->sort('file_size'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($contracts as $contract): ?>
	<tr>
		<td><?php echo h($contract['Contract']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($contract['Institution']['name'], array('controller' => 'institutions', 'action' => 'view', $contract['Institution']['id'])); ?>
		</td>
		<td><?php echo h($contract['Contract']['name']); ?>&nbsp;</td>
		<td><?php echo h($contract['Contract']['datum']); ?>&nbsp;</td>
		<td><?php echo h($contract['Contract']['price']); ?>&nbsp;</td>
		<td><?php echo h($contract['Contract']['file_location']); ?>&nbsp;</td>
		<td><?php echo h($contract['Contract']['original_name']); ?>&nbsp;</td>
		<td><?php echo h($contract['Contract']['new_file_name']); ?>&nbsp;</td>
		<td><?php echo h($contract['Contract']['file_size']); ?>&nbsp;</td>
		<td><?php echo h($contract['Contract']['created']); ?>&nbsp;</td>
		<td><?php echo h($contract['Contract']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $contract['Contract']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contract['Contract']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contract['Contract']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $contract['Contract']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Contract'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('controller' => 'institutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('controller' => 'institutions', 'action' => 'add')); ?> </li>
	</ul>
</div>
