<div class="message-box message-box-success animated fadeIn open" style="display: none;" id="successform">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-check"></span> 执行成功</div>
            <div class="mb-content">
                <p id="formMsgtext"></p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default btn-lg pull-right mb-control-close" onclick="closeMsg();">关闭</button>
            </div>
        </div>
    </div>
</div>

<div class="message-box message-box-danger animated fadeIn open" style="display: none;" id="errorform">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> 执行错误</div>
            <div class="mb-content">
                <p id="formMsgtext"></p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default btn-lg pull-right mb-control-close" onclick="closeMsg();">关闭</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function closeMsg() {
        $('#errorform').hide();
        $('#successform').hide();
        return true;
    }

    jQuery(document).ready(function () {

        $('#closemsg').on('click', function () {
            $('#errorform').hide();
        });

        $('#<?= $result['FormName']; ?>').on('submit', function () {

            var form = $(this);

            // 错误消息
            var errormsg = $('#errorform');

            // 成功消息
            var successmsg = $('#successform');

            // 获取 Input
            form.find(':submit').attr('disabled', true);

            jQuery.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                dataType: 'json',
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    errormsg.show().find('#formMsgtext').text(errorThrown);
                    form.find(':submit').attr('disabled', false);
                    return false;
                },

                // 执行成功
                success: function (data) {

                    if (data.status == true) {
                        successmsg.show().find('#formMsgtext').html(data.msg);

                        <?php if (!empty($result['Url'])): ?>
                        location.href = "<?= $result['Url']; ?>";
                        <?php endif; ?>

                        errormsg.hide();
                        return false;
                    }

                    // error
                    else {

                        var html = '<ul>';
                        for (var key in data) {
                            html += '<li>' + data[key] + '</li>';
                        }
                        html += '</ul>';

                        errormsg.show().find('#formMsgtext').html(html);
                        form.find(':submit').attr('disabled', false);
                        successmsg.hide();
                    }

                    return true;
                }
            });

            return false;
        });
    });
</script>