<script type="text/javascript">
    function urldecode(str) {
        return decodeURIComponent((str+'').replace(/\+/g, '%20'));
    }

    function addEvent(li){
        li.find('.del').click(function(){
            var li = $(this).closest('li');
            var photo_id = li.attr('id');

            if ( confirm('Вы действительно хотите удалить изображение?') ) {
                $.ajax({
                    url: '/photo/delete/id/' + photo_id,
                    dataType: 'json',
                    type: 'POST',
                    success: function (data, status) {
                        if (typeof(data.error) != 'undefined') {
                            if (data.error != '') {
                                alert(data.error);
                            } else {
                                li.fadeOut("slow");
                            }
                        }
                    },
                    error:function (data, status, e) {
                        alert(e);
                    }
                });
            }
            return false;
        });

        li.mouseenter(function() {
            $(this).addClass('active');
        }).mouseleave(function() {
                $(this).removeClass('active');
        });
    }

    function ajaxFileUploadMainPhoto(elem_id, article_id) {
        //starting setting some animation when the ajax starts and completes
        $("#loading")
            .ajaxStart(function () {
                $(this).show();
            })
            .ajaxComplete(function () {
                $(this).hide();
            });

        if ($('#'+elem_id).val() == '') return false;

        $.ajaxFileUpload({
            url:'/photo/createMainPhoto?article_id=' + article_id,
            secureuri:false,
            fileElementId: elem_id,
            dataType:'json',
            success:function (data, status) {
                if (typeof(data.error) != 'undefined') {
                    if (data.error != '') {
                        var s = data.error;
                        alert(s);
                    } else {
                        //alert(data.msg);
                        var img = $(urldecode(data.html)).hide();

                        var img_block = $('div.main_photo .main_photo_img');
                        if (img_block.length > 0) {
                            img_block.attr('src', img.attr('src'));
                        } else {
                            $('div.main_photo').prepend(img);
                        }

                        img.fadeIn("slow");

                        $('#'+elem_id).val('');
                    }
                }
            },
            error:function (data, status, e) {
                alert(e);
            }
        })
        return false;
    }

    function ajaxFileUpload(elem_id, article_id) {
        //starting setting some animation when the ajax starts and completes
        $("#loading")
            .ajaxStart(function () {
                $(this).show();
            })
            .ajaxComplete(function () {
                $(this).hide();
            });

        if ($('#'+elem_id).val() == '') return false;

        $.ajaxFileUpload({
            url:'/photo/create?article_id=' + article_id,
            secureuri:false,
            fileElementId: elem_id,
            dataType:'json',
            success:function (data, status) {
                if (typeof(data.error) != 'undefined') {
                    if (data.error != '') {

                        var s = data.error;
                        alert(s);
                    } else {
                        //alert(data.msg);
                        var li = $(urldecode(data.html)).hide();
                        $('.image_preview ul').append(li);
                        li.fadeIn("slow");
                        addEvent(li);
                        $('#'+elem_id).val('');
                    }
                }
            },
            error:function (data, status, e) {
                alert(e);
            }
        })
        return false;
    }


//    function ajaxFileUploadArchive(elem_id, article_id) {
//        //starting setting some animation when the ajax starts and completes
//        $("#loading")
//            .ajaxStart(function () {
//                $(this).show();
//            })
//            .ajaxComplete(function () {
//                $(this).hide();
//            });
//
//        if ($('#'+elem_id).val() == '') return false;
//
//        //if ( confirm('Все существующие изображения будут заменены, вы точно этого хотите?') ) {
//            $.ajaxFileUpload({
//                url:'/photo/uploadPhotoArchive?CPhoto[article_id]=' + article_id,
//                secureuri:false,
//                fileElementId: elem_id,
//                dataType:'json',
//                success:function (data, status) {
//                    if (typeof(data.error) != 'undefined') {
//                        if (data.error != '') {
//
//                            var s = '';
//                            for(var i in data.error) {
//                                s += data.error[i]  + '\n';
//                            }
//                            alert(s);
//                        } else {
//                            //alert(data.msg);
//                            $('.image_preview li').remove();
//                            var lis = $(urldecode(data.html));
//                            lis.appendTo($('.image_preview'));
//
//                            $.each('.image_preview li', function () {
//                                addEvent($(this));
//                            });
//
//                            $('#'+elem_id).val('');
//                        }
//                    }
//                },
//                error:function (data, status, e) {
//                    alert(e);
//                }
//            });
//        //}
//        return false;
//    }

    $(function(){
        $('#buttonUploadMainPhoto').click(function(){
            ajaxFileUploadMainPhoto('CPhoto_main_photo_path', $('#article_id').val());
        });

        $('#buttonUpload').click(function(){
            ajaxFileUpload('CPhoto_path', $('#article_id').val());
        });

//        $('#buttonUploadArchive').click(function(){
//            ajaxFileUploadArchive('CPhoto_path', $('#article_id').val());
//            return false;
//        });


        $('.image_preview').find('li').each(function () {
            addEvent($(this));
        });
    });
</script>
<div class="main_photo">
    <?php

    $mainPhotoPath = '';
    if (!empty($this->model->photo_main) && !empty($this->model->photo_main->path) ) {
        $mainPhotoPath = $this->model->photo_main->path;
        echo Helpers::renderMainPhotoImage($this->path, $mainPhotoPath);
    }

    echo CHtml::hiddenField('article_id', $this->model->id);

    echo '<br/>' . CHtml::activeFileField(CPhoto::model(), 'main_photo_path', array('class' => 'input'));
    echo '<br/>' . CHtml::submitButton('Изменить главное изображение', array('id' => "buttonUploadMainPhoto") );
    ?>
</div>

<div class="image_preview">
    <ul>
    <?php
        foreach( $this->files as $file) {
            $li = Helpers::renderImageBlock ($this->path, $file->path, $file->id);
            echo $li . PHP_EOL;
        }
    ?>
    </ul>
    <div class="g-clear"></div>
</div>
<br/>
<div>
    <?php
        echo CHtml::hiddenField('article_id', $this->model->id);

        echo CHtml::activeFileField(CPhoto::model(), 'path', array('class' => 'input'));
        echo CHtml::submitButton('Добавить изображение', array('id' => "buttonUpload") );
    ?>
</div>




        <?php
            //echo CHtml::activeFileField(CPhoto::model(), 'path', array('class' => 'input'));
            //echo CHtml::submitButton('Добавить архив с изображениями', array('id' => "buttonUploadArchive") );
        ?>
<!--    <form name="form" action="" method="POST" enctype="multipart/form-data">-->
<!--        <table cellpadding="0" cellspacing="0" class="tableForm">-->
<!---->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th>Ajax File Upload</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--                <td><input id="CPhoto_path" type="file" size="45" name="CPhoto_path" class="input"></td>-->
<!---->
<!---->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>Please select a file and click Upload button</td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--            <tfoot>-->
<!--            <tr>-->
<!--                <td><button class="button" id="buttonUploadArchive" >Upload</button></td>-->
<!--            </tr>-->
<!--            </tfoot>-->
<!---->
<!--        </table>-->
<!--    </form>-->


