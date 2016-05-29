<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="institutions view">
                    <h2><?php echo __('Institution'); ?></h2>
                    <dl>
                        <dt><?php echo __('Id'); ?></dt>
                        <dd>
                            <?php echo h($institution['Institution']['id']); ?>
                            &nbsp;
                        </dd>
                        <dt><?php echo __('Name'); ?></dt>
                        <dd>
                            <?php echo h($institution['Institution']['name']); ?>
                            &nbsp;
                        </dd>
                        <dt><?php echo __('Description'); ?></dt>
                        <dd>
                            <?php echo h($institution['Institution']['description']); ?>
                            &nbsp;
                        </dd>
                        <dt><?php echo __('Created'); ?></dt>
                        <dd>
                            <?php echo h($institution['Institution']['created']); ?>
                            &nbsp;
                        </dd>
                        <dt><?php echo __('Modified'); ?></dt>
                        <dd>
                            <?php echo h($institution['Institution']['modified']); ?>
                            &nbsp;
                        </dd>
                        <dt><?php echo __('Disk Location'); ?></dt>
                        <dd>
                            <?php echo h($institution['Institution']['disk_location']); ?>
                            &nbsp;
                        </dd>
                    </dl>
                </div>
                <div class="actions">
                    <h3><?php echo __('Actions'); ?></h3>
                    <ul>
                        <li><?php echo $this->Html->link(__('Edit Institution'), array('action' => 'edit', $institution['Institution']['id'])); ?> </li>
                        <li><?php echo $this->Form->postLink(__('Delete Institution'), array('action' => 'delete', $institution['Institution']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $institution['Institution']['id']))); ?> </li>
                        <li><?php echo $this->Html->link(__('List Institutions'), array('action' => 'index')); ?> </li>
                        <li><?php echo $this->Html->link(__('New Institution'), array('action' => 'add')); ?> </li>
                        <li><?php echo $this->Html->link(__('List Contracts'), array('controller' => 'contracts', 'action' => 'index')); ?> </li>
                        <li><?php echo $this->Html->link(__('New Contract'), array('controller' => 'contracts', 'action' => 'add')); ?> </li>
                    </ul>
                </div>
                <div class="related">
                    <h3><?php echo __('Related Contracts'); ?></h3>
                    <?php if (!empty($institution['Contract'])): ?>
                        <table cellpadding = "0" cellspacing = "0" class="table table-condensed">
                            <tr>
                                <th><?php echo __('Name'); ?></th>
                                <th><?php echo __('Datum'); ?></th>
                                <th><?php echo __('Price'); ?></th>
                                <th><?php echo __('Created'); ?></th>
                                <th><?php echo __('Modified'); ?></th>
                                <th class="actions"><?php echo __('Actions'); ?></th>
                            </tr>
                            <?php foreach ($institution['Contract'] as $contract): ?>
                                <tr>
                                    <td><?php echo $contract['name']; ?></td>
                                    <td><?php echo $contract['datum']; ?></td>
                                    <td><?php echo $contract['price']; ?></td>
                                    <td><?php echo $contract['created']; ?></td>
                                    <td><?php echo $contract['modified']; ?></td>
                                    <td class="actions">
                                        <?php echo $this->Html->link(__('View'), array('controller' => 'contracts', 'action' => 'view', $contract['id'])); ?>
                                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'contracts', 'action' => 'edit', $contract['id'])); ?>
                                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'contracts', 'action' => 'delete', $contract['id']), array('confirm' => __('Are you sure you want to delete # %s?', $contract['id']))); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>

                    <div class="actions">
                        <?php
                        echo $this->Html->link(__('New Contract'), array('controller' => 'institutions', 'action' => 'contract', $institution['Institution']['id']), array(
                            'class' => 'btn btn-green',
                            'role' => 'button'
                                )
                        );
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
