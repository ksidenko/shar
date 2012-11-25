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
            url:'/photo/create?CPhoto[article_id]=' + article_id,
            secureuri:false,
            fileElementId: elem_id,
            dataType:'json',
            success:function (data, status) {
                if (typeof(data.error) != 'undefined') {
                    if (data.error != '') {

                        var s = '';
                        for(var i in data.error) {
                            s += data.error[i]  + '\n';
                        }
                        alert(s);
                    } else {
                        //alert(data.msg);
                        var li = $(urldecode(data.html)).hide();
                        li.insertAfter($('.image_preview li:last'));
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


    function ajaxFileUploadArchive(elem_id, article_id) {
        //starting setting some animation when the ajax starts and completes
        $("#loading")
            .ajaxStart(function () {
                $(this).show();
            })
            .ajaxComplete(function () {
                $(this).hide();
            });

        if ($('#'+elem_id).val() == '') return false;

        //if ( confirm('Все существующие изображения будут заменены, вы точно этого хотите?') ) {
            $.ajaxFileUpload({
                url:'/photo/uploadPhotoArchive?CPhoto[article_id]=' + article_id,
                secureuri:false,
                fileElementId: elem_id,
                dataType:'json',
                success:function (data, status) {
                    if (typeof(data.error) != 'undefined') {
                        if (data.error != '') {

                            var s = '';
                            for(var i in data.error) {
                                s += data.error[i]  + '\n';
                            }
                            alert(s);
                        } else {
                            //alert(data.msg);
                            $('.image_preview li').remove();
                            var lis = $(urldecode(data.html));
                            lis.appendTo($('.image_preview'));

                            $.each('.image_preview li', function () {
                                addEvent($(this));
                            });

                            $('#'+elem_id).val('');
                        }
                    }
                },
                error:function (data, status, e) {
                    alert(e);
                }
            });
        //}
        return false;
    }

    $(function(){
        $('#buttonUpload').click(function(){
            ajaxFileUpload('CPhoto_path', $('#article_id').val());
        });

        $('#buttonUploadArchive').click(function(){
            ajaxFileUploadArchive('CPhoto_pathArchive', $('#article_id').val());
        });


        $('.image_preview').find('li').each(function () {
            addEvent($(this));
        });
    });
</script>
<div class="image_preview">
    <?php
        foreach( $this->files as $file) {
            $li = Helpers::renderImageBlock ($this->path, $file->path, $file->id);
            echo $li . PHP_EOL;
        }
    ?>
    <div class="g-clear"></div>
</div>
<br/>
<div>
    <?php
        echo CHtml::hiddenField('article_id', $this->model->id);

        echo CHtml::activeFileField(CPhoto::model(), 'path', array('class' => 'input'));
        echo CHtml::submitButton('Добавить изображение', array('id' => "buttonUpload") );

        echo '<br>';
        echo CHtml::activeFileField(CPhoto::model(), 'pathArchive', array('class' => 'input'));
        echo CHtml::submitButton('Добавить архив с изображениями', array('id' => "buttonUploadArchive") );
    ?>
</div>
