<?php
echo $this->Html->script('/js/institutions/overview', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("inst.init(1);", array('block' => 'scriptBottom'));
echo $this->Html->css('/css/institutions/icons', array('block' => 'css'));
?>
<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="filemanager">
                    <div class="breadcrumbs">
                        <span class="folderName back-btn">Institucije</span>
                    </div>                    
                    <ul class="data animated" style="">
                        <?php foreach ($institutions as $institut): ?>
                            <li class="folders">
                                <a id="<?php echo $institut['Institution']['id']; ?>" href="#" title="<?php echo $institut['Institution']['name']; ?>" class="folders">
                                    <span class="icon folder full"></span>
                                    <span class="name"><?php echo $institut['Institution']['name']; ?></span> 
                    <!--                <span class="details"><?php echo $institut['Institution']['contract_count']; ?> ugovora</span>-->
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>        
</div>
</section>