<div class="message-box message-box-warning animated fadeIn" id="ErrorFormMsg" style="display: none">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-warning"></span> 执行错误</div>
            <div class="mb-content">
                <p><span id="ErrorFormText"></span></p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default btn-lg pull-right mb-control-close" id="closeMsg">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="message-box message-box-success animated fadeIn" id="SuccessFormMsg" style="display: none">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-check"></span> 执行成功</div>
            <div class="mb-content">
                <p><span id="SuccessFormText"></span></p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default btn-lg pull-right mb-control-close" id="closeMsg">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('form').on('submit', function () {

        // error msg
        var ErrorMsg = $('#ErrorFormMsg');
        // success msg
        var SuccessMsg = $('#SuccessFormMsg');

        $(this).find('button').attr('disabled', true);

        $.ajax({

            url: $(this).attr('action'),
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),

            // 错误
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                SuccessMsg.hide();
                ErrorMsg.show().find('#ErrorFormText').text('访问网络失败 : ' + errorThrown);
                $(this).find(':submit').attr('disabled', false);
                return false;
            },

            // 成功
            success: function (data) {

                ErrorMsg.hide();

                if (data.status !== true) {

                    var html = '<ul>';
                    for (var key in data) {
                        html += '<li>' + data[key] + '</li>';
                    }
                    html += '</ul>';

                    ErrorMsg.show().find('#ErrorFormText').html(html);

                    // $(this).find('button').removeAttr('disabled');

                    return false;
                }

                SuccessMsg.show().find('#ErrorFormText').text(data.msg);
                location.href = "<?= $FormUrl; ?>";

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