<!--dom结构部分-->
<div id="uploader-demo">

    <!--用来存放item-->
    <div id="fileList" class="uploader-list"></div>
    <div id="filePicker" class="col-md-12 col-xs-12">选择图片</div>

    <div id="inputFileId">

        <?php if (!empty($result)): ?>
            <?php foreach ($result as $value): ?>
                <div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <?php if ($config['imageHiddenInput'] == false): ?>
        <input type="hidden" id="imgMaster" name="imgMaster" value=""/>
        <input type="hidden" id="imgPath" name="imgPath" value=""/>
    <?php endif; ?>

</div>

<div class="help-block"></div>

<script type="text/javascript">

    jQuery(function () {

        var $ = jQuery,

            $list = $('#fileList'),

            // 优化retina, 在retina下这个值是2
            ratio = window.devicePixelRatio || 1,

            // 缩略图大小
            thumbnailWidth = 100 * ratio,
            thumbnailHeight = 100 * ratio,

            // Web Uploader实例
            uploader;

        uploader = WebUploader.create({
            auto: true,
            // swf文件路径
            swf: "<?= $config['domain_url']; ?>/statics/Uploader.swf",
            // 文件接收服务端。
            server: "<?= $config['serverUrl']; ?>",
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            // 只允许选择文件，可选。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            fileSingleSizeLimit: <?= $config['imageMaxSize']; ?> * 1024 * 1024,
    })



        // 当有文件添加进来的时候
        uploader.on('fileQueued', function (file) {

            var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail col-md-1 col-xs-4" style="margin-right: 4px;">' +
                '   <img>' +
                '</div>'
                ),
                $img = $li.find('img');

            // $list为容器jQuery实例
            $list.append($li);

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb(file, function (error, src) {

                if (error) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr('src', src);

            }, thumbnailWidth, thumbnailHeight);
        });

        // 文件上传过程中创建进度条实时显示。
        uploader.on('uploadProgress', function (file, percentage) {

            var $li = $('#' + file.id),
                $percent = $li.find('.progress span');

            // 避免重复创建
            if (!$percent.length) {
                $percent = $('<p class="progress"><span></span></p>')
                    .appendTo($li)
                    .find('span');
            }

            $percent.css('width', percentage * 100 + '%');
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on('uploadSuccess', function (file, ret) {

            <?php if ($config['imageHiddenInput'] == false): ?>

            if (ret.result.uploadDir != null) {
                $("#imgPath").val(ret.result.uploadDir);
            }

            var html = '<div><a href="#" id="' + ret.result.filename + '" onclick="imgClickMaster(this);">设为主图</a></div>';

            $('#' + file.id).append(html);

            <?php endif; ?>

            return true;
        });

        // 文件上传失败，显示上传出错。
        uploader.on('uploadError', function (file, reason) {

            var $li = $('#' + file.id),
                $error = $li.find('div.error');

            // 避免重复创建
            if (!$error.length) {
                $error = $('<div class="text-danger"></div>').appendTo($li);
            }

            $error.html('<font style="color: #d43f3a;font-size: 10px;">上传失败...</font>');

            return true;
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on('uploadComplete', function (file) {
            $('#' + file.id).find('.progress').remove();
        });

    });

    function imgClickMaster(imgid) {
        var imgid = $(imgid).attr("id");
        $("#imgMaster").val(imgid);
        return true;
    }
</script>