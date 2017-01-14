<?php
//debug($agreements);
?>
<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
<div class="agreements index">
	<h2><?php echo __('Agreements'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('contract_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('path'); ?></th>
			<th><?php echo $this->Paginator->sort('new_filename'); ?></th>
			<th><?php echo $this->Paginator->sort('disk_location'); ?></th>
			<th><?php echo $this->Paginator->sort('downloaded'); ?></th>
			<th><?php echo $this->Paginator->sort('display'); ?></th>
			<th><?php echo $this->Paginator->sort('agreement_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('purchase_id'); ?></th>
			<th><?php echo $this->Paginator->sort('supplier_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($agreements as $agreement): ?>
	<tr>
		<td><?php echo h($agreement['Agreement']['id']); ?>&nbsp;</td>
		<td><?php echo h($agreement['Agreement']['name']); ?>&nbsp;</td>
		<td><?php echo h($agreement['Agreement']['price']); ?>&nbsp;</td>
		<td><?php echo h($agreement['Agreement']['contract_date']); ?>&nbsp;</td>
		<td><?php echo h($agreement['Agreement']['created']); ?>&nbsp;</td>
		<td><?php echo h($agreement['Agreement']['modified']); ?>&nbsp;</td>
		<td><?php echo h($agreement['Agreement']['path']); ?>&nbsp;</td>
		<td><?php echo h($agreement['Agreement']['new_filename']); ?>&nbsp;</td>
		<td><?php echo h($agreement['Agreement']['disk_location']); ?>&nbsp;</td>
		<td><?php echo h($agreement['Agreement']['downloaded']); ?>&nbsp;</td>
		<td><?php echo h($agreement['Agreement']['display']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($agreement['AgreementType']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['AgreementType']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($agreement['Purchase']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['Purchase']['id'])); ?>
		</td>    
		<td>
			<?php echo $this->Html->link($agreement['Supplier']['name'], array('controller' => 'agreement_types', 'action' => 'view', $agreement['Purchase']['id'])); ?>
		</td>                  
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $agreement['Agreement']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $agreement['Agreement']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $agreement['Agreement']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $agreement['Agreement']['id']))); ?>
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
            </div>
        </div>
    </div>
</section>
