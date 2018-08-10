<?php

/**
 * @abstract iMsg UI
 * @author Yxl <zccem@163.com>
 */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>

<div class="sidebar-divider" style="word-spacing:8px; letter-spacing: 2px;font-weight: 400;">未读私信</div>

<div class="blog-sidebar-recent-posts full-bottom">
    <div class="blog-sidebar-text" style="padding-left: 10px;line-height: 18px;">

        <a href="page-blog-post.html" style="font-family: 'Microsoft YaHei';font-size: 14px;">
            <span>脑洞老师蒋柳是公众号「脑洞历史观」的运营者</span>
            <em style="margin-top: 5px;">Jul 15th 2024</em>
            <i class="fa fa-angle-right"></i>
        </a>
        <a href="page-blog-post.html" style="font-family: 'Microsoft YaHei';font-size: 14px;">
            <span>脑洞老师蒋柳是公众号「脑洞历史观」的运营者</span>
            <em style="margin-top: 5px;">Jul 15th 2024</em>
            <i class="fa fa-angle-right"></i>
        </a>

    </div>
</div>

<div class="sidebar-divider" style="word-spacing:8px; letter-spacing: 2px;font-weight: 400;">未读评论</div>

<div class="blog-sidebar-recent-posts full-bottom">
    <div class="blog-sidebar-text" style="padding-left: 10px;line-height: 18px;">

        <a href="page-blog-post.html" style="font-family: 'Microsoft YaHei';font-size: 14px;">
            <span>脑洞老师蒋柳是公众号「脑洞历史观」的运营者</span>
            <em style="margin-top: 5px;">Jul 15th 2024</em>
            <i class="fa fa-angle-right"></i>
        </a>
        <a href="page-blog-post.html" style="font-family: 'Microsoft YaHei';font-size: 14px;">
            <span>脑洞老师蒋柳是公众号「脑洞历史观」的运营者</span>
            <em style="margin-top: 5px;">Jul 15th 2024</em>
            <i class="fa fa-angle-right"></i>
        </a>

    </div>
</div>

<div class="sidebar-divider">
    Send us a message
</div>

<div class="container no-bottom">
    <div class="sidebar-form contact-form no-bottom">

        <em>
            Your message is important to us and we reply to all of them in less than 48 hours.
        </em>

        <div class="formSuccessMessageWrap" id="formSuccessMessageWrap">
            Awesome! We'll get back to you!
        </div>

        <form action="php/contact.php" method="post" class="contactForm" id="contactForm">
            <fieldset>
                <div class="formValidationError" id="contactNameFieldError">Name is required!</div>
                <div class="formValidationError" id="contactEmailFieldError">Mail address required!</div>
                <div class="formValidationError" id="contactEmailFieldError2">Mail address must be valid!</div>
                <div class="formValidationError" id="contactMessageTextareaError">Message field is empty!</div>
                <div class="formFieldWrap">
                    <input onfocus="if (this.value == 'Name')
                                this.value = ''" onblur="if (this.value == '')
                                            this.value = 'Name'" type="text" name="contactNameField" value="Name" class="contactField requiredField" id="contactNameField"/>
                </div>
                <div class="formFieldWrap">
                    <input onfocus="if (this.value == 'Email')
                                this.value = ''" onblur="if (this.value == '')
                                            this.value = 'Email'" type="text" name="contactEmailField" value="Email" class="contactField requiredField requiredEmailField" id="contactEmailField"/>
                </div>
                <div class="formTextareaWrap">
                    <textarea onfocus="if (this.value == 'Message')
                                this.value = ''" onblur="if (this.value == '')
                                            this.value = 'Message'" name="contactMessageTextarea" class="contactTextarea requiredField" id="contactMessageTextarea">Message</textarea>
                </div>
                <div class="formSubmitButtonErrorsWrap">
                    <input type="submit" class="buttonWrap button button-green contactSubmitButton" id="contactSubmitButton" value="SUBMIT" data-formId="contactForm"/>
                </div>
            </fieldset>
        </form>
    </div>
</div>
