
<div class="row">
    <div class="col-sm-12">

    </div>
</div>        
<div class="row">
    <div class="col-sm-12">
        <?php
        echo $this->Form->create('Contract');
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
            echo $this->Form->input('id');
            echo $this->Form->input('institution_id');
            echo $this->Form->input('name', array(
                'label' => 'Naziv fajla',
                'class' => 'form-control'
            ));
            echo $this->Form->input('datum', array(
                'label' => 'Datum',
                'class' => 'form-control'
            ));
            echo $this->Form->input('price', array(
                'label' => 'Visina ugovora (u KM)',
                'class' => 'form-control'
            ));
            echo $this->Form->input('original_name', array(
                'label' => 'Originalni naziv fajla',
                'class' => 'form-control',
                'disabled' => true
            ));
            echo $this->Form->input('new_file_name', array(
                'label' => 'Novi naziv fajla',
                'class' => 'form-control',
                'disabled' => true
            ));
            echo $this->Form->input('file_size', array(
                'label' => 'Veličina fajal u bajtovima',
                'class' => 'form-control',
                'disabled' => true
            ));
            ?>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-6">
                    <button class="btn btn-blue btn-block" type="submit"> 
                        Sačuvaj <i class="fa fa-arrow-circle-right"></i> 
                    </button>
                </div>
            </div>                      
        </fieldset>
        <?php echo $this->Form->end(); ?> 
    </div>
</div>
