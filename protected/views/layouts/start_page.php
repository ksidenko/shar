<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="ru" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <meta name="keywords" content="<?php if(isset($this->pageKeywords)) echo $this->pageKeywords; ?>" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css?17022014" type="text/css" media="screen, projection" />
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.3.2.min.js"></script>
</head>
<body>
<style>
     body {
         background: #797367 url(/images/loader_background.jpg);
     }
</style>

<?
    $links = array();
    $links []= array("text" => 'АРХИТЕКТУРНОЕ ПРОЕКТИРОВАНИЕ', "link" => Yii::app()->createUrl('house'));
    $links []= array("text" => 'ДИЗАЙН ПРОЕКТИРОВАНИЕ ИНТЕРЬЕРОВ ЗАГОРОДНЫХ ДОМОВ И КОТТЕДЖЕЙ', "link" => Yii::app()->createUrl('house'));
    $links []= array("text" => 'ДИЗАЙН ПРОЕКТИРОВАНИЕ ИНТЕРЬЕРОВ КВАРТИР', "link" => Yii::app()->createUrl('flat'));
    $links []= array("text" => 'ДИЗАЙН ПРОЕКТИРОВАНИЕ ОБЩЕСТВЕННЫХ ИНТЕРЬЕРОВ И ОФИСОВ', "link" => Yii::app()->createUrl('society'));
    $links []= array("text" => 'РАЗРАБОТКА ФИРМЕННОГО СТИЛЯ', "link" => Yii::app()->createUrl('corp_style'));

    $s = array();
    foreach($links as $row) {
        $s []= CHTML::link(mb_strtolower($row['text'], 'UTF8'), $row['link'], array('style' => 'font-size:10px; color:#797367;'));
    }
?>

<div style="left:10px; color:#797367; position: relative; " >
    <?php echo implode($s, ' | '); ?>
</div>

<div class="l-wrapper-loader">
	<div class="loader">
	   <img class="big_logo" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_big.png" alt="Шар" width="500" height="500"  />
	   <div class="language">
	      <a href="<?php echo Yii::app()->request->baseUrl; ?>/main/lang/ru">Русский</a>
		  <a href="<?php echo Yii::app()->request->baseUrl; ?>/main/lang/en">English</a>
	   </div>
	</div>
    <div class="about_new">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_small.png" alt="Шар" width="222" height="15"  />
    </div>
</div><!-- .l-wrapper -->

<div class="metrika" >
    <?php include "ya.metrika.php"; ?>
</div>

<?php  $this->widget('CFixPng', array()); ?>

</body>
</html>