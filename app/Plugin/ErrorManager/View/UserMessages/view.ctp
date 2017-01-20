<div class="userMessages view">
<h2><?php  echo __('User Message'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userMessage['UserMessage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($userMessage['UserMessage']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Display'); ?></dt>
		<dd>
			<?php echo h($userMessage['UserMessage']['display']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Message'), array('action' => 'edit', $userMessage['UserMessage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Message'), array('action' => 'delete', $userMessage['UserMessage']['id']), null, __('Are you sure you want to delete # %s?', $userMessage['UserMessage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Messages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Message'), array('action' => 'add')); ?> </li>
	</ul>
</div>
