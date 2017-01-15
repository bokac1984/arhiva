<?php
echo $this->Html->script('/plugins/fancytree/lib/jquery-ui.custom', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/contextMenu/dist/jquery.ui.position.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/contextMenu/dist/jquery.contextMenu.min', array('block' => 'scriptBottom'));

echo $this->Html->script('/plugins/fancytree/dist/jquery.fancytree-all.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/institutions/index', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("inst.init(1);", array('block' => 'scriptBottom'));

echo $this->Html->css('/plugins/fancytree/dist/skin-win8/ui.fancytree.min', array('block' => 'css'));
echo $this->Html->css('/plugins/contextMenu/dist/jquery.contextMenu', array('block' => 'css'));
echo $this->Html->css('/css/institutions/viewer', array('block' => 'css'));
?>

<div class="row">
    <div class="col-sm-6">
        <ul class="preveiew">
            <?php foreach ($institutions as $k => $v): ?>
                <li><?php echo $v; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-sm-6">

    </div>
</div>

