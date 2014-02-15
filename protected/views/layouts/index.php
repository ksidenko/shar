<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="ru" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <meta name="keywords" content="<?php if(isset($this->pageKeywords)) echo $this->pageKeywords; ?>" />
    <meta name="description" content="<?php if(isset($this->pageDescription)) echo $this->pageDescription; ?>" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.lightbox/css/jquery.lightbox-0.5.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style2.css?15022014" type="text/css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery.ad-gallery/jquery.ad-gallery.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.ad-gallery.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.lightbox/css/jquery.lightbox-0.5.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" type="text/css" media="screen, projection" />
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.3.2.min.js"></script>
</head>
<body>

<?php if(Yii::app()->user->hasFlash('success')){ ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php } ?>
<?php if(Yii::app()->user->hasFlash('error')){ ?>
<div class="flash-error">
    <?php echo Yii::app()->user->getFlash('error'); ?>
</div>
<?php } ?>


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
	<div class="metrika" >
        <!-- Yandex.Metrika informer -->
        <a href="http://metrika.yandex.ru/stat/?id=23965012&amp;from=informer"
           target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/23965012/1_0_999387FF_797367FF_0_pageviews"
                                               style="width:80px; height:15px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры)" /></a>
        <!-- /Yandex.Metrika informer -->

        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter23965012 = new Ya.Metrika({id:23965012,
                            webvisor:true,
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true});
                    } catch(e) { }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
            })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="//mc.yandex.ru/watch/23965012" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
	</div>
    </div><!-- .l-footer -->

    <?php  $this->widget('CFixPng', array()); ?>
</div><!-- .l-wrapper -->

</body>
</html>