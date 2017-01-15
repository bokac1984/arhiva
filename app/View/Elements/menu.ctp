<?php
$url = $this->request->here;
?>
<ul class="nav navbar-nav navbar-right">
    <li class="<?php echo (preg_match("~^/$~", $url))? 'active' : ''?>">
        <a href="/">
            Home
        </a>
    </li>
    <?php if (!$this->Session->read('Auth.User')) : ?>
    <li class="<?php echo (preg_match("/(\/institutions|institucija)/", $url))? 'active' : ''?>">
        <a href="/ugovori-o-djelu-javnih-institucija">
            Ugovori o djelu
        </a>
    </li> 
    <li class="<?php echo (preg_match("/(\/agreements|nabavkama)/", $url))? 'active' : ''?>">
        <a href="/ugovori-o-nabavkama-javnih-preduzeca">
            Javne nabavke
        </a>
    </li>    
    <?php endif; ?>
    <?php if ($this->Session->read('Auth.User')) : ?>
    <li class="dropdown <?php echo (preg_match("/(\/institutions|institucija)/", $url))? 'active' : ''?>">
        <a class="dropdown-toggle" href="#" data-toggle="dropdown" data-hover="dropdown">
            Ugovori o djelu <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="/institutions/pregled">
                    Upravljanje
                </a>
            </li>
            <li>
                <a href="/institutions/contracts">
                    Novi ugovori
                </a>
            </li> 
            <li>
                <a href="/ugovori-o-djelu-javnih-institucija">
                    Javni pregled
                </a>
            </li>             
        </ul>
    </li>
    <li class="dropdown <?php echo (preg_match("/(\/agreements|Javnae nabavke)/", $url))? 'active' : ''?>">
        <a class="dropdown-toggle" href="#" data-toggle="dropdown" data-hover="dropdown">
            Javne Nabavke <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="/agreements">
                    Upravljanje
                </a>
            </li>
            <li>
                <a href="/ugovori-o-nabavkama-javnih-preduzeca">
                    Javni pregled
                </a>
            </li> 
        </ul>
    </li> 
    <li class="<?php echo (preg_match("/(\/settings)/", $url))? 'active' : ''?>">
        <a href="/settings">
            Podešavanja
        </a>
    </li>    
    <?php endif; ?>
<!--    <li class="menu-search">
         start: SEARCH BUTTON 
        <a href="#" data-placement="bottom" data-toggle="popover">
            <i class="clip-search-3"></i>
        </a>
         end: SEARCH BUTTON 
         start: SEARCH POPOVER 
        <div class="popover bottom search-box">
            <div class="arrow"></div>
            <div class="popover-content">
                 start: SEARCH FORM 
                <form class="" id="searchform" action="#">
                    <div class="input-group">
                        <input type="text" id="searchable_input" class="form-control" placeholder="Pretraži">
                        <span class="input-group-btn">
                            <button class="btn btn-main-color btn-squared" type="button">
                                <i class="clip-search-3"></i>
                            </button> </span>
                    </div>
                </form>
                 end: SEARCH FORM 
            </div>
        </div>
         end: SEARCH POPOVER 
    </li>-->
</ul>