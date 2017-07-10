<?php
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modal', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modalmanager', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/iCheck/jquery.icheck.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/companies/merger', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("inst.init();", array('block' => 'scriptBottom'));

echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', array('block' => 'css'));
echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal', array('block' => 'css'));
echo $this->Html->css('/plugins/iCheck/skins/square/blue', array('block' => 'css'));
echo $this->Html->css('/css/institutions/pregled', array('block' => 'css'));

//debug($newData);
?>
<div class="row">
    <div class="col-sm-4">
        <div class="institutions form">
            <?php
            echo $this->Form->create('Company');
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
            echo $this->Form->input('percent', array(
                'label' => 'Unesite procenat',
                'class' => 'form-control'
            ));
            ?>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-6">
                    <button class="btn btn-blue btn-block" type="submit"> 
                        Skeniraj <i class="fa fa-arrow-circle-right"></i> 
                    </button>
                </div>
            </div>                    
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">

            <p class="pull-right">
                <a id="merge-btn" href="#" class="btn btn-primary" role="button">Spoji SVE pojedinacno</a>
            </p>
        </div>
    </div>
    <?php if (isset($newData)): ?>
        <div class="row">
            <div class="col-md-6">

                <p class="pull-right">
                    <?php //print(count($newData)); ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-condensed" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="center"><input class="check-all" name="iCheckMain" type="checkbox" value="" /></th>
                        </tr>
                    </thead>
                    <tbody class='chekboksovi'>
                        <?php foreach ($newData as $company): ?>
                            <tr>
                                <td class="center">
                                    <input name="iCheck" class="koji-id" type="checkbox" value="<?php echo implode(',', array_keys($company)); ?>" />
                                </td>
                                <td class="companies">
                                    <?php foreach ($company as $id => $name): ?>
                                        <i><?php echo h($id); ?></i> &nbsp;<?php echo h($name); ?><br>
                                    <?php endforeach; ?>
                                </td>
                                <td>    <?php
                                    echo $this->Link->cLink(__(''), array(), 'fa clip-fullscreen-exit', array(
                                        'title' => 'Spoji',
                                        'class' => 'join-companies'
                                    ));
                                    ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
    <!-- DIALOG -->
    <div id="merge-modal" class="modal fade" tabindex="-1" data-width="460" data-backdrop="static" data-keyboard="false" style="display: none;">
        <div class="modal-header" style="margin-bottom:0">
            <h4>Spajanje</h4>
        </div>
        <div class="modal-body" style="margin-bottom:0">
            <h5>Da li ste sigurni da želite spojiti odabrane kompanije?</h5>
        </div>    
        <div class="modal-footer" style="margin-top:0">       
            <button id="btn-dialog-dismiss" class="btn btn-primary mergeConfirmed">
                U redu
            </button>
            <button id="btn-dialog-dismiss" class="btn btn-default" data-dismiss="modal">
                Odustani
            </button>        
        </div>
    </div>