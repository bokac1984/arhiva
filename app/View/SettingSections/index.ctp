<div class="row settingSections index">
    <div class="col-md-12">
        <table class="table table-condensed" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('name'); ?></th>
                    <th><?php echo $this->Paginator->sort('active'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($settingSections as $settingSection): ?>
                    <tr>
                        <td><?php echo h($settingSection['SettingSection']['id']); ?>&nbsp;</td>
                        <td><?php echo h($settingSection['SettingSection']['name']); ?>&nbsp;</td>
                        <td><?php echo h($settingSection['SettingSection']['active']); ?>&nbsp;</td>
                        <?php
                        echo $this->element('actions', array(
                            'data' => $settingSection['SettingSection']
                        ));
                        ?>
                    </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
<?php echo $this->element('pagination'); ?>
    </div>
</div>
<div class="actions">
    <?php echo $this->Html->link(__('New Setting Section'), array('action' => 'add'), array(
            'class' => 'btn btn-primary'
        )); ?>
</div>
