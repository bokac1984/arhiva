<?php

?>
<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <p>
                <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                <?php echo $this->Html->link('Nova institucija', array(
                    'controller' => 'institutions',
                    'action' => 'add'
                ), array(
                    'class' => 'btn btn-primary',
                    'role' => 'button'
                )); ?>
            </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="institutions index">
                    <table cellpadding="0" cellspacing="0" class="table table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo $this->Paginator->sort('id'); ?></th>
                                <th><?php echo $this->Paginator->sort('name'); ?></th>
                                <th><?php echo $this->Paginator->sort('description'); ?></th>
                                <th><?php echo $this->Paginator->sort('created'); ?></th>
                                <th><?php echo $this->Paginator->sort('modified'); ?></th>
                                <th class="actions"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($institutions as $institution): ?>
                                <tr>
                                    <td><?php echo h($institution['Institution']['id']); ?>&nbsp;</td>
                                    <td><?php echo h($institution['Institution']['name']); ?>&nbsp;</td>
                                    <td><?php echo h($institution['Institution']['description']); ?>&nbsp;</td>
                                    <td><?php echo h($institution['Institution']['created']); ?>&nbsp;</td>
                                    <td><?php echo h($institution['Institution']['modified']); ?>&nbsp;</td>
                                    <td class="actions">
                                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $institution['Institution']['id'])); ?>
                                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $institution['Institution']['id'])); ?>
                                        <?php echo $this->Html->link(__('Dodaj ugovor'), array('action' => 'contract', $institution['Institution']['id'])); ?>
                                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $institution['Institution']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $institution['Institution']['id']))); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php echo $this->element('pagination'); ?>
                </div>
                <div class="actions">
                    <h3><?php echo __('Actions'); ?></h3>
                    <ul>
                        <li><?php echo $this->Html->link(__('New Contract'), array('controller' => 'institutions', 'action' => 'contract', $institution['Institution']['id'])); ?> </li>
                    </ul>
                </div>
        </div>
    </div>
</div>
</section>

