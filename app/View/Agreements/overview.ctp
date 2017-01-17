<?php
echo $this->Html->css('/css/institutions/icons', array('block' => 'css'));
echo $this->Html->css('/css/institutions/overview', array('block' => 'css'));
echo $this->Html->css('/css/institutions/spinner', array('block' => 'css'));
//debug($agreements);
?>
<div class="row">
    <div class="col-md-12">
        <h2>Baza podataka o nabavkama javnih preduzeća</h2>
    </div>
</div>
<div class="row">
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
<!--        <div class="preview-contracts-text">
            <p>
                Ugovori o djelu javnih institucija predstavljaju izvor mnogobrojnih nepravilnosti, a predmet su  kritike revizorskih izvještaja u kojima se obično ističe:
            <ul>
                <li>kako nema provjere opravdanosti njihovog zaključivanja;</li>
                <li>da se često potpisuju sa istim osobama;</li>
                <li>da ne postoje procedure praćena izvršenja zaključenih ugovora...</li>
            </ul>  
            Više puta revizori su naglasili kako javnost ne posjeduje dovoljno informacija o ugovorima o djelu, a upravo prekomjerno sklapanje ovih ugovora pokazuju da vlasti nisu ispoštavale obećanje o smanjenju javne potrošnje.                    
            </p>
        </div>-->
    </div>            
</div>
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
<hr class="">
<div class="row">
    <div class="col-md-12">
        <div class="agreements index">
            <table class="table" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('purchase_id', 'Naručilac'); ?></th>
                        <th><?php echo $this->Paginator->sort('name', 'Ugovor'); ?></th>
                        <th><?php echo $this->Paginator->sort('price', 'Iznos (KM)'); ?></th>
                        <th><?php echo $this->Paginator->sort('contract_date', 'Datum'); ?></th>
                        <th><?php echo $this->Paginator->sort('agreement_type_id', 'Vrsta'); ?></th>
                        <th><?php echo $this->Paginator->sort('supplier_id', 'Dobavljač'); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agreements as $agreement): ?>
                    <tr>
                        <td>
                            <?php echo $this->Html->link($agreement['Purchase']['name'], array('controller' => 'companies', 'action' => 'view', 'id' => $agreement['Purchase']['id'])); ?>
                        </td>                         
                        <td><?php echo h($agreement['Agreement']['name']); ?>&nbsp;</td>
                        <td><?php echo number_format($agreement['Agreement']['price'], 2, ',', '.'); ?>&nbsp;</td>
                        <td><?php echo h($this->Time->format($agreement['Agreement']['contract_date'], '%d.%m.%Y')); ?>&nbsp;</td>                                    
                        <td>
                            <?php echo $this->Html->link($agreement['AgreementType']['name'], array('controller' => 'agreement_types', 'action' => 'view', 'id' => $agreement['AgreementType']['id'])); ?>
                        </td>  
                        <td>
                            <?php echo $this->Html->link($agreement['Supplier']['name'], array('controller' => 'companies', 'action' => 'view', 'id' => $agreement['Purchase']['id'])); ?>
                        </td>
                        <td>
                            <?php
                            echo $this->Link->cLink(__(''), array('action' => 'sendFile', $agreement['Agreement']['new_file_name']), 'fa fa-download', array(
                                'title' => 'Skini ugovor'
                            ));
                            ?>                            
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo $this->element('pagination'); ?>
        </div>
    </div>
</div>      