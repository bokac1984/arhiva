<?php
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modal', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modalmanager', array('block' => 'scriptBottom'));

echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', array('block' => 'css'));
echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal', array('block' => 'css'));

echo $this->Html->script('/js/settings/settings', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("settings.init();", array('block' => 'scriptBottom'));
?>
<div class="row settings form">
    <div class="col-md-6">
        <?php
        echo $this->Form->create('Setting');

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
        ?>
        <fieldset>
            <?php
            echo $this->Form->input('setting_section_id');
            echo $this->Form->input('name');
            echo $this->Form->input('value');
            ?>
        </fieldset>
        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-6">
                <button class="btn btn-blue btn-block" type="submit"> 
                    Sačuvaj <i class="fa fa-arrow-circle-right"></i> 
                </button>
            </div>
        </div>          
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="col-md-6">
        <div class="col-sm-4" style="margin-top: 4%;">
            <button class="btn btn-blue btn-block btn-new-section"> 
                Nova sekcija <i class="fa fa-arrow-circle-right"></i> 
            </button>
    </div>
</div>
<!-- DIALOG -->
<div id="sections-modal" class="modal fade" tabindex="-1" data-width="460" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-header" style="margin-bottom:0">
        <h4 class="naslov">Nova sekcija</h4>
    </div>
    <div class="modal-body" style="margin-bottom:0;">
        <div class="sk-folding-cube" style="display: none;">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div> 
        <?php echo $this->Form->create('SettingSection', array(
            'default' => false
        )); ?>
            <?php
                $this->Form->inputDefaults(array(
                    'error' => array(
                        'attributes' => array(
                            'wrap' => 'div',
                            'class' => 'label label-warning'
                        )
                    ),
                    'div' => 'form-group',
                    'class' => 'form-control'
                ));
                ?>
            <?php
            echo $this->Form->input('name', array(
                'label' => 'Naziv sekcije',
                'autocomplete' => 'off'
            ));
            echo $this->Form->input('active',array(
                'type' => 'hidden',
                'value' => 1
            ));
            ?>          
        <?php echo $this->Form->end(); ?>        
    </div>    
    <div class="modal-footer" style="margin-top:0">       
        <button id="btn-dialog-dismiss" class="btn btn-primary save-confirmed">
            Sačuvaj
        </button>
        <button id="btn-dialog-dismiss" class="btn btn-default" data-dismiss="modal">
            Odustani
        </button>        
    </div>
</div>