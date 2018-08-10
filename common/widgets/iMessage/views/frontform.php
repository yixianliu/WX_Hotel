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

    $('#closemsg').on('click', function () {
        $('#errorform').hide();
    });

    // 提交事件控制
    $('#<?= $result['FormName']; ?>').on('submit', function () {

        var form = $(this);
        var SuccessFormMsg = $('#SuccessFormMsg');
        var ErrorFormMsg = $('#ErrorFormMsg');

        // 获取 Input Submit
        form.find(':submit').attr('disabled', true);

        // Ajax
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
                    location.href = "<?= $result['Url']; ?>";
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
</script>
