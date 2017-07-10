<?php
echo $this->Html->script('/js/agreements/edit', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("editFun.init();", array('block' => 'scriptBottom'));
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>
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
            echo $this->Form->input('path', array(
                'readonly' => true
            ));
            echo $this->Form->input('contract_date', array(
                'id' => 'datepicker',
                'type' => 'text',
                'label' => 'Datum (gggg-mm-dd)'
            ));
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
        echo $this->Form->input('agreement_type_id');
        echo $this->Form->input('dvd', array(
            'readonly' => true
        ));
        ?>                
    </div>
    <?php echo $this->Form->end(); ?>
</div>
