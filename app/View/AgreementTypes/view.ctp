<div class="agreementTypes view">
<h2><?php echo __('Agreement Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($agreementType['AgreementType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($agreementType['AgreementType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($agreementType['AgreementType']['active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Agreement Type'), array('action' => 'edit', $agreementType['AgreementType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Agreement Type'), array('action' => 'delete', $agreementType['AgreementType']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $agreementType['AgreementType']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Agreement Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agreement Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Agreements'), array('controller' => 'agreements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agreement'), array('controller' => 'agreements', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Agreements'); ?></h3>
	<?php if (!empty($agreementType['Agreement'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Contract Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Path'); ?></th>
		<th><?php echo __('New Filename'); ?></th>
		<th><?php echo __('Disk Location'); ?></th>
		<th><?php echo __('Downloaded'); ?></th>
		<th><?php echo __('Display'); ?></th>
		<th><?php echo __('Agreement Type Id'); ?></th>
		<th><?php echo __('Purchase Id'); ?></th>
		<th><?php echo __('Supplier Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($agreementType['Agreement'] as $agreement): ?>
		<tr>
			<td><?php echo $agreement['id']; ?></td>
			<td><?php echo $agreement['name']; ?></td>
			<td><?php echo $agreement['price']; ?></td>
			<td><?php echo $agreement['contract_date']; ?></td>
			<td><?php echo $agreement['created']; ?></td>
			<td><?php echo $agreement['modified']; ?></td>
			<td><?php echo $agreement['path']; ?></td>
			<td><?php echo $agreement['new_filename']; ?></td>
			<td><?php echo $agreement['disk_location']; ?></td>
			<td><?php echo $agreement['downloaded']; ?></td>
			<td><?php echo $agreement['display']; ?></td>
			<td><?php echo $agreement['agreement_type_id']; ?></td>
			<td><?php echo $agreement['purchase_id']; ?></td>
			<td><?php echo $agreement['supplier_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'agreements', 'action' => 'view', $agreement['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'agreements', 'action' => 'edit', $agreement['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'agreements', 'action' => 'delete', $agreement['id']), array('confirm' => __('Are you sure you want to delete # %s?', $agreement['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Agreement'), array('controller' => 'agreements', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
