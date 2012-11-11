<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="ru" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <meta name="keywords" content="<?php if(isset($this->pageKeywords)) echo $this->pageKeywords; ?>" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css?22" type="text/css" media="screen, projection" />
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.3.2.min.js"></script>
</head>
<body>
<style>
     body {
         background: #797367 url(/images/loader_background.jpg);
     }
</style>
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

<?php require_once 'fix_png.php'; ?>

</body>
</html>