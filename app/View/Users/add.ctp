

<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="users form">
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
                    <?php
                    echo $this->Form->input('username');
                    echo $this->Form->input('password');
                    echo $this->Form->input('first_name');
                    echo $this->Form->input('last_name');
                    ?>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-6">
                            <button class="btn btn-blue btn-block" type="submit"> 
                                Dodaj korisnika <i class="fa fa-arrow-circle-right"></i> 
                            </button>
                        </div>
                    </div>                     
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>