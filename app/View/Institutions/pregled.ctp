<?php 
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modal', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modalmanager', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/iCheck/jquery.icheck.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/institutions/pregled', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("inst.init();", array('block' => 'scriptBottom'));

echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', array('block' => 'css'));
echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal', array('block' => 'css'));
echo $this->Html->css('/plugins/iCheck/skins/square/blue', array('block' => 'css'));
echo $this->Html->css('/css/institutions/pregled', array('block' => 'css'));
?>
<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <p class="pull-right">
                    <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                <?php
                echo $this->Html->link('Nova institucija', array(
                    'controller' => 'institutions',
                    'action' => 'add'
                        ), array(
                    'class' => 'btn btn-primary',
                    'role' => 'button'
                ));
                ?>
                </p>
            <?php if (!empty($institutions)): ?>                
                <p>
                    <a href="#" class="btn btn-bricky" role="button" id="deleteAll">Obriši</a>
                    <span class="error-delete text-danger" style="display: none;">Niste odabrali ni jednu instituciju!</span>
                </p> 
            <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php if (!empty($institutions)): ?>
                <div class="institutions index">
                    <table cellpadding="0" cellspacing="0" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="center"><input class="check-all" name="iCheckMain" type="checkbox" value="" /></th>
                                <th class="center"><?php echo $this->Paginator->sort('id', '#'); ?></th>
                                <th><?php echo $this->Paginator->sort('name', 'Naziv'); ?></th>
                                <th><?php echo $this->Paginator->sort('contract_count', 'Broj ugovora'); ?></th>
                                <th><?php echo $this->Paginator->sort('view_count', '# Pregleda'); ?></th>
                                <th><?php echo $this->Paginator->sort('created', 'Kreiran'); ?></th>
                                <th><?php echo $this->Paginator->sort('modified', 'Zadnja izmjena'); ?></th>
                                <th class="actions"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody class='chekboksovi'>
                        <?php foreach ($institutions as $institution): ?>
                                <tr>
                                    <td class="center"><input name="iCheck" class="koji-id" type="checkbox" value="<?php echo h($institution['Institution']['id']); ?>" /></td>
                                    <td class="center"><?php echo h($institution['Institution']['id']); ?>&nbsp;</td>
                                    <td><?php echo h($institution['Institution']['name']); ?>&nbsp;</td>
                                    <td class="center"><?php echo h($institution['Institution']['contract_count']); ?>&nbsp;</td>
                                    <td class="center"><?php echo h($institution['Institution']['view_count']); ?>&nbsp;</td>
                                    <td><?php echo h($institution['Institution']['created']); ?>&nbsp;</td>
                                    <td><?php echo h($institution['Institution']['modified']); ?>&nbsp;</td>
                                    <td class="actions">
                                        <?php echo $this->Link->cLink(__(''), array('action' => 'view', $institution['Institution']['id']), 'fa fa-eye', array(
                                            'title' => 'Pregledaj instituciju'
                                        )); ?>
                                        <?php echo $this->Link->cLink(__(''), array('action' => 'edit', $institution['Institution']['id']), 'fa fa-edit', array(
                                            'title' => 'Uredi'
                                        )); ?>
                                        <?php echo $this->Link->cLink(__(''), array('action' => 'contract', $institution['Institution']['id']), 'fa clip-file-plus', array(
                                            'title' => 'Dodaj novi ugovor'
                                        )); ?>
                                        <?php echo $this->Link->dLink("", array('action' => 'delete', $institution['Institution']['id']), 'fa fa-trash-o', $institution['Institution']['id']); ?>
                                    </td>
                                </tr>
                    <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php echo $this->element('pagination'); ?>
                </div>
                <?php else: ?>
                <h2>Nema dodatih institucija</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- DIALOG -->
<div id="delete-modal" class="modal fade" tabindex="-1" data-width="460" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-header" style="margin-bottom:0">
        <h4>Brisanje</h4>
    </div>
    <div class="modal-body" style="margin-bottom:0">
        <h5>Da li ste sigurni da želite obrisati odabrane institucije?</h5>
    </div>    
    <div class="modal-footer" style="margin-top:0">       
        <button id="btn-dialog-dismiss" class="btn btn-primary deleteAllConfirmed">
            U redu
        </button>
        <button id="btn-dialog-dismiss" class="btn btn-default" data-dismiss="modal">
            Odustani
        </button>        
    </div>
</div>