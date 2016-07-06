<!--<div class="fileUploads form">
<?php echo $this->Form->create('FileUpload'); ?>
	<fieldset>
		<legend><?php echo __('Add File Upload'); ?></legend>
	<?php
		echo $this->Form->input('filename');
		echo $this->Form->input('contractor');
		echo $this->Form->input('author');
		echo $this->Form->input('date');
		echo $this->Form->input('price');
		echo $this->Form->input('path');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List File Uploads'), array('action' => 'index')); ?></li>
	</ul>
</div>-->
<?php
echo $this->Html->script('/plugins/dropzone/downloads/dropzone.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modal', array('block' => 'scriptBottom'));
echo $this->Html->script('/plugins/bootstrap-modal/js/bootstrap-modalmanager', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/nesto', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("contracts.init(1);", array('block' => 'scriptBottom'));

echo $this->Html->css('/plugins/dropzone/downloads/css/dropzone', array('block' => 'css'));
echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', array('block' => 'css'));
echo $this->Html->css('/plugins/bootstrap-modal/css/bootstrap-modal', array('block' => 'css'));
?>
<section class="wrapper">
    <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>        
        <div class="row">
            <div class="col-sm-12">							
                <button type="button" id="btn-add-photos" class="btn btn-primary btn-sm">
                    Dodaj nove ugovore
                </button>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
    </div>
    <!-- end: BLOG POSTS AND COMMENTS CONTAINER -->
</section>
<!-- DIALOG -->
<div id="ajax-modal" class="modal fade" tabindex="-1" data-width="960" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-body" style="margin-bottom:0">
        <form action="/file_uploads/adding" class="dropzone" method="post" id="my-awesome-dropzone">
        </form>
    </div>
    <div class="modal-footer" style="margin-top:0">       
        <button id="btn-dialog-dismiss" class="btn btn-primary" data-dismiss="modal">
            U redu
        </button>
    </div>
</div>