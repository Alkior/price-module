<div id="form">
    <form class="filterform" method="get" action="#"> 
        <input class="input input-block input-search search-in-page-input filterinput" type="text" name="search" placeholder="������� �������� ������" maxlength="200">       
    </form>
</div>
<br>
<div> 
<? foreach ($p->servArrName as $servName=>$keys):?>
    <?$group = $servName;?>
    <details> 
        <summary>
            <h2><?echo $group;?></h2>
        </summary>                             
        <?foreach($keys as $key):?>
	  <?if($key['����'] != 0):?>
              <?$service= $key['������������������']; $price = $key['����']; ?>
	  <?endif?>
                <ul>
		
                    <a href="#">
                        <p>        
                            <div class="service-name">
				<?echo $service;?>
			    </div>
                            <div class="service-price">
				<span class="fl-r">
                               		<?echo $price.' ���.';?>
                                </span>
			    </div>  
                        </p>
                    </a>
		
                </ul>                      
        <? endforeach;?>
    </details>
<? endforeach;?>       
</div> 
<div>
    <a href="/services/">
        <button class="form-button">�� ���� �����</button>
    </a>
</div>
<!--<div><pre><?//echo var_dump($p->servArrName); ?></pre></div>-->
<!--<div>
    <form method="get" action="#">
        
            <input type="submit" name="getPricelist" class="form-button" value="���������(����� 0.1)">
      
    </form>
</div>-->
