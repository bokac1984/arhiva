<?php
echo $this->Html->script('/js/jquery.fastLiveFilter', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/institutions/overview', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("inst.init(1);", array('block' => 'scriptBottom'));
echo $this->Html->css('/css/institutions/icons', array('block' => 'css'));
echo $this->Html->css('/css/institutions/overview', array('block' => 'css'));
?>
<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="preview-contracts">
                <?php echo $this->Html->image("ugovori.jpg", array(
                    "alt" => "Ugovori od djelu"
                )); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="preview-contracts-text">
                    <p>
                        Na ovoj stranici možete da pregledate dokumente o javnim ugovorima
                    </p>
                </div>
            </div>            
        </div>
        <hr class="">
        <div class="row">
            <div class="col-md-12">
                <div class="filemanager">
                    <div class="search">
                        <input id="searchable_input" title="Pretražite institucije" type="search" placeholder="Pronadjite instituciju.." />
                    </div>   
                    <div class="breadcrumbs">
                            <span class="folderName back-btn">Institucije</span>
                    </div>                    
                    <ul class="data animated" style="">
                        <?php foreach ($institutions as $institut): ?>
                            <li class="folders">
                                <a id="<?php echo $institut['Institution']['id']; ?>" href="#" title="<?php echo $institut['Institution']['name']; ?>" class="folders">
                                    <span class="icon folder full"></span>
                                    <span class="name"><?php echo $this->Text->truncate($institut['Institution']['name'], 50); ?></span> 
                                    <span class="details"><?php echo $institut['Institution']['contract_count']; ?> ugovora</span>
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