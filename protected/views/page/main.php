<script type="text/javascript">
    $(document).ready(function(){
        $('.row-ico img').each(function(){
            $(this).hover(function(){ resizeImg(this,105); }, function(){ resizeImg(this); });
        });
    });
</script>
<?php $lang = Yii::app()->getLanguage(); ?>
        <h1 class="menu-hline"><?php echo Yii::t('app', 'main_page_interer');?></h1>
            <div class="menu-icon">
                <table class="row-ico" width="660" height="130" ><tr>
                    <td width="220">  
                        <a href="<?php echo Yii::app()->createUrl('house'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_house.gif" alt="Дом" width="85" height="85" onmouseout="resizeImg(this)" onmouseover="resizeImg(this, 105)" /></a>
                        <div class="text_label"><a href="<?php echo Yii::app()->createUrl('house'); ?>"><img src="<?php echo Yii::app()->request->baseUrl . '/images/' . $lang; ?>/text_house.gif" alt="Дом" /></a></div>
                    </td>
                    <td width="220">
                        <a href="<?php echo Yii::app()->createUrl('flat'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_flat.gif"  alt="Квартира" width="85" height="85" /></a>
                        <div class="text_label"><a href="<?php echo Yii::app()->createUrl('flat'); ?>" ><img src="<?php echo Yii::app()->request->baseUrl . '/images/' . $lang; ?>/text_flat.gif" alt="Квартира"  /></a></div>
                    </td>
                    <td width="220">
                        <a href="<?php echo Yii::app()->createUrl('society'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_interer.gif"  alt="Общественный интерьер" width="85" height="85" /></a>
                        <div class="text_label"><a href="<?php echo Yii::app()->createUrl('society'); ?>" ><img src="<?php echo Yii::app()->request->baseUrl . '/images/' . $lang; ?>/text_interer.gif" alt="Общественный интерьер" /></a></div>
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
						<div class="text_label"><a href="<?php echo Yii::app()->createUrl('sign'); ?>"><img src="<?php echo Yii::app()->request->baseUrl . '/images/' . $lang; ?>/text_sign.gif" alt="Фирменный знак" /></a></div>
                    </td>
                    <td width="220">
                        <a href="<?php echo Yii::app()->createUrl('corp_style'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_style.gif"  alt="Корпоративный стиль" width="85" height="85" /></a>
						<div class="text_label"><a href="<?php echo Yii::app()->createUrl('corp_style'); ?>"><img src="<?php echo Yii::app()->request->baseUrl . '/images/' . $lang; ?>/text_style.gif" alt="Корпоративный стиль"  /></a></div>
                    </td>
                    <td width="220">
                        <a href="<?php echo Yii::app()->createUrl('graph'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_grafic.gif"  alt="Графика" width="85" height="85" /></a>
						<div class="text_label"><a href="<?php echo Yii::app()->createUrl('graph'); ?>"><img src="<?php echo Yii::app()->request->baseUrl . '/images/' . $lang; ?>/text_grafic.gif" alt="Графика" /></a></div>
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
							<div class="text_label"><a href="<?php echo Yii::app()->createUrl('price'); ?>"><img src="<?php echo Yii::app()->request->baseUrl . '/images/' . $lang; ?>/text_price.gif" alt="Порядок работы и цены"  /></a></div>
						</td>
                    <td width="220">
                        <a href="<?php echo Yii::app()->createUrl('contacts'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_contact.gif"  alt="Контакты" width="85" height="85" /></a>
							<div class="text_label"><a href="<?php echo Yii::app()->createUrl('contacts'); ?>"><img src="<?php echo Yii::app()->request->baseUrl . '/images/' . $lang; ?>/text_contact.gif" alt="Контакты"/></a></div>
                    </td>
						<td width="220">                         
                            <a href="<?php echo Yii::app()->createUrl('partners'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_partner.gif"  alt="Наши партнеры" width="85" height="85" /></a>
							<div class="text_label"><a href="<?php echo Yii::app()->createUrl('partners'); ?>"><img src="<?php echo Yii::app()->request->baseUrl . '/images/' . $lang; ?>/text_partner.gif" alt="Наши партнеры" /></a></div>
                        </td>
					</tr></table>                
			</div>