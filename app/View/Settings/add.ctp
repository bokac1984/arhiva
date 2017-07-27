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
</div>
