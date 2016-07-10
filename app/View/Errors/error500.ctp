<?php

?>
<section class="wrapper">
    <div class="container">
        <div class="row">
            <!-- start: 500 -->
            <div class="col-sm-12 page-error">
                <div class="error-number bricky">
                    500
                </div>
                <div class="error-details col-sm-6 col-sm-offset-3">
                    <h3><?php echo $message; ?></h3>
                    <p>
                        Nešto nije u redu!
                        <br>
                        Čini se da se nešto slomilo unutar našeg sistema.
                        <br>
                        Bez panike, popravljamo! Molimo Vas dođite malo kasnije.
                    </p>
                </div>
            </div>
            <!-- end: 500 -->
        </div>
    </div>
</section>
<?php
if (Configure::read('debug') > 0):
    echo $this->element('exception_stack_trace');
endif;
?>