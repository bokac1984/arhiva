<div class="row form">
    <?php
    echo $this->Form->create('Agreement');

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
    <div class="col-md-6">

        <fieldset>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('name');
            echo $this->Form->input('price');
            echo $this->Form->input('path');
            echo $this->Form->input('contract_date', array(
                'type' => 'text'
            ));
            echo $this->Form->input('new_file_name');
            ?>
        </fieldset>
        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-6">
                <button class="btn btn-blue btn-block" type="submit"> 
                    Sacuvaj <i class="fa fa-arrow-circle-right"></i> 
                </button>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <?php
        echo $this->Form->input('file_location');
        echo $this->Form->input('agreement_type_id');
        echo $this->Form->input('purchase_id');
        echo $this->Form->input('supplier_id');
        echo $this->Form->input('dvd');
        echo $this->Form->input('old_purchaser_id');
        echo $this->Form->input('old_supplier_id');
        ?>                
    </div>
    <?php echo $this->Form->end(); ?>
</div>
