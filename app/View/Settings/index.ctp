<?php ?>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#email" aria-controls="home" role="tab" data-toggle="tab">Email</a>
                </li>
                <li role="presentation" class="">
                    <a href="#debug-level" aria-controls="home" role="tab" data-toggle="tab">Debug level</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="email">
                    <table class="table table-condensed" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th><?php echo $this->Paginator->sort('settings_name'); ?></th>
                                <th><?php echo $this->Paginator->sort('settings_value'); ?></th>
                                <th class="actions"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($settings as $setting): ?>
                                <tr>
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
                </div>                 
                <div role="tabpanel" class="tab-pane" id="debug-level">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            echo $this->Form->create(false);
                            $this->Form->inputDefaults(array(
                                'error' => array(
                                    'attributes' => array(
                                        'wrap' => 'div',
                                        'class' => 'label label-warning'
                                    )
                                ),
                                'div' => 'form-group',
                                'class' => 'form-control'
                                    )
                            );
                            echo $this->Form->input('debugLevel', array(
                                'options' => array(0, 1, 2),
                                'empty' => '(choose one)',
                                'selected' => $debugLevel
                            ));
                            ?>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-6">
                                    <button class="btn btn-blue btn-block" type="submit"> 
                                        Sačuvaj <i class="fa fa-arrow-circle-right"></i> 
                                    </button>
                                </div>
                            </div>                    
                            <?php echo $this->Form->end(); ?>    
                        </div>
                    </div>

                </div>               
            </div>
    </div>
</div>

