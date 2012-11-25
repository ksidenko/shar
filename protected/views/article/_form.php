<div class="article-form form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'carticle-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'code'); ?>
		<?php //echo $form->textField($model,'code',array('size'=>60,'maxlength'=>512)); ?>
<!--		--><?php //echo $form->error($model,'code'); ?>
<!--	</div>-->

    <div class="row">
        <?php echo $form->labelEx($model,'lang'); ?>
        <?php echo $form->dropDownList($model,'lang',array('ru' => 'Русский', 'en' => 'Английский'), array('style' => 'display:none')); ?>
        <?php
        $arr = array('ru' => 'Русский', 'en' => 'Английский');
        echo $arr[$model->lang]; ?>
        <?php echo $form->error($model,'lang'); ?>
    </div>



    <?php if (!$model->isSubArticle()) { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>2048)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>


    <div class="row">
        <?php echo $form->labelEx($model,'header'); ?>
        <?php echo $form->textField($model,'header',array('size'=>60,'maxlength'=>1024)); ?>
        <?php echo $form->error($model,'header'); ?>
    </div>

    <!--	<div class="row">-->
    <!--		--><?php //echo $form->labelEx($model,'meta'); ?>
            <?php //echo $form->textField($model,'meta',array('size'=>60,'maxlength'=>2048)); ?>
    <!--		--><?php //echo $form->error($model,'meta'); ?>
    <!--	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'keyword'); ?>
		<?php echo $form->textArea($model,'keyword',array('rows'=>3, 'cols'=>50)); ?>
		<?php echo $form->error($model,'keyword'); ?>
	</div>
    <?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'descr'); ?>
        <?php echo $form->textArea($model,'descr',array('rows'=>3, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descr'); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'dt_create'); ?>
		<?php //echo $form->textField($model,'dt_create'); ?>
<!--		--><?php //echo $form->error($model,'dt_create'); ?>
<!--	</div>-->

    <?php if (!$model->isSubArticle()) { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'img_big_h'); ?>
		<?php echo $form->textField($model,'img_big_h',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'img_big_h'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'img_thumb_h'); ?>
		<?php echo $form->textField($model,'img_thumb_h',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'img_thumb_h'); ?>
	</div>
    <?php } ?>

    <?php
        if (!empty($subarticles)) {
            $s = '';

            //TODO
            //$sAdd = CHtml::link('добавить', '/article/create/parent_id/' . $model->id);
            $sAdd = '';

            foreach($subarticles as $subarticle){
                //TODO
                //$sDel = ' | ' . CHtml::link('удалить', '/article/delete/id/' . $subarticle->id, array('class' => 'link_article_del') );
                $sDel = '';

                $sEdit = CHtml::link('редактировать', '/article/update/id/' . $subarticle->id . '/lang/' . $subarticle->lang  . '?returnUrl=' . $returnUrl, array('class' => 'link_article_edit'));

                $s .= '<li style="color:white;" >' . 'Страница ' . $subarticle->code . '&nbsp;&nbsp;&nbsp;&nbsp;' . $sEdit . $sDel . '</li>';
            }
            if (!empty($s)) {
                echo "<ul>$s</ul>";
            }
            echo $sAdd;
        }
    ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

<?php $this->endWidget(); ?>

    <?php
    if (empty($subarticles)) {
        $this->widget('CGallery', array('edit' => true, 'path' => $path, 'files' => $files, 'model'=>$model,));
    } ?>

</div><!-- form -->