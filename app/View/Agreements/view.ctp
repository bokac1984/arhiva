<div class="agreements view">
<h2><?php echo __('Agreement'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contract Date'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['contract_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['path']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('New Filename'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['new_filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Disk Location'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['disk_location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Downloaded'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['downloaded']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Display'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['display']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Agreement Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($agreement['AgreementType']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['AgreementType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchase Id'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['purchase_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Supplier Id'); ?></dt>
		<dd>
			<?php echo h($agreement['Agreement']['supplier_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Agreement'), array('action' => 'edit', $agreement['Agreement']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Agreement'), array('action' => 'delete', $agreement['Agreement']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $agreement['Agreement']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Agreements'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agreement'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Agreement Types'), array('controller' => 'agreement_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agreement Type'), array('controller' => 'agreement_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
