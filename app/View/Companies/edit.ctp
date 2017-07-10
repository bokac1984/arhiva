<div class="companies form row">
    <div class="col-md-12">
        <?php
        echo $this->Form->create('Company');

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
            <legend><?php echo __('Uređivanje kompanije'); ?></legend>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('name');
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
