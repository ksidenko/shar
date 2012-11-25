<?php $lang = Yii::app()->getLanguage(); ?>
<div class="menu-hline"><h1 class="g-fleft"><?php echo $this->pageTitle;?></h1><?php echo CHtml::link(Yii::t('app', 'link_home'), Yii::app()->createUrl('/main'), array('class' => 'g-fright home')); ?></div>

<div style="height: 500px; margin: 30px auto; padding-bottom: 30px; width: 800px;">

<img src="<?php echo Yii::app()->request->baseUrl . "/images/$lang/pathway.jpg"; ?>" height="460" class="g-fleft" style="padding: 0px">
    <div class="g-fleft contacts-block">
        <H1>Шемонаев<br>Андрей Рудольфович</H1>
        <p>Новосибирск</p>
        <p>ул. Галущака, 2 - 110</p>
        <p>офис: (383) 246 01 95</p>
        <p>моб.: 8 913 924 71 70</p>
        <p>e-mail: sharsd@yandex.ru</p>
    </div>

    <div class="g-fleft contacts-block">
        <H1>Шемонаева<br>Ирина Васильевна</H1>
        <p>Новосибирск</p>
        <p>ул. Галущака, 2 - 110</p>
        <p>офис: (383) 246 01 95</p>
        <p>моб.: 8 913 919 46 02</p>
        <p>e-mail: sharsd@yandex.ru</p>
    </div>

</div>
<div class="bottom-line-small">&nbsp;</div>
