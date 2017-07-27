<div class="row settingSections form">
    <div class="col-md-6">
        <?php echo $this->Form->create('SettingSection'); ?>
        <fieldset>
            <legend><?php
                echo __('Nova sekcija');
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
                ?></legend>
            <?php
            echo $this->Form->input('name', array(
                'autocomplete' => 'off'
            ));
            echo $this->Form->input('active');
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
</div>

