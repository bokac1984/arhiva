<?php  
echo $this->Html->script('https://www.google.com/recaptcha/api.js', array('block' => 'scriptBottom'));
?>
<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Kontaktirajte nas</h2>
            </div>
        </div>        
        <div class="row">
            <div class="col-sm-6">
                <div class="institutions form">
                    <?php
                    echo $this->Form->create('Contact');
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
                        'label' => 'Vaše ime i prezime',
                        'class' => 'form-control'
                    ));
                    
                    echo $this->Form->input('email', array(
                        'label' => 'Vaše email',
                        'class' => 'form-control'
                    ));
                    
                    echo $this->Form->input('message', array(
                        'label' => 'Poruka',
                        'class' => 'form-control',
                        'type' => 'textarea'
                    ));
                    echo $this->Recaptcha->display();                    
                    ?>
<!--                    <div class="form-group">
                        <div class="">
                            <div class="g-recaptcha" data-sitekey="6LcR2hEUAAAAAGxHQCLcGALqVE2KO3iyeP9ODF06"></div>
                        </div>
                    </div>                      -->

                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-6">
                            <button class="btn btn-blue btn-block" type="submit"> 
                                Pošalji <i class="fa fa-arrow-circle-right"></i> 
                            </button>
                        </div>
                    </div>                    
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <div class="col-sm-6">
                <p class="tex">
                    Pošaljite nam Vaše ideje, prijedloge, sugestije.
                </p>
            </div>       
        </div>
    </div>
</section>