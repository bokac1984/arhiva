<?php if ($this->Paginator->hasNext() || $this->Paginator->hasPrev()): ?>
<p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __('Stranica {:page} od {:pages}, prikazujući {:current} redova od {:count} ukupno, početni {:start}, završni {:end}')
    ));
    ?>	
</p>
<div>
    <ul class="pagination">
        <?php
        echo $this->Paginator->prev('< ', array('tag' => 'li'), null, array('class' => 'prev disabled', 'tag' => 'li', 'disabledTag' => 'a'));
        echo $this->Paginator->first("<<", array(
            'tag' => 'li'
        ));
        echo $this->Paginator->numbers(array(
                'separator' => '', 
                'tag' => 'li',
                'currentClass' => 'active',
                'currentTag' => 'a'
            )
        );
        echo $this->Paginator->last(">>", array(
            'tag' => 'li'
        ));
        echo $this->Paginator->next(' >', array('tag' => 'li'), null, array('class' => 'next disabled', 'tag' => 'li', 'disabledTag' => 'a'));          
        ?>
    </ul>
</div>
<?php endif; ?>