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
<!-- DIALOG -->
<div id="ajax-modal" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-body" style="margin-bottom:0">
        <form action="/contracts/upload" class="dropzone" method="post" id="my-awesome-dropzone">
            <input name="idNews" type="hidden" value="<?php echo $this->id ?>">
        </form>
    </div>
    <div class="modal-footer" style="margin-top:0">       
        <button id="btn-dialog-dismiss" class="btn btn-primary" data-dismiss="modal">
            U redu
        </button>
    </div>
</div>