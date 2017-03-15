<?php if ($agreements): ?>
<?php foreach ($agreements as $agreement): ?>
    <li class="folders">
        <a id="<?php echo $agreement['Company']['id']; ?>" href="/preduzece/<?php echo $agreement['Company']['id']; ?>" title="<?php echo $agreement['Company']['name']; ?>" class="folders">
            <span class="icon folder full"></span>
            <span class="name"><?php echo $this->Text->truncate($agreement['Company']['name'], 100); ?></span>
        </a>
    </li>
<?php endforeach; ?>
<?php else: ?>
    Nema podataka  
<?php endif; ?>
