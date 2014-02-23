<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style-gallery.css" type="text/css" media="screen, projection" />
<script type="text/javascript" >
    $(document).ready(function(){
        var sudoSlider = $("#slider").sudoSlider({
            auto:true,
            prevNext:false,
            speed: 3000,
            pause: 4000,
            afterAnimation: function (t) {
//                if (t == sudoSlider.getValue("totalSlides")) {
//                    sudoSlider.stopAuto();
//                }
            }
        });
    });
</script>

<div class="menu-hline"><h1 class="g-fleft"><?php echo $article->header;?></h1>
    <?php if (!Yii::app()->user->isGuest) {
        echo ' ' . CHtml::link('редактировать', '/article/update/id/' . $article->id . '/' . '?returnUrl=' . $returnUrl, array('class'=>'link_article_edit'));
    } ?>

    <?php
        echo CHtml::link(Yii::t('app', 'link_home'), Yii::app()->createUrl('/main'), array('class' => 'g-fright home'));
    ?>
</div>

<!--<div class="gallery-album" >-->
    <div id="slider" >
        <ul>
            <li>
                <div class="gallery-album" >
    <?php
        $i = 0;
        $sepNum = 8;
        foreach($photoGalleryData as $row) {

            $path = "/images/articles/{$article->code}/{$row['code']}/";
            $src = Yii::app()->request->baseUrl . $path  . $row['main_logo_path'];
            $href = Yii::app()->createUrl('/page/interer/', array('activePage' => $row['number'], 'type' => $type, 'lang' => $article->lang));

            if ($i != 0 && (( $i ) %  $sepNum == 0) ) {
                echo '</div></li><li> <div class="gallery-album" >';
            }
    ?>
            <div class="album">
                <div class="album_photo">
                    <a href="<?php echo $href; ?>">
                        <img align="left" width="210" height="210" alt="" src="<?php echo $src?>">
                    </a>
                </div>
                <div class="album_descr">
                    <a class="album_link" href="<?php echo $href; ?>" title="<?php echo $row['descr']?>"><?php echo $row['descr']?></a>
                </div>
            </div>
        <?php
            $i++;
            if ($i % (4) == 0) {
                echo "</br>";
            }

        }; ?>
                </div>
            </li>
        </ul>
    </div>
<!--</div>-->
<?php
    //$this->widget('CGallery', array('path' => $path, 'files' => $files));
?>