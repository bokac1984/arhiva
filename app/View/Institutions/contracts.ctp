<?php
echo $this->Html->script('/plugins/dropzone/downloads/dropzone.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modal', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modalmanager', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/images', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("contracts.init(1);", array('block' => 'scriptBottom'));

echo $this->Html->css('/plugins/dropzone/downloads/css/dropzone', array('block' => 'css'));
echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', array('block' => 'css'));
echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal', array('block' => 'css'));
?>
<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">      
        <div class="row">
            <div class="col-sm-12">							
                <button type="button" id="btn-add-photos" class="btn btn-primary btn-sm">
                    Dodaj nove ugovore
                </button>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
    </div>
    <!-- end: BLOG POSTS AND COMMENTS CONTAINER -->
</section>
<!-- DIALOG -->
<div id="ajax-modal" class="modal fade" tabindex="-1" data-width="960" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-body" style="margin-bottom:0">
        <form action="/institutions/upload" class="dropzone" method="post" id="my-awesome-dropzone">
        </form>
    </div>
    <div class="modal-footer" style="margin-top:0">       
        <button id="btn-dialog-dismiss" class="btn btn-primary" data-dismiss="modal">
            U redu
        </button>
    </div>
</div>