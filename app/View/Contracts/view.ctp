<div class="contracts view">
<h2><?php echo __('Contract'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($contract['Contract']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Institution'); ?></dt>
		<dd>
			<?php echo $this->Html->link($contract['Institution']['name'], array('controller' => 'institutions', 'action' => 'view', $contract['Institution']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($contract['Contract']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($contract['Contract']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($contract['Contract']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('File Location'); ?></dt>
		<dd>
			<?php echo h($contract['Contract']['file_location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($contract['Contract']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($contract['Contract']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contract'), array('action' => 'edit', $contract['Contract']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Contract'), array('action' => 'delete', $contract['Contract']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $contract['Contract']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Contracts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contract'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('controller' => 'institutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('controller' => 'institutions', 'action' => 'add')); ?> </li>
	</ul>
</div>
