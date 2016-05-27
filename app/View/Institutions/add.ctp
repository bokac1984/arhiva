

<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Dodavanje institucije</h2>
            </div>
        </div>        
        <div class="row">
            <div class="col-sm-12">
                <div class="institutions form">
                    <?php echo $this->Form->create('Institution'); ?>
                    <fieldset>
                        <legend><?php echo __('Add Institution'); ?></legend>
                        <?php
                        echo $this->Form->input('name');
                        echo $this->Form->input('description');
                        echo $this->Form->input('disk_location');
                        ?>
                    </fieldset>
                    <?php echo $this->Form->end(__('Submit')); ?>
                </div>
                <div class="actions">
                    <h3><?php echo __('Actions'); ?></h3>
                    <ul>

                        <li><?php echo $this->Html->link(__('List Institutions'), array('action' => 'index')); ?></li>
                        <li><?php echo $this->Html->link(__('List Contracts'), array('controller' => 'contracts', 'action' => 'index')); ?> </li>
                        <li><?php echo $this->Html->link(__('New Contract'), array('controller' => 'contracts', 'action' => 'add')); ?> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
