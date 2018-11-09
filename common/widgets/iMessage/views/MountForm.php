<div class="alert alert-danger" id="ErrorFormMsg" style="display: none;">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
    <strong>执行错误 !!</strong> <span id="ErrorFormText"></span>
</div>

<div class="alert alert-success" id="SuccessFormMsg" style="display: none;">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
    <strong>执行成功 !!</strong> <span id="successform_text"></span>
</div>

<div class="alert alert-info" id="beforMsg" style="display: none;">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
    <strong>请注意 !!</strong> 正在执行,切勿关闭网页,否则后果自负...
</div>

<script type="text/javascript">

    $("#<?= $result['FormName']; ?>").on('submit', function () {

        var form = $(this);

        var ErrorMsg = $('#ErrorFormMsg'); // error msg
        var SuccessMsg = $('#SuccessFormMsg');  // success msg

        $('#beformsg').show();

        form.find(':submit').attr('disabled', true);

        $.ajax({
            url: form.attr('action'),
            type: 'post',
            dataType: 'json',
            data: form.serialize(),

            // 错误
            error: function (XMLHttpRequest, textStatus, errorThrown) {

                SuccessMsg.hide();
                $('#beformsg').hide();

                ErrorMsg.show().find('#ErrorFormText').text('访问网络失败 : ' + errorThrown);
                form.find(':submit').attr('disabled', false);
                return false;
            },

            // 成功
            success: function (data) {

                ErrorMsg.hide();

                $('#beforMsg').hide();

                if (data.status !== true) {

                    var html = '<ul>';
                    for (var key in data) {
                        html += '<li>' + data[key] + '</li>';
                    }
                    html += '</ul>';

                    ErrorMsg.show().find('#ErrorFormText').html(html);
                    form.find(':submit').attr('disabled', false);
                    return false;
                }

                SuccessMsg.show().find('#ErrorFormText').text(data.msg);
                location.href = "<?= $result['Url']; ?>";

                return false;
            }

        });

        return false;
    });

    // Close Msg
    $("#closeMsg").on('click', function () {
        $('.message-box').slideDown("slow").hide();
    });

</script>