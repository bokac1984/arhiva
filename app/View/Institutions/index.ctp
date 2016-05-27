<?php
echo $this->Html->script('/plugins/fancytree/lib/jquery-ui.custom', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/fancytree/dist/jquery.fancytree-all.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/institutions/index', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("inst.init(1);", array('block' => 'scriptBottom'));

echo $this->Html->css('/plugins/fancytree/dist/skin-win8/ui.fancytree.min', array('block' => 'css'));
?>
<section class="wrapper padding50">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Pregled arhive</h2>
            </div>
        </div>        
        <div class="row">
            <div class="col-sm-12">
                <div id="tree"></div>
            </div>
        </div>
    </div>
</section>
