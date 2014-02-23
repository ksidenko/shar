<script type="text/javascript">
    $(document).ready(function(){
        $('.row-ico img').each(function(){
            $(this).hover(function(){ resizeImg(this,105); }, function(){ resizeImg(this); });
        });
    });
</script>
<?php
    $lang = Yii::app()->getLanguage();
    $style = 'color:white;text-decoration: none; font-size: 12px;text-transform: uppercase;font-weight:bold;';
?>
        <h1 class="menu-hline"><?php echo Yii::t('app', 'main_page_interer');?></h1>
            <div class="menu-icon">
                <table class="row-ico" width="660" height="130" ><tr>
                    <td width="220">  
                        <a href="<?php echo Yii::app()->createUrl('house'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_house.gif" alt="Дом" width="85" height="85" onmouseout="resizeImg(this)" onmouseover="resizeImg(this, 105)" /></a>
                        <div class="text_label"><a href="<?php echo Yii::app()->createUrl('house'); ?>" style="<?php echo $style; ?>" >Дизайн проекты <br/>загородных домов <br/>и коттеджей</a></div>
                    </td>
                    <td width="220">
                        <a href="<?php echo Yii::app()->createUrl('flat'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_flat.gif"  alt="Квартира" width="85" height="85" /></a>
                        <div class="text_label"><a href="<?php echo Yii::app()->createUrl('flat'); ?>" style="<?php echo $style; ?>" >Дизайн проекты <br/>квартир<br/>&nbsp;</a></div>
                    </td>
                    <td width="220">
                        <a href="<?php echo Yii::app()->createUrl('society'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_interer.gif"  alt="Общественный интерьер" width="85" height="85" /></a>
                        <div class="text_label"><a href="<?php echo Yii::app()->createUrl('society'); ?>" style="<?php echo $style; ?>" >Дизайн проекты <br/>Общественных<br/>интерьеров</a></div>
                    </td>
                </tr></table>
               <div class="g-clear"></div>	
            </div>
	
            <div class="l-hline"></div>
			<h1 class="menu-hline"><?php echo Yii::t('app', 'main_page_graph');?></h1>
			<div class="menu-icon">
                
                <table class="row-ico" width="660" height="130" ><tr>
                    <td width="220">  
                        <a href="<?php echo Yii::app()->createUrl('sign'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_sign.gif" alt="Фирменный знак" width="85" height="85" /></a>
						<div class="text_label"><a href="<?php echo Yii::app()->createUrl('sign'); ?>" style="<?php echo $style; ?>" >Разработка <br/>фирменного знака<br/>&nbsp;</a></div>
                    </td>
                    <td width="220">
                        <a href="<?php echo Yii::app()->createUrl('corp_style'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_style.gif"  alt="Корпоративный стиль" width="85" height="85" /></a>
						<div class="text_label"><a href="<?php echo Yii::app()->createUrl('corp_style'); ?>" style="<?php echo $style; ?>" >Разработка <br/>фирменного стиля<br/>&nbsp;</a></div>
                    </td>
                    <td width="220">
                        <a href="<?php echo Yii::app()->createUrl('graph'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_grafic.gif"  alt="Графика" width="85" height="85" /></a>
						<div class="text_label"><a href="<?php echo Yii::app()->createUrl('graph'); ?>" style="<?php echo $style; ?>" >Живопись <br/>и графика<br/>&nbsp;</a></div>
                    </td>
                </tr></table>
                
				<div class="g-clear"></div>
			</div>
		<div class="l-hline"></div>
		<h1 class="menu-hline"><?php echo Yii::t('app', 'main_page_info');?></h1>
			<div class="menu-icon">
                <table class="row-ico" width="660" height="130" ><tr>
                    <td width="220">  
                        <a href="<?php echo Yii::app()->createUrl('price'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_price.gif" alt="Порядок работы и цены" width="85" height="85" /></a>
							<div class="text_label"><a href="<?php echo Yii::app()->createUrl('price'); ?>" style="<?php echo $style; ?>" >Порядок работы <br/>и цены</a></div>
						</td>
                    <td width="220">
                        <a href="<?php echo Yii::app()->createUrl('contacts'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_contact.gif"  alt="Контакты" width="85" height="85" /></a>
							<div class="text_label"><a href="<?php echo Yii::app()->createUrl('contacts'); ?>" style="<?php echo $style; ?>" >Контакты<br/>&nbsp;</a></div>
                    </td>
						<td width="220">                         
                            <a href="<?php echo Yii::app()->createUrl('partners'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_partner.gif"  alt="Наши партнеры" width="85" height="85" /></a>
							<div class="text_label"><a href="<?php echo Yii::app()->createUrl('partners'); ?>" style="<?php echo $style; ?>" >Наши партнеры<br/>&nbsp;</a></div>
                        </td>
					</tr></table>                
			</div>