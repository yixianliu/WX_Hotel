<?php

/**
 * @abstract 关于我们模板
 * @author Yxl <zccem@163.com>
 */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "工作室团队";
?>

<div>
    <div class="content-md container">
        <!-- Heading v1 -->
        <div class="heading-v1 text-center margin-b-80">
            <h2 class="heading-v1-title" style="font-style: normal;font-family: 'Microsoft YaHei';"><?= Html::encode($this->title) ?> - 成员</h2>
            <p class="heading-v1-text">Let's share the News and best articles</p>
        </div>
        <!-- End Heading v1 -->

        <div class="row margin-b-80">
            <div class="col-md-4 md-margin-b-30">
                <!-- News v8 -->
                <article class="news-v8">
                    <div class="news-v8-img-effect">
                        <img class="img-responsive" src="<?php echo Yii::getAlias('@views'); ?>/img/970x647/50.jpg" alt="">
                        <div class="news-v8-img-effect-center-align">
                            <div class="theme-icons-wrap">
                                <a class="image-popup-vertical-fit" href="<?php echo Yii::getAlias('@views'); ?>/img/970x647/50.jpg" title="">
                                    <i class="theme-icons theme-icons-white-bg theme-icons-md radius-3 icon-focus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--// end image effect -->
                    <div class="news-v8-wrap">
                        <div class="news-v8-content">
                            <span class="news-v8-category" style="font-style: normal;font-family: 'Microsoft YaHei';">陈志强</span>
                            <h2 class="news-v8-title"><a href="#">Lorem ipsum dolor sit amet consectetur</a></h2>
                        </div>
                        <div class="news-v8-footer">
                            <ul class="list-inline news-v8-footer-list">
                                <li class="news-v8-footer-list-item">
                                    <i class="news-v8-footer-list-icon icon-profile-male"></i>
                                    <a class="news-v8-footer-list-link" href="#" style="font-style: normal;font-family: 'Microsoft YaHei';">个人档案</a>
                                </li>
                                <li class="news-v8-footer-list-item">
                                    <i class="news-v8-footer-list-icon icon-clock"></i>
                                    23/01/2016
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--// end wrap -->
                    <div class="news-v8-more">
                        <h3 class="news-v8-more-link" style="font-style: normal;font-family: 'Microsoft YaHei';">自我介绍</h3>
                        <div class="news-v8-more-info">
                            <div class="news-v8-more-info-body">
                                <div class="margin-b-20">
                                    <h4 class="news-v8-more-info-title">陈志强</h4>
                                    <span class="news-v8-more-info-subtitle">从事PHP开发已有3年.</span>
                                </div>
                                <h4 class="news-v8-more-info-title">Ark exceeds expectations</h4>
                                <p class="news-v8-more-info-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                    </div>
                    <!--// end more -->
                </article>
                <!-- End News v8 -->
            </div>
            <div class="col-md-4 md-margin-b-30">
                <!-- News v8 -->
                <article class="news-v8">
                    <div class="news-v8-img-effect">
                        <img class="img-responsive" src="<?php echo Yii::getAlias('@views'); ?>/img/970x647/51.jpg" alt="">
                        <div class="news-v8-img-effect-center-align">
                            <div class="theme-icons-wrap">
                                <a class="image-popup-vertical-fit" href="<?php echo Yii::getAlias('@views'); ?>/img/970x647/51.jpg" title="">
                                    <i class="theme-icons theme-icons-white-bg theme-icons-md radius-3 icon-focus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--// end image effect -->
                    <div class="news-v8-wrap">
                        <div class="news-v8-content">
                            <span class="news-v8-category">Creativity</span>
                            <h2 class="news-v8-title"><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
                        </div>
                        <div class="news-v8-footer">
                            <ul class="list-inline news-v8-footer-list">
                                <li class="news-v8-footer-list-item">
                                    <i class="news-v8-footer-list-icon icon-profile-male"></i>
                                    <a class="news-v8-footer-list-link" href="#">Alex Nelson</a>
                                </li>
                                <li class="news-v8-footer-list-item">
                                    <i class="news-v8-footer-list-icon icon-clock"></i>
                                    23/01/2016
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--// end wrap -->
                    <div class="news-v8-more">
                        <h3 class="news-v8-more-link">Quick Info</h3>
                        <div class="news-v8-more-info">
                            <div class="news-v8-more-info-body">
                                <div class="margin-b-20">
                                    <h4 class="news-v8-more-info-title">Feel the experience</h4>
                                    <span class="news-v8-more-info-subtitle">Advanced experience</span>
                                </div>
                                <h4 class="news-v8-more-info-title">Ark exceeds expectations</h4>
                                <p class="news-v8-more-info-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                    </div>
                    <!--// end more -->
                </article>
                <!-- End News v8 -->
            </div>
            <div class="col-md-4 md-margin-b-30">
                <!-- News v8 -->
                <article class="news-v8">
                    <div class="news-v8-img-effect">
                        <img class="img-responsive" src="<?php echo Yii::getAlias('@views'); ?>/img/970x647/52.jpg" alt="">
                        <div class="news-v8-img-effect-center-align">
                            <div class="theme-icons-wrap">
                                <a class="image-popup-vertical-fit" href="<?php echo Yii::getAlias('@views'); ?>/img/970x647/52.jpg" title="">
                                    <i class="theme-icons theme-icons-white-bg theme-icons-md radius-3 icon-focus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--// end image effect -->
                    <div class="news-v8-wrap">
                        <div class="news-v8-content">
                            <span class="news-v8-category">Development</span>
                            <h2 class="news-v8-title"><a href="#">Ut enim ad minim veniam, quis nostrud</a></h2>
                        </div>
                        <div class="news-v8-footer">
                            <ul class="list-inline news-v8-footer-list">
                                <li class="news-v8-footer-list-item">
                                    <i class="news-v8-footer-list-icon icon-profile-male"></i>
                                    <a class="news-v8-footer-list-link" href="#">Alex Nelson</a>
                                </li>
                                <li class="news-v8-footer-list-item">
                                    <i class="news-v8-footer-list-icon icon-clock"></i>
                                    23/01/2016
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--// end wrap -->
                    <div class="news-v8-more">
                        <h3 class="news-v8-more-link">Quick Info</h3>
                        <div class="news-v8-more-info">
                            <div class="news-v8-more-info-body">
                                <div class="margin-b-20">
                                    <h4 class="news-v8-more-info-title">Feel the experience</h4>
                                    <span class="news-v8-more-info-subtitle">Advanced experience</span>
                                </div>
                                <h4 class="news-v8-more-info-title">Ark exceeds expectations</h4>
                                <p class="news-v8-more-info-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                    </div>
                    <!--// end more -->
                </article>
                <!-- End News v8 -->
            </div>
        </div>
        <!--// end row -->

        <!-- Button -->
        <div class="center-block wow fadeInUp" data-wow-duration=".2" data-wow-delay=".3s">
            <a class="btn-white-bg btn-base-md radius-3" href="shortcodes_news.html">View More</a>
        </div>
        <!-- Button -->
    </div>
</div>