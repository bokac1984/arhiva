<?php

?>
<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php 
                echo $this->Form->create(false);
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
                echo $this->Form->input('debugLevel', array(
                    'options' => array(0, 1, 2),
                    'empty' => '(choose one)',
                    'selected' => $debugLevel
                ));
                ?>
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
    </div>
</section>
