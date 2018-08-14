<!-- danger with sound -->
<div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="ErrorFormMsg">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> 出错了!</div>
            <div class="mb-content">
                <p id="ErrorFormText"></p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default btn-lg pull-right mb-control-close" id="closeMsg">关闭</button>
            </div>
        </div>
    </div>
</div>
<!-- end danger with sound -->

<!-- success -->
<div class="message-box message-box-success animated fadeIn" id="message-box-success">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-check"></span> Success</div>
            <div class="mb-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at tellus sed mauris mollis pellentesque nec a ligula. Quisque ultricies eleifend lacinia. Nunc luctus quam pretium massa semper tincidunt. Praesent vel mollis eros. Fusce erat arcu, feugiat ac dignissim ac, aliquam sed urna. Maecenas scelerisque molestie justo, ut tempor nunc.</p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default btn-lg pull-right mb-control-close" id="closeMsg">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end success -->


<div class="row">
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