<div class="companies view">
<h2><?php echo __('Company'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($company['Company']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($company['Company']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($company['Company']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($company['Company']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($company['Company']['type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Company'), array('action' => 'edit', $company['Company']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Company'), array('action' => 'delete', $company['Company']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $company['Company']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Agreements'), array('controller' => 'agreements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agreement'), array('controller' => 'agreements', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Agreements'); ?></h3>
	<?php if (!empty($company['Agreement'])): ?>
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
	<?php foreach ($company['Agreement'] as $agreement): ?>
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
