<div class="ad-gallery">
    <div class="ad-image-wrapper"></div>

    <div class="ad-controls"></div>

    <div class="ad-nav">
        <div class="ad-thumbs">
            <ul class="ad-thumb-list">
                <?php
                    foreach( $this->files as $file) {
                        $fileName = $file->path;
                        $id = $file->id;

                        $src = Yii::app()->request->baseUrl . $this->path . "/thumbs/$fileName";
                        $img = CHtml::image( $src, '', array('height' => 104));
                        $link = CHtml::link( $img, Yii::app()->request->baseUrl . $this->path . "/big/$fileName", array());
                        $li = CHtml::tag('li', array(), $link);
                        echo $li . PHP_EOL;
                    }
                ?>
            </ul>
        </div>
    </div>
</div>