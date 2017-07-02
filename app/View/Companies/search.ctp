<?php
echo $this->Html->css('search', array('block' => 'css'));
//echo $this->Html->css('/js/libs/editable/css/bootstrap-editable', array('block' => 'css'));
//echo $this->Html->script('/js/libs/editable/js/bootstrap-editable.min', array('block'=>'scriptBottom'));
//
//echo $this->Html->scriptBlock("$.fn.editable.defaults.mode = 'popup';", array('block'=>'scriptBottom'));
//echo $this->Html->script('/js/agreements/search', array('block' => 'scriptBottom'));
////echo $this->Html->scriptBlock("$.fn.editable.defaults.mode = 'popup';", array('block'=>'scriptBottom'));
//echo $this->Html->scriptBlock("searchFun.init(1);", array('block' => 'scriptBottom'));
//debug($agreements);
?>
<?php echo $this->element('search'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="companies index">
            <table class="table table-responsive table-hover search-table" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('name', 'Naziv'); ?></th>
                        <th><?php echo $this->Paginator->sort('id', '#'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($companies as $agreement): ?>
                        <tr>
                            <td><?php echo h($agreement['Company']['name']); ?>&nbsp;</td>
                            <td><?php echo h($agreement['Company']['id']); ?>&nbsp;</td>                                   
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo $this->element('pagination'); ?>
        </div>
    </div>
</div>