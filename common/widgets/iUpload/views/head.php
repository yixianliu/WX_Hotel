<style>
    #clipArea {
        margin: 20px;
        height: 300px;
    }

    #file,
    #clipBtn {
        margin: 20px;
    }

    #view {
        margin: 0 auto;
        width: 200px;
        height: 200px;
    }
</style>

<div id="view"></div>
<div id="clipArea"></div>
<input type="file" id="file">
<div id="clipBtn" class="btn btn-primary">获取头像</div>

<div class="container">

    <div class="static-notification bg-green-dark" style="display: none;" id="SuccessFormMsg">
        <h6><i class="fa fa-check static-notification-icon"></i>执行成功 !!</h6>
        <a class="static-notification-close" href="#"><i class="fa fa-times"></i></a>
        <p>
            <span id="formMsgText"></span>
        </p>
    </div>

    <div class="static-notification bg-red-dark" style="display: none;" id="ErrorFormMsg">
        <h6><i class="fa fa-times-circle static-notification-icon"></i>执行错误 !!</h6>
        <a class="static-notification-close" href="#"><i class="fa fa-times"></i></a>
        <p>
            <span id="formMsgText"></span>
        </p>
    </div>

</div>

<script type="text/javascript">

    $(function () {

        var clipArea = new bjj.PhotoClip("#clipArea", {
            size: [260, 260],
            outputSize: [640, 640],
            file: "#file",
            view: "#view",
            ok: "#clipBtn",
            loadStart: function () {
                console.log("头像读取中...");
            },
            loadComplete: function () {
                console.log("头像读取完成");
            },
            clipFinish: function (dataURL) {

                console.log(dataURL);

                $("#UserId").attr('value', dataURL);

                $("#<?= $FormId?>").on('submit', function () {

                    var form = $(this);
                    var SuccessFormMsg = $('#SuccessFormMsg');
                    var ErrorFormMsg = $('#ErrorFormMsg');

                    // 获取 Input Submit
                    form.find(':submit').attr('disabled', true);

                    $.ajax({
                        url: form.attr('action'),
                        type: 'post',
                        data: form.serialize(),
                        dataType: 'json',
                        async: false,
                        error: function (XMLHttpRequest, textStatus, errorThrown) {

                            // 显示错误
                            ErrorFormMsg.show().find('#formMsgText').text(errorThrown);
                            form.find(':submit').attr('disabled', false);
                            return false;
                        },

                        // 执行成功
                        success: function (data) {

                            if (data.status == true) {

                                SuccessFormMsg.show().find('#formMsgText').html('<font>' + data.msg + '</font>');
                                location.href = "<?= $FormUrl; ?>";
                                ErrorFormMsg.hide();

                                return false;
                            }

                            // error
                            else {

                                var html = '<ul>';
                                for (var key in data) {
                                    html += '<li>' + data[key] + '</li>';
                                }
                                html += '</ul>';

                                ErrorFormMsg.show().find('#formMsgText').html(html);
                                form.find(':submit').attr('disabled', false);
                                SuccessFormMsg.hide();
                            }

                            return false;
                        }
                    });

                    return false;
                });

                return false;
            }
        });

//        clipArea.destroy();

    });

</script>