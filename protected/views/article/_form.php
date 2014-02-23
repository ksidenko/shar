<div class="article-form form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'carticle-form',
	'enableAjaxValidation'=>false,
)); ?>
    <br /> <!-- do not remove - its hack! :-) -->
    <?php
        //print_r(array_keys($articleModels)); die;

        foreach( $this->arrLanguages as $lang => $langName) {
            $model = $articleModels[$lang];
    ?>

        <fieldset class="g-fleft" style="width:420px; margin-right:30px; display: block;" >
            <?php echo CHtml::tag('legend', array('style' => 'color:white;'), $langName); ?>

        <?php echo $form->errorSummary($model); ?>
        
        <?php if (!$isSubArticle) { ?>
            <div class="row">
                <?php echo $form->labelEx($model,"[{$lang}]title"); ?>
                <?php echo $form->textField($model,"[{$lang}]title",array("maxlength"=>2048, "style"=>'width:100%')); ?>
                <?php echo $form->error($model,"[{$lang}]title"); ?>
            </div>
    
            <div class="row">
                <?php echo $form->labelEx($model,"[{$lang}]header"); ?>
                <?php echo $form->textField($model,"[{$lang}]header",array("maxlength"=>1024, "style"=>'width:100%')); ?>
                <?php echo $form->error($model,"[{$lang}]header"); ?>
            </div>
    
            <div class="row">
                <?php echo $form->labelEx($model,"[{$lang}]keyword"); ?>
                <?php echo $form->textArea($model,"[{$lang}]keyword",array("rows"=>4, "style"=>'width:100%')); ?>
                <?php echo $form->error($model,"[{$lang}]keyword"); ?>
            </div>

        <?php } ?>
            
        <div class="row">
            <?php echo $form->labelEx($model,"[{$lang}]descr"); ?>
            <?php echo $form->textArea($model,"[{$lang}]descr",array('rows' => 4, "style"=>'width:100%')); ?>
            <?php echo $form->error($model,"[{$lang}]descr"); ?>
        </div>

        </fieldset>
    <?php } ?>

    <div style="clear:both;" ></div>

    <?php if ($isSubArticle) { ?>
        <div class="row">
            <?php echo $form->labelEx($model,"number"); ?>
            <?php //TODO
                echo $form->dropDownList($model,"number", array_combine(range(1,30), range(1,30)), array("maxlength"=>5));
            ?>
            <?php echo $form->error($model,"number"); ?>
        </div>
    <?php } ?>

    <?php if (!$isSubArticle) { ?>
        <div class="row">
            <?php echo $form->labelEx($model,"img_big_h"); ?>
            <?php echo $form->textField($model,"img_big_h",array("size"=>5,"maxlength"=>5)); ?>
            <?php echo $form->error($model,"img_big_h"); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,"img_thumb_h"); ?>
            <?php echo $form->textField($model,"img_thumb_h",array("size"=>5,"maxlength"=>5)); ?>
            <?php echo $form->error($model,"img_thumb_h"); ?>
        </div>
    <?php } ?>

    <?php echo $form->hiddenField($model,"parent_id"); ?>

    <?php
        if (!empty($subarticles)) {
            $s = '';

            foreach($subarticles as $subarticle) {

                //todo
                //$sDel = ' | ' . CHtml::link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '/article/delete/id/' . $subarticle->id . '/'. '?returnUrl=' . $this->returnUrl, array('class' => 'link_article_del', 'confirm' => 'Внимание! Операция не обратима! Вы действительно хотите удалить страницу?') );
                $sDel = '';

                $sEdit = CHtml::link('редактировать', '/article/update/id/' . $subarticle->id . '/' . '?returnUrl=' . $this->returnUrl, array('class' => 'link_article_edit'));

                $s .= '<li style="color:white;" >' . 'Страница ' . $subarticle->number . '&nbsp;&nbsp;&nbsp;&nbsp;' . $sEdit . $sDel . '</li>';
            }
            if (!empty($s)) {
                echo "<ul>$s</ul>";
            }

            $sAdd = CHtml::link('добавить страницу', '/article/create/parent_id/' . $model->id . '?returnUrl=' . $this->returnUrl, array('class' => 'link_article_add'));
            echo $sAdd;
        }
    ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
        <?php echo CHtml::submitButton('Отменить', array('name' => 'cancel') )?>
    </div>

    <?php $this->endWidget(); ?>

    <?php
    if (empty($subarticles) && !empty($path)) {
        $this->widget('CGallery', array('edit' => true, 'path' => $path, 'files' => $files, 'model'=>$model,));
    }
    ?>

</div><!-- form -->