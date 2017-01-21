<?php
echo $this->Html->css('errormanager/popup', null, array('inline' => false));
echo $this->Html->script('error/errors', array('block' => 'scriptBottom'));
?>
<div class="errorLogs index">
    <table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
        <tr>

            <th><?php echo $this->Paginator->sort('type'); ?></th>
            <th><?php echo $this->Paginator->sort('ip', 'IP'); ?></th>
            <th><?php echo $this->Paginator->sort('url', 'URL'); ?></th>
            <th><?php echo $this->Paginator->sort('port'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th class="actions"></th>
        </tr>
        <?php foreach ($errorLogs as $errorLog): ?>
            <tr>
                <td><?php echo h($errorLog['ErrorLog']['type']); ?>&nbsp;</td>
                <td>
                    <span class="search-address"><?php echo h($errorLog['ErrorLog']['ip']); ?></span>&nbsp;<i title="Locate" class="ip-address fa fa-globe red-globe"></i>
                    &nbsp;</td>
                <td><?php
                    $err = $errorLog['ErrorLog']['url'];
                    if (strlen($err) > 20) {
                        $err = h(substr($err, 0, 19)) . " <b style='color: red;'>...</b>";
                    }
                    echo $err;
                    ?>&nbsp;</td>
                <td><?php echo h($errorLog['ErrorLog']['port']); ?>&nbsp;</td>
                <td><?php echo $this->Time->format($errorLog['ErrorLog']['created'], '%d.%m.%Y %H:%M %p'); ?></td>        
                <td class="actions">
                    <?php
                    echo $this->Link->cLink(__(''), array('action' => 'view', $errorLog['ErrorLog']['id']), 'fa clip-search-2', array(
                        'title' => 'Pogledj'
                    ));
                    ?>
                    <?php echo $this->Link->dLink("", array('action' => 'delete', $errorLog['ErrorLog']['id']), 'fa fa-trash-o', $errorLog['ErrorLog']['id']); ?>
                </td>        
            </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $this->element('pagination'); ?>
</div>
