<?php

?>
<section class="wrapper">
    <div class="container">
        <div class="row">
            <!-- start: 404 -->
            <div class="col-sm-12 page-error">
                <div class="error-number teal">
                    404
                </div>
                <div class="error-details col-sm-6 col-sm-offset-3">
                    <h3><?php echo $message; ?></h3>
                    <p>
                        Nažalost, nismo mogli da nađemo fajl koji tražite.
                        <br>
                        Može biti da je privremeno nedostupan, premješten ili ne postoji.
                        <br>
                        Provjerite adresu koju ste unijeli i pokušajte ponovo
                        <br>
                        <a href="/" class="btn btn-teal btn-return">
                            Vrati se na početnu stranicu
                        </a>
                    </p>
                </div>
            </div>
            <!-- end: 404 -->
        </div>
    </div>
</section>
<?php
if (Configure::read('debug') > 0):
    echo $this->element('exception_stack_trace');
endif;
?>