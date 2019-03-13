<?php

/**
 * @abstract 提供数据模板
 * @author Yxl <zccem@163.com>
 */

$this->title = '挂载中心';

function quick_dev_insights_phpinfo()
{
    ob_start();
    phpinfo(11);
    $phpinfo = array('phpinfo' => array());

    if (preg_match_all('#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s', ob_get_clean(), $matches, PREG_SET_ORDER)) {

        foreach ($matches as $match) {
            if (strlen($match[1])) {
                $phpinfo[ $match[1] ] = array();
            } else if (isset($match[3])) {
                $keys1 = array_keys($phpinfo);
                $phpinfo[ end($keys1) ][ $match[2] ] = isset($match[4]) ? array($match[3], $match[4]) : $match[3];
            } else {
                $keys1 = array_keys($phpinfo);
                $phpinfo[ end($keys1) ][] = $match[2];

            }

        }
    }

    if (!empty($phpinfo)) {

        foreach ($phpinfo as $name => $section) {

            echo "<h3>$name</h3>\n<table class='table table-hover'>\n";

            foreach ($section as $key => $val) {
                if (is_array($val)) {
                    echo "<tr><td>$key</td><td>$val[0]</td><td>$val[1]</td></tr>\n";
                } else if (is_string($key)) {
                    echo "<tr><td>$key</td><td>$val</td></tr>\n";
                } else {
                    echo "<tr><td>$val</td></tr>\n";
                }
            }
        }
        echo "</table>\n";

    } else {
        echo "<h3>对不起，phpinfo（）函数不可访问。 也许，站长是禁用查看文档。</h3>";
    }
}

?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">

                <?php
                quick_dev_insights_phpinfo();
                ?>

            </div>
        </div>
    </div>
</div>