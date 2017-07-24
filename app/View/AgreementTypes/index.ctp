<?php
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modal', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modalmanager', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/iCheck/jquery.icheck.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/types/index', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("types.init();", array('block' => 'scriptBottom'));

echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', array('block' => 'css'));
echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal', array('block' => 'css'));
echo $this->Html->css('/plugins/iCheck/skins/square/blue', array('block' => 'css'));
echo $this->Html->css('/css/institutions/pregled', array('block' => 'css'));
?>
<div class="row">
    <div class="col-md-12">

        <p class="pull-right">
            <a id="merge-btn" href="#" class="btn btn-primary" role="button">Spoji u jednu</a>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-condensed" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th class="center"><input class="check-all" name="iCheckMain" type="checkbox" value="" /></th>
                    <th class="center">Glavni</th>
                    <th><?php echo $this->Paginator->sort('id', '#'); ?></th>
                    <th><?php echo $this->Paginator->sort('name', 'Naziv'); ?></th>
                    <th><?php echo $this->Paginator->sort('active', 'Aktivan'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody class='chekboksovi'>
                <?php foreach ($agreementTypes as $agreementType): ?>
                    <tr id="<?php echo h($agreementType['AgreementType']['id']); ?>">
                        <td class="center">
                            <input name="iCheck" class="koji-id" type="checkbox" value="<?php echo h($agreementType['AgreementType']['id']); ?>" />
                        </td>
                        <td class="center">
                            <input name="iCheck[]" class="main" type="radio" value="<?php echo h($agreementType['AgreementType']['id']); ?>" />
                        </td>
                        <td><?php echo h($agreementType['AgreementType']['id']); ?>&nbsp;</td>
                        <td><?php echo h($agreementType['AgreementType']['name']); ?>&nbsp;</td>
                        <td><?php echo h($agreementType['AgreementType']['active']); ?>&nbsp;</td>
                        <?php echo $this->element('actions', array(
                            'data' => $agreementType['AgreementType']
                        )); ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->element('pagination'); ?>
    </div>
</div>
<!-- DIALOG -->
<div id="merge-modal" class="modal fade" tabindex="-1" data-width="460" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-header" style="margin-bottom:0">
        <h4>Spajanje</h4>
    </div>
    <div class="modal-body" style="margin-bottom:0">
        <div class="row question">
            <div class="col-md-12">
                <h5>Da li ste sigurni da želite spojiti odabrane tipove?</h5>
            </div>
        </div>
        <div class="row waiting hidden">
            <div class="col-md-12">
                <h5>Cekanje</h5>
            </div>
        </div>
        <div class="row merge-results hidden">
            <div class="col-md-12">
                
            </div>
        </div>        
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