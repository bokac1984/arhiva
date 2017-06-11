<div class="row form">
    <div class="col-md-6">
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
        <fieldset>
            <?php
                    ?>
        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-6">
                <button class="btn btn-blue btn-block" type="submit"> 
                    Sacuvaj <i class="fa fa-arrow-circle-right"></i> 
                </button>
            </div>
        </div>
        <?php
            echo $this->Form->input('id');
            echo $this->Form->input('name');
            echo $this->Form->input('price');
            echo $this->Form->input('path');
            echo $this->Form->input('contract_date', array(
                'type' => 'text'
            ));
            echo $this->Form->input('old_path');
            echo $this->Form->input('original_price');
            echo $this->Form->input('size');
            echo $this->Form->input('new_file_name');
            echo $this->Form->input('file_location');
            echo $this->Form->input('old_file_location');
            echo $this->Form->input('downloaded');
            echo $this->Form->input('display');
            echo $this->Form->input('agreement_type_id');
            echo $this->Form->input('purchase_id');
            echo $this->Form->input('supplier_id');
            echo $this->Form->input('dvd');
            echo $this->Form->input('old_purchaser_id');
            echo $this->Form->input('old_supplier_id');
            ?>
        </fieldset>
        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-6">
                <button class="btn btn-blue btn-block" type="submit"> 
                    Sacuvaj <i class="fa fa-arrow-circle-right"></i> 
                </button>
            </div>
        </div>
<?php echo $this->Form->end(); ?>
    </div>
</div>
