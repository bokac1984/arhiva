<?php
echo $this->Html->script('/plugins/fancytree/lib/jquery-ui.custom', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/fancytree/dist/jquery.fancytree-all.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/institutions/index', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("inst.init(1);", array('block' => 'scriptBottom'));

echo $this->Html->css('/plugins/fancytree/dist/skin-win8/ui.fancytree.min', array('block' => 'css'));

// modal
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modal', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modalmanager', array('block' => 'scriptBottom'));
echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', array('block' => 'css'));
echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal', array('block' => 'css'));
?>
<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Pregled arhive</h2>
                <p><i>Da bi ste skinuli neki fajl, <b>dvokliknite</b> na naziv fajla.</i></p>
            </div>
        </div>        
        <div class="row">
            <div class="col-sm-12">
                <div id="tree"></div>
            </div>
        </div>
    </div>
</section>
<!-- DIALOG -->
<div id="ajax-modal" class="modal fade" tabindex="-1" data-width="460" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-header" style="margin-bottom:0">
        <h4>Skidanje fajla</h4>
        
    </div>    
    <div class="modal-body" style="margin-bottom:0">
        <div class="row">
            <div class="col-md-12">
                <p>Da bi ste skinuli ugovor za <i class="naziv_fajla"></i> kliknite na dugme ispod:</p>
            </div>
        </div>        
        <div class="row padding50">
            <div class="col-md-12">
                <div class="downloader"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer" style="margin-top:0">       
        <button id="btn-dialog-dismiss" class="btn btn-default" data-dismiss="modal">
            Odustani
        </button>
    </div>
</div>