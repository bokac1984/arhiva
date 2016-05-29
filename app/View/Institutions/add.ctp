

<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Dodavanje institucije</h2>
            </div>
        </div>        
        <div class="row">
            <div class="col-sm-6">
                <div class="institutions form">
                    <?php
                    echo $this->Form->create('Institution');
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
                    echo $this->Form->input('name', array(
                        'label' => 'Naziv institucije',
                        'class' => 'form-control'
                    ));
                    echo $this->Form->input('description', array(
                        'label' => 'Korisničko ime',
                        'class' => 'form-control',
                        'type' => 'textarea'
                    ));
                    ?>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-6">
                            <button class="btn btn-blue btn-block" type="submit"> 
                                Unesi <i class="fa fa-arrow-circle-right"></i> 
                            </button>
                        </div>
                    </div>                    
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
