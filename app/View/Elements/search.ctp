<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
    <div class="col-md-12">
        <?php
        echo $this->Form->create('Agreement', array(
            'type' => 'get',
            'url' => 'search'
        ));

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

        <?php
        echo $this->Form->input('what', array(
            'label' => 'Pretraga',
            'class' => 'form-control',
            'autocomplete' => 'off'
        ));
        ?>
        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-6">
                <button class="btn btn-blue btn-block" type="submit"> 
                    Pretraži <i class="fa fa-arrow-circle-right"></i> 
                </button>
            </div>
        </div> 
        <?php echo $this->Form->end(); ?>
    </div>
</div>