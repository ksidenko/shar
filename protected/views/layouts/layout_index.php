<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="ru" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <meta name="keywords" content="<?php if(isset($this->pageKeywords)) echo $this->pageKeywords; ?>" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.lightbox/css/jquery.lightbox-0.5.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style2.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery.ad-gallery/jquery.ad-gallery.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.ad-gallery.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.lightbox/css/jquery.lightbox-0.5.css" type="text/css" media="screen, projection" />
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.3.2.min.js"></script>
</head>
<body>
<div class="l-wrapper">
	<div class="pre-header"></div>
	<div class="l-header">
        <div class="logo">
            <a href="<?php echo Yii::app()->createUrl('main'); ?>" title="На главную" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.gif" alt="Студия дизайна Шар" width="150" height="150" id="logo" /></a>
        </div>

        <?php if (empty($this->pageTextInfo)) { ?>
            <ul class="header_foto_list">
                <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/foto1.jpg"  width="96" height="149" /></li>
                <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/foto2.jpg"  width="119" height="149" /></li>
                <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/foto3.jpg"  width="144" height="149" /></li>
            </ul>
        <?php } else { ?>
            <H1 class="header_name" ><?php echo $this->pageTextInfo;?></H1>
        <?php } ?>
	</div><!-- .l-header-->
	
	<div class="l-content">
		<div class="l-hline"></div>

        <?php echo $content; ?>

	</div><!-- .l-content-->

    <div class="l-footer">
        <div class="about">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_small.png" alt="Шар" width="222" height="15" />
        </div>
    </div><!-- .l-footer -->

    <?php require_once 'fix_png.php'; ?>
</div><!-- .l-wrapper -->

</body>
</html>