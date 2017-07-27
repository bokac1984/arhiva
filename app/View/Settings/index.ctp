<div class="row">
    <div class="col-md-12">
        <?php
        echo $this->Html->link(
                'Dodaj novi', array('controller' => 'settings', 'action' => 'add')
                , array('class' => 'btn btn-primary')
        );
        ?>
    </div>
</div>
<div class="row settings index">
    <div class="col-md-12">
        <table class="table table-condensed" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('setting_section_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('name'); ?></th>
                    <th><?php echo $this->Paginator->sort('value'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($settings as $setting): ?>
                    <tr>
                        <td><?php echo h($setting['Setting']['id']); ?>&nbsp;</td>
                        <td>
                            <?php echo $this->Html->link($setting['SettingSection']['name'], array('controller' => 'setting_sections', 'action' => 'view', $setting['SettingSection']['id'])); ?>
                        </td>
                        <td><?php echo h($setting['Setting']['name']); ?>&nbsp;</td>
                        <td><?php echo h($setting['Setting']['value']); ?>&nbsp;</td>
                        <?php
                        echo $this->element('actions', array(
                            'data' => $setting['Setting']
                        ));
                        ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->element('pagination'); ?>
    </div>
</div>
