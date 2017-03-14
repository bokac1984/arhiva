<div class="row index">
    <div class="col-md-12">
        <h2><?php echo __('Settings'); ?></h2>
        <table class="table table-condensed" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('settings_section'); ?></th>
                    <th><?php echo $this->Paginator->sort('settings_name'); ?></th>
                    <th><?php echo $this->Paginator->sort('settings_value'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($settings as $setting): ?>
                    <tr>
                        <td><?php echo h($setting['Setting']['id']); ?>&nbsp;</td>
                        <td><?php echo h($setting['Setting']['settings_section']); ?>&nbsp;</td>
                        <td><?php echo h($setting['Setting']['settings_name']); ?>&nbsp;</td>
                        <td><?php echo h($setting['Setting']['settings_value']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('action' => 'view', $setting['Setting']['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $setting['Setting']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $setting['Setting']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $setting['Setting']['id']))); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->element('pagination'); ?>
    </div>
</div>