<?php 
$this->startIfEmpty('maintitle');
echo $this->element('titles', array('maintitle' => 'Error Log', 'subtitle' => 'Display info about error log'));
$this->end();
$this->Html->addCrumb('View All Logs', array('plugin' => 'error_manager', 'controller' => 'error_logs', 'action' => 'index'));
echo $this->Html->css('errormanager/errormanager', null, array('inline' => false));
echo $this->Html->css('errormanager/popup', null, array('inline' => false));
echo $this->Html->script('error/errors', array('block'=>'scriptBottom'));
?>
<div class="errorLogs view">
<table class="error-log-table">
  <tr class="first-row">
    <th>Occured on</th>
    <td><?php echo $this->Time->nice($errorLog['ErrorLog']['created'], 'Europe/Belgrade'); ?></td>
  </tr>
  <tr class="first-row">
    <th>Type</th>
    <td><?php echo h($errorLog['ErrorLog']['type']); ?></td>
  </tr>
  <tr class="first-row">
    <th>Port</th>
    <td><?php echo h($errorLog['ErrorLog']['port']); ?></td>
  </tr>
  <tr class="first-row">
    <th>Method</th>
    <td><?php echo h($errorLog['ErrorLog']['method']); ?></td>
  </tr>
  <tr class="first-row">
    <th>IP</th>
    <td><span id="search-address"><?php echo h($errorLog['ErrorLog']['ip']); ?></span>&nbsp;<i id="ip-address" title="Locate" class="fa fa-globe red-globe"></i></td>
  </tr>
</table>
	<dl>
		<dt><?php echo __('Error'); ?></dt>
		<dd>
			<?php echo h($errorLog['ErrorLog']['error']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Agent'); ?></dt>
		<dd>
			<?php echo h($errorLog['ErrorLog']['user_agent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($errorLog['ErrorLog']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path'); ?></dt>
		<dd>
			<?php echo h($errorLog['ErrorLog']['path']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Query String'); ?></dt>
		<dd>
			<?php echo h($errorLog['ErrorLog']['query_string']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Error Log'), array('action' => 'edit', $errorLog['ErrorLog']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Error Log'), array('action' => 'delete', $errorLog['ErrorLog']['id']), null, __('Are you sure you want to delete # %s?', $errorLog['ErrorLog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Error Logs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Error Log'), array('action' => 'add')); ?> </li>
	</ul>
</div>
