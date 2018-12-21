<?php

use yii\helpers\Html;
use common\models\Menu;
use common\models\ProductClassify;
use common\models\NewsClassify;
use common\models\Pages;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜单列表';
$this->params['breadcrumbs'][] = $this->title;

// 初始化
$html = null;

if (!empty( $dataProvider )) {

    foreach ($dataProvider as $value) {

        // 选择模型
        switch ($value['menuModel']['url_key']) {

            // 产品
            case 'product':
                $html .= menuHtml( $value, 'product' );
                break;

            // 招聘
            case 'job':
                $html .= menuHtml( $value, 'job' );
                break;

            // 新闻
            case 'news':
                $html .= menuHtml( $value, 'news' );
                break;

            // 单页面
            case 'pages':
                $html .= menuHtml( $value, 'pages' );
                break;

            // 超链接
            case 'urls':
                $html .= menuHtml( $value, 'urls' );
                break;

            default:
                break;
        }
    }
}

/**
 * 产品分类递归
 *
 * @param $data
 *
 * @return array|void
 */
function recursionProductData($data)
{
    if (empty( $data ))
        return;

    // 父类
    $data['c_key'] = empty( $data['c_key'] ) ? null : $data['c_key'];

    $child = ProductClassify::findByAll( $data['c_key'] );

    if (empty( $child ))
        return;

    // 初始化
    $html = null;

    foreach ($child as $value) {

        // Html 内容
        $html .= menuHtml( $value, 'product' );
    }

    return $html;
}

/**
 * 新闻分类递归
 *
 * @param $data
 *
 * @return null|string|void
 */
function recursionNewsData($data)
{
    if (empty( $data ))
        return;

    // 父类
    $data['c_key'] = empty( $data['c_key'] ) ? null : $data['c_key'];

    $child = NewsClassify::findByAll( $data['c_key'] );

    if (empty( $child ))
        return;

    // 初始化
    $html = null;

    foreach ($child as $value) {

        // Html 内容
        $html .= menuHtml( $value, 'news' );
    }

    return $html;
}

/**
 * 单页面递归
 *
 * @param $data
 *
 * @return null|string|void
 */
function recursionPagesData($data)
{
    if (empty( $data ))
        return;

    // 查找相对应的菜单
    $child = Menu::findByAll( $data['m_key'], Yii::$app->session['language'] );

    if (empty( $child ))
        return;

    $html = null;

    foreach ($child as $value) {

        // Html 内容
        $html .= menuHtml( $value, $value['menuModel']['url_key'] );
    }

    return $html;
}

/**
 * 编辑超链接
 *
 * @param $data
 *
 * @return null|string|void
 */
function recursionUrlData($data)
{
    if (empty( $data ))
        return;

    // 初始化
    $html = null;

    $child = Menu::findByAll( $data['m_key'], Yii::$app->session['language'] );

    if (empty( $child ))
        return;

    foreach ($child as $value) {

        // Html 内容
        $html .= menuHtml( $value, $value['menuModel']['url_key'] );
    }

    return $html;
}

/**
 * 招聘模型
 *
 * @param $data
 *
 * @return null|string|void
 */
function recursionJobData($data)
{
    if (empty( $data ))
        return;

    // 查找相对应的菜单
    $child = Menu::findByAll( $data['m_key'], Yii::$app->session['language'] );

    if (empty( $child ))
        return;

    $html = null;

    foreach ($child as $value) {
        $html .= menuHtml( $value, 'pages' );
    }

    return $html;
}

/**
 * Html 和 样式文件
 *
 * @param $data
 * @param $type
 *
 * @return null|string
 */
