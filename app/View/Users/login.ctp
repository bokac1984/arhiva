
<?php
echo $this->Form->create('User');
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
<div class="row">
    <div class="col-sm-3">
        <h2 class="StepTitle">Prijava na arhivu</h2>
        <?php
        echo $this->Form->input('username', array(
            'label' => 'Korisničko ime',
            'class' => 'form-control'
        ));
        echo $this->Form->input('password', array(
            'label' => 'Šifra',
            'class' => 'form-control'
        ));
        ?>
        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-6">
                <button class="btn btn-blue btn-block" type="submit"> 
                    Prijavi se <i class="fa fa-arrow-circle-right"></i> 
                </button>
            </div>
        </div>

    </div>
</div>    
<?php echo $this->Form->end(); ?>
