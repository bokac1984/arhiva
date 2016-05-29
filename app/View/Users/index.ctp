
<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="users index">
                    <h2><?php echo __('Users'); ?></h2>
                    <table class="table table-bordered" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th><?php echo $this->Paginator->sort('username'); ?></th>
                                <th><?php echo $this->Paginator->sort('created'); ?></th>
                                <th><?php echo $this->Paginator->sort('modified'); ?></th>
                                <th><?php echo $this->Paginator->sort('first_name'); ?></th>
                                <th><?php echo $this->Paginator->sort('last_name'); ?></th>
                                <th class="actions"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                                    <td><?php echo h($user['User']['created']); ?>&nbsp;</td>
                                    <td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
                                    <td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
                                    <td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
                                    <td class="actions">
                                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
                                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
                                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
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
                        <li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>