function menuHtml($data, $type)
{

    if (empty( $data ) || empty( $type ))
        return;

    $array = ['create' => null, 'update' => null, 'del' => null, 'content' => null];
    $enteringHtml = null;

    // 根据类别递归
    switch ($type) {

        // 在线联系
        case 'comment':
            $array = [
                'create' => Html::a( '添加子菜单', ['create', 'id' => $data['m_key']] ) . ' / ',
                'update' => Html::a( '编辑菜单', ['update', 'id' => $data['m_key']] ) . ' / ',
                'del'    => Html::a( '删除菜单', ['delete', 'id' => $data['m_key']] ) . ' / ',
            ];
            break;

        // 在线地图
        case 'map':
            $array = [
                'create' => Html::a( '添加子菜单', ['create', 'id' => $data['m_key']] ) . ' / ',
                'update' => Html::a( '编辑菜单', ['update', 'id' => $data['m_key']] ) . ' / ',
                'del'    => Html::a( '删除菜单', ['delete', 'id' => $data['m_key']] ) . ' / ',
            ];
            break;

        // 招聘
        case 'job':
            $array = [
                'create' => Html::a( '添加子菜单', ['create', 'id' => $data['m_key']] ) . ' / ',
                'update' => Html::a( '编辑菜单', ['update', 'id' => $data['m_key']] ) . ' / ',
                'del'    => Html::a( '删除菜单', ['delete', 'id' => $data['m_key']] ),
            ];
            break;

        // 新闻
        case 'news':

            if (empty( $data['c_key'] )) {
                $array['update'] = Html::a( '编辑菜单', ['update', 'id' => $data['m_key']] ) . ' / ';
                $array['create'] = Html::a( '添加新闻分类', ['admin/news-cls/create'] ) . ' / ';
                $array['del'] = Html::a( '删除菜单', ['delete', 'id' => $data['m_key']] );
                break;
            }

            $array = [
                'create' => Html::a( '添加分类', ['admin/news-cls/create'] ) . ' / ',
                'update' => Html::a( '编辑新闻分类', ['admin/news-cls/update', 'id' => $data['c_key']] ) . ' / ',
                'del'    => Html::a( '删除分类', ['admin/news-cls/delete', 'id' => $data['c_key']] ),
            ];

            break;

        // 产品
        case 'product':

            if (empty( $data['c_key'] )) {
                $array['update'] = Html::a( '编辑菜单', ['update', 'id' => $data['m_key']] ) . ' / ';
                $array['create'] = Html::a( '添加产品分类', ['admin/product-cls/create'] ) . ' / ';
                $array['del'] = Html::a( '删除菜单', ['delete', 'id' => $data['m_key']] );
                break;
            }

            $array = [
                'create' => Html::a( '添加分类', ['admin/product-cls/create'] ) . ' / ',
                'update' => Html::a( '编辑分类', ['admin/product-cls/update', 'id' => $data['c_key']] ) . ' / ',
                'del'    => Html::a( '删除分类', ['admin/product-cls/delete', 'id' => $data['c_key']] ),
            ];
            break;

        // 自定义页面
        case 'pages':

            $array = [
                'create'  => Html::a( '添加子菜单', ['create', 'id' => $data['m_key']] ) . ' / ',
                'update'  => Html::a( '编辑菜单', ['update', 'id' => $data['m_key']] ) . ' / ',
                'del'     => Html::a( '删除菜单', ['delete', 'id' => $data['m_key']] ) . ' / ',
                'content' => Html::a( '编辑内容', ['admin/pages/update', 'id' => $data['pages']['page_id']] ) . ' / ',
                'url'     => Html::a( '调整路径', ['admin/menu/adjustment', 'id' => $data['m_key']] ),
            ];

            $entering = Pages::findByOne( $data['pages']['page_id'] );

            if ($entering['menu']['model_key'] == 'UC1' && $data['is_type'] == 'list')
                $enteringHtml = ' / ' . Html::a( '录入内容', ['admin/pages-list/create', 'id' => $entering['m_key']] );

            break;

        // 链接
        case 'urls':
            $array = [
                'create' => Html::a( '添加子菜单', ['create', 'id' => $data['m_key']] ) . ' / ',
                'update' => Html::a( '编辑菜单', ['update', 'id' => $data['m_key']] ) . ' / ',
                'del'    => Html::a( '删除 Url 菜单', ['delete', 'id' => $data['m_key']] ),
            ];
            break;

    }

    $html = null;
    $html .= '<li class="">';
    $html .= '    <div class="uk-nestable-item" style="padding: 5px;">&nbsp;&nbsp;';
    $html .= $data['name'] . '&nbsp;&nbsp;&nbsp;&nbsp;' . $array['update'] . '&nbsp;' . $array['create'] . '&nbsp;' . $array['del'] . '&nbsp;' . (empty( $array['content'] ) ? null : $array['content']) . '&nbsp;' . (empty( $array['url'] ) ? null : $array['url']);

    // 根据单页面是列表的,增加录入内容链接
    $html .= '&nbsp;' . $enteringHtml;

    $html .= '    </div>';
    $html .= '    <ul class="">';

    // 根据类别递归
    switch ($type) {

        case 'urls':
            $html .= recursionUrlData( $data );
            break;

        case 'pages':
            $html .= recursionPagesData( $data );
            break;

        case 'news':
            $html .= recursionNewsData( $data );
            break;

        case 'product':
            $html .= recursionProductData( $data );
            break;

        case 'job':
            $html .= recursionJobData( $data );
            break;

    }

    $html .= '    </ul>';
    $html .= '</li>';

    return $html;
}

?>

<div class="col-lg-12">

    <div class="form-group">
        <?= Html::a( '创建菜单', ['create'], ['class' => 'btn btn-primary btn-lg'] ) ?>
        <?= Html::a( '创建单页面', ['admin/pages/create'], ['class' => 'btn btn-primary btn-lg'] ) ?>
        <?= Html::a( '创建单页面分类', ['admin/pages-cls/create'], ['class' => 'btn btn-primary btn-lg'] ) ?>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?php if (!empty( $dataProvider )): ?>

                <ul class="uk-nestable" style="font-size: 13px;">
                    <?= $html ?>
                </ul>

            <?php else: ?>

                没有菜单 !!

            <?php endif; ?>

        </div>
    </div>
</div>
