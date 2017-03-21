<?php
echo $this->Html->script('/js/jquery.fastLiveFilter', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/agreements/kompanije', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("inst.init(1);", array('block' => 'scriptBottom'));

echo $this->Html->css('/css/agreements/icons', array('block' => 'css'));
echo $this->Html->css('/css/institutions/overview', array('block' => 'css'));
echo $this->Html->css('/css/institutions/spinner', array('block' => 'css'));

//debug($agreements);
?>
<div class="row">
    <div class="col-md-12">
        <h2>Prikaz kompanija</h2>
    </div>
</div>
<!--<div class="row">
    <div class="col-md-5">
        <p>
        <div class="preview-contracts">
            <?php
            echo $this->Html->image("nabavke.jpg", array(
                "alt" => "Ugovori o javnim nabavkama"
            ));
            ?>
        </div>
        </p>
    </div>
    <div class="col-md-7">
                <div class="preview-contracts-text">
                    <p>
                        Ugovori o djelu javnih institucija predstavljaju izvor mnogobrojnih nepravilnosti, a predmet su  kritike revizorskih izvještaja u kojima se obično ističe:
                    <ul>
                        <li>kako nema provjere opravdanosti njihovog zaključivanja;</li>
                        <li>da se često potpisuju sa istim osobama;</li>
                        <li>da ne postoje procedure praćena izvršenja zaključenih ugovora...</li>
                    </ul>  
                    Više puta revizori su naglasili kako javnost ne posjeduje dovoljno informacija o ugovorima o djelu, a upravo prekomjerno sklapanje ovih ugovora pokazuju da vlasti nisu ispoštavale obećanje o smanjenju javne potrošnje.                    
                    </p>
                </div>
    </div>            
</div>-->
<!--<div class="row">
    <div class="col-md-12">
        <p>
            Prema podacima iz <a href="https://ti-bih.org/ti-bih_monitoring-transparentnost-odgovornosti-integritet-2016/">TI BiH Monitoringa rezultata reforme javne uprave u oblasti transparentnosti, odgovornosti i integriteta 2014-2015</a> većina institucija ne posjeduje Plan usluga koje će biti realizovane ugovorima o djelu, a upravo to im omogućava neplansko trošenje sredstava.
        </p>
        <p>
            Istraživanja i prijave građana su pokazala takođe da javne institucije veoma često vrše zapošljavanje putem ugovora o djelu, kako bi se izbjegli javni konkursi, što omogućava nepotizam i korupciju u zapošljavanju.
        </p>
        <p>
            TI BiH baza podataka o ugovorima o djelu predočiće javnosti ugovore iz perioda od 2011 do 2013. godine, i posebno će biti korisna novinarima i istraživačima kao osnova za njihov daljnji rad.
        </p>                
    </div>
</div>-->
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#A" aria-controls="home" role="tab" data-toggle="tab">A</a>
                </li>                
                <?php foreach ($firstChar as $znak): ?>
                    <li role="presentation" class="">
                        <a href="#<?php echo $znak['0']['firstLetter']; ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo $znak['0']['firstLetter']; ?></a>
                    </li>
                <?php endforeach; ?>
                <li role="presentation" class="">
                    <a href="#broj" aria-controls="home" role="tab" data-toggle="tab">#</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="A">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="filemanager" id="A">
                                <div class="search">
                                    <input class="searchable_input" title="Pretražite institucije" type="search" placeholder="Pronadjite instituciju.." />
                                </div>                   
                                <ul class="data animated" style="">
                                    <?php foreach ($agreements as $agreement): ?>
                                        <li class="folders">
                                            <a id="<?php echo $agreement['Company']['id']; ?>" href="/preduzece/<?php echo $agreement['Company']['id']; ?>" title="<?php echo $agreement['Company']['name']; ?>" class="folders">
                                                <span class="icon folder full"></span>
                                                <span class="name"><?php echo $this->Text->truncate($agreement['Company']['name'], 100); ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="sk-folding-cube" style="display: none;">
                                    <div class="sk-cube1 sk-cube"></div>
                                    <div class="sk-cube2 sk-cube"></div>
                                    <div class="sk-cube4 sk-cube"></div>
                                    <div class="sk-cube3 sk-cube"></div>
                                </div>                     
                            </div>
                        </div>
                    </div>
                </div>
                <?php foreach ($firstChar as $znak): ?>
                    <div role="tabpanel" class="tab-pane" id="<?php echo $znak['0']['firstLetter']; ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="filemanager" id="<?php echo $znak['0']['firstLetter']; ?>">
                                    <div class="search">
                                        <input class="searchable_input" title="Pretražite institucije" type="search" placeholder="Pronadjite instituciju.." />
                                    </div>                
                                    <ul class="data animated" style="">

                                    </ul>
                                    <div class="sk-folding-cube" style="display: none;">
                                        <div class="sk-cube1 sk-cube"></div>
                                        <div class="sk-cube2 sk-cube"></div>
                                        <div class="sk-cube4 sk-cube"></div>
                                        <div class="sk-cube3 sk-cube"></div>
                                    </div>                     
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div role="tabpanel" class="tab-pane active" id="broj">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="filemanager" id="broj">
                                <div class="search">
                                    <input class="searchable_input" title="Pretražite institucije" type="search" placeholder="Pronadjite instituciju.." />
                                </div>                   
                                <ul class="data animated" style="">
                                    
                                </ul>
                                <div class="sk-folding-cube" style="display: none;">
                                    <div class="sk-cube1 sk-cube"></div>
                                    <div class="sk-cube2 sk-cube"></div>
                                    <div class="sk-cube4 sk-cube"></div>
                                    <div class="sk-cube3 sk-cube"></div>
                                </div>                     
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
    </div>
</div>
<hr class="">
