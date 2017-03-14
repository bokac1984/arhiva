
<div class="row">
    <div class="col-md-6">
        <?php
        echo $this->Form->create(false);
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
        echo $this->Form->input('settings_section');
        echo $this->Form->input('settings_name');
        echo $this->Form->input('settings_value', array(
            'type' => 'textarea'
        ));
        ?>
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