<div class="row contacts index">
    <div class="col-md-12">
        <table class="table table-condensed" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('name'); ?></th>
                    <th><?php echo $this->Paginator->sort('email'); ?></th>
                    <th><?php echo $this->Paginator->sort('message'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('ip'); ?></th>
                    <th><?php echo $this->Paginator->sort('sent'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?php echo h($contact['Contact']['id']); ?>&nbsp;</td>
                        <td><?php echo h($contact['Contact']['name']); ?>&nbsp;</td>
                        <td><?php echo h($contact['Contact']['email']); ?>&nbsp;</td>
                        <td><?php echo h($contact['Contact']['message']); ?>&nbsp;</td>
                        <td><?php echo h($contact['Contact']['created']); ?>&nbsp;</td>
                        <td><?php echo h($contact['Contact']['ip']); ?>&nbsp;</td>
                        <td><?php echo $this->Link->binaryState($contact['Contact']['sent']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('action' => 'view', $contact['Contact']['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contact['Contact']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contact['Contact']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $contact['Contact']['id']))); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
