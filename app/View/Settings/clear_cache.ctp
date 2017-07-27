<?php 

echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modal', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modalmanager', array('block' => 'scriptBottom'));

echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', array('block' => 'css'));
echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal', array('block' => 'css'));

echo $this->Html->script('/js/settings/settings', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("settings.init();", array('block' => 'scriptBottom'));

?>

<div class="row">
    <div class="col-md-6">
        <?php
        echo $this->Html->link("Očisti Keš", 
        '#', 
        array('class' => 'btn btn-primary btn-clear'));
        ?>
    </div>
</div>
<!-- DIALOG -->
<div id="cache-modal" class="modal fade" tabindex="-1" data-width="460" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-header" style="margin-bottom:0">
        <h4 class="naslov">Čišćenje kešta</h4>
    </div>
    <div class="modal-body" style="margin-bottom:0;">
        <div class="sk-folding-cube" style="display: none;">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div> 
        <div class="heading-title">
            <h5>Da li ste sigurni da želite obrisati keš podatke?</h5>
        </div>
    </div>    
    <div class="modal-footer" style="margin-top:0">       
        <button id="btn-dialog-dismiss" class="btn btn-primary mergeConfirmed">
            U redu
        </button>
        <button id="btn-dialog-dismiss" class="btn btn-default" data-dismiss="modal">
            Odustani
        </button>        
    </div>
</div>