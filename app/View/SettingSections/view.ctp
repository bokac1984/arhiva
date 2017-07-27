<div class="settingSections view">
<h2><?php echo __('Setting Section'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($settingSection['SettingSection']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($settingSection['SettingSection']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($settingSection['SettingSection']['active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Setting Section'), array('action' => 'edit', $settingSection['SettingSection']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Setting Section'), array('action' => 'delete', $settingSection['SettingSection']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $settingSection['SettingSection']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Setting Sections'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setting Section'), array('action' => 'add')); ?> </li>
	</ul>
</div>
