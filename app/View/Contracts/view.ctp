

<div class="row">
    <div class="col-md-12">
        <p>
            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
            <?php
            echo $this->Html->link('Uredi', array(
                'controller' => 'contracts',
                'action' => 'edit',
                $contract['Contract']['id']
                    ), array(
                'class' => 'btn btn-primary',
                'role' => 'button'
            ));
            ?>
            <?php
            echo $this->Html->link('Pregled svih', array(
                'controller' => 'institutions',
                'action' => 'view',
                $contract['Institution']['id']
                    ), array(
                'class' => 'btn btn-primary',
                'role' => 'button'
            ));
            ?>                
        </p>
    </div>
</div>        
<div class="row">
    <div class="col-sm-12">
        <div class="contracts view">
            <dl>
                <dt><?php echo __('Id'); ?></dt>
                <dd>
                    <?php echo h($contract['Contract']['id']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Institution'); ?></dt>
                <dd>
                    <?php echo $this->Html->link($contract['Institution']['name'], array('controller' => 'institutions', 'action' => 'view', $contract['Institution']['id'])); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Name'); ?></dt>
                <dd>
                    <?php echo h($contract['Contract']['name']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Datum'); ?></dt>
                <dd>
                    <?php echo h($contract['Contract']['datum']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Price'); ?></dt>
                <dd>
                    <?php echo h($contract['Contract']['price']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('File Location'); ?></dt>
                <dd>
                    <?php echo h($contract['Contract']['file_location']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Original Name'); ?></dt>
                <dd>
                    <?php echo h($contract['Contract']['original_name']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('New File Name'); ?></dt>
                <dd>
                    <?php echo h($contract['Contract']['new_file_name']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('File Size'); ?></dt>
                <dd>
                    <?php echo h($contract['Contract']['file_size']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Created'); ?></dt>
                <dd>
                    <?php echo h($contract['Contract']['created']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Modified'); ?></dt>
                <dd>
<?php echo h($contract['Contract']['modified']); ?>
                    &nbsp;
                </dd>
            </dl>
        </div>
    </div>
</div>        
