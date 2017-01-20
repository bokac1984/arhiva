<div class="userMessages index">
	<h2><?php echo __('User Messages'); ?></h2>
    <table class="table table-condensed table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('message'); ?></th>
			<th><?php echo $this->Paginator->sort('display'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userMessages as $userMessage): ?>
	<tr>
		<td><?php echo h($userMessage['UserMessage']['id']); ?>&nbsp;</td>
		<td><?php echo h($userMessage['UserMessage']['message']); ?>&nbsp;</td>
		<td><?php echo h($userMessage['UserMessage']['display']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userMessage['UserMessage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userMessage['UserMessage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userMessage['UserMessage']['id']), null, __('Are you sure you want to delete # %s?', $userMessage['UserMessage']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
<?php echo $this->element('pagination'); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User Message'), array('action' => 'add')); ?></li>
	</ul>
</div>
