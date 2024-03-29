<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;



/* 后台设置 */

function themeConfig($form) {

    ?>
    <h1>主题设置</h1>
    <link rel='stylesheet' href='<?php Helper::options()->themeUrl('css/Admin/admin.css') ?>'/>

    <?php

    //header部分
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('favicon'), _t('标签页icon，不写不加载'));
    
    $logoTxt = new Typecho_Widget_Helper_Form_Element_Text('logoTxt', NULL, NULL, _t('首页字1'), _t('不写不加载'));

	$logoTxt2 = new Typecho_Widget_Helper_Form_Element_Text('logoTxt2', NULL, NULL, _t('首页字2'), _t('不写不加载'));

	
    $form->addInput($favicon);

    $form->addInput($logoTxt);

	$form->addInput($logoTxt2);



	$bannerimg = new Typecho_Widget_Helper_Form_Element_Text('bannerimg', NULL, NULL, _t('首页图片'), _t('图片链接，不写会加载默认图'));

    $form->addInput($bannerimg);

    

	$site_bw = new Typecho_Widget_Helper_Form_Element_Radio('site_bw',

        array('able'=>_t('开启'),'disable'=>_t('关闭')),

        'disable',

        _t("黑白模式"),

        _t("开启后呈现为黑白模式")

        );

    $form->addInput($site_bw);

    
    $maodian = new Typecho_Widget_Helper_Form_Element_Radio('maodian',
        
        array('able'=>_t('开启'),'disable'=>_t('关闭')),

        'disable',

        _t("鼠标点击特效"),
    
        _t("默认关闭"));

    $form->addInput($maodian);

    
    $jokeTitle = new Typecho_Widget_Helper_Form_Element_Radio('jokeTitle',

        array('able'=>_t('开启'),'disable'=>_t('关闭')),

        'disable',

        _t("恶搞标题"),

        _t("默认关闭")

        );
    
    $form->addInput($jokeTitle);

    

	//sidebar部分

	$sidebarlr = new Typecho_Widget_Helper_Form_Element_Radio('sidebarlr',

        array('left_side' => _t('左边栏'),

            'right_side' => _t('右边栏'),

			'single' => _t('无边栏'),

        ),

        'right_side', _t('非首页侧边栏设置'), _t('默认右边栏'));

    $form->addInput($sidebarlr);

	

    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 

    array('ShowAuthor' => _t('作者简介'),

    'ShowSearch' => _t('搜索框'),

    'ShowRecent' => _t('最新文章'),

	'ShowCategory' => _t('分类目录')),

    array('ShowAuthor', 'ShowSearch', 'ShowRecent', 'ShowCategory'), _t('侧边栏显示'));    

    $form->addInput($sidebarBlock->multiMode());

	

    $SidebarBackground = new Typecho_Widget_Helper_Form_Element_Text('SidebarBackground', null, NULL, _t('背景图片'));

	$form->addInput($SidebarBackground);


    $authorpic = new Typecho_Widget_Helper_Form_Element_Text('authorpic', null, NULL, _t('头像'));

	$form->addInput($authorpic);


    $authordesc = new Typecho_Widget_Helper_Form_Element_Text('authordesc', null, NULL, _t('简介'), _t('支持html'));

	$form->addInput($authordesc);


	$ad_sidebar = new Typecho_Widget_Helper_Form_Element_Text('ad_sidebar', NULL, NULL, _t('侧边栏广告'), _t('自定义广告代码，支持html'));

    $form->addInput($ad_sidebar);

	
    //footer部分
    $setupTime = new Typecho_Widget_Helper_Form_Element_Text('setupTime', NULL, NULL, _t('建站时间'), _t('格式：01/01/2020 0:00:00'));

    $form->addInput($setupTime);


    $setupTimeTip = new Typecho_Widget_Helper_Form_Element_Text('setupTimeTip', NULL, NULL, _t('提示词'), _t('例：已经在二次元中度过了'));

    $form->addInput($setupTimeTip);


    $musicId = new Typecho_Widget_Helper_Form_Element_Text('musicId', NULL, NULL, _t('网易云音乐：'), _t('歌单ID'));

    $form->addInput($musicId);

    $musicAutoPlay = new Typecho_Widget_Helper_Form_Element_Radio('musicAutoPlay',

        array('able' => _t('开启'),'disable' => _t('关闭'),),

        'disable', _t('音乐自动播放'), _t('默认关闭'));
    
    $form->addInput($musicAutoPlay);

    $musicPlace = new Typecho_Widget_Helper_Form_Element_Radio('musicPlace',

    array('sidebar' => _t('侧边栏'),

        'footer' => _t('吸底'),

    ),

    'footer', _t('音乐播放器位置'), _t('默认吸底【侧边栏效果尚待优化】'));

    $form->addInput($musicPlace);

    $beian = new Typecho_Widget_Helper_Form_Element_Text('beian', NULL, NULL, _t('备案号'), _t('支持html格式，不写不加载'));

    $form->addInput($beian);



}
?>



<?php
/* 文章自定义字段 */
function themeFields($layout) {
    $backgroundImage = new Typecho_Widget_Helper_Form_Element_Text('backgroundImage', null, null, _t('文章背景图'), _t('作为整页背景显示，不填不显示'));
    $layout->addItem($backgroundImage);

    // $image = new Typecho_Widget_Helper_Form_Element_Text('image', null, null, _t('文章头图'), _t('文章头图会显示在文章的顶部。'));
    // $layout->addItem($image);
}




/**

 * 解析内容以实现附件加速

 * @access public

 * @param string $content 文章正文

 * @param Widget_Abstract_Contents $obj

 */

function parseContent($obj) {

    $options = Typecho_Widget::widget('Widget_Options');

    if (!empty($options->src_add) && !empty($options->cdn_add)) {

        $obj->content = str_ireplace($options->src_add, $options->cdn_add, $obj->content);

    }

    echo trim($obj->content);

}





/*文章阅读次数统计*/

function get_post_view($archive) {

    $cid = $archive->cid;

    $db = Typecho_Db::get();

    $prefix = $db->getPrefix();

    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {

        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');

        echo 0;

        return;

    }

    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));

    if ($archive->is('single')) {

        $views = Typecho_Cookie::get('extend_contents_views');

        if (empty($views)) {

            $views = array();

        } else {

            $views = explode(',', $views);

        }

        if (!in_array($cid, $views)) {

            $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));

            array_push($views, $cid);

            $views = implode(',', $views);

            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie

            

        }

    }

    echo $row['views'];

}





/*Typecho 24小时发布文章数量*/

function get_recent_posts_number($days = 1,$display = true)

{

$db = Typecho_Db::get();

$today = time() + 3600 * 8;

$daysago = $today - ($days * 24 * 60 * 60);

$total_posts = $db->fetchObject($db->select(array('COUNT(cid)' => 'num'))

->from('table.contents')

->orWhere('created < ? AND created > ?', $today,$daysago)

->where('type = ? AND status = ? AND password IS NULL', 'post', 'publish'))->num;

if($display) {

echo $total_posts;

} else {

return $total_posts;

}

}



//随机文章

function theme_random_posts(){

$defaults = array(

'number' => 6,

'before' => '',

'after' => '',

'xformat' => '<a class="list-group-item visible-lg" title="{title}" href="{permalink}" rel="bookmark"><i class="fa  fa-book"></i> {title}</a> 

	<a class="list-group-item visible-md" title="{title}" href="{permalink}" rel="bookmark"><i class="fa  fa-book"></i> {title}</a>'

);

$db = Typecho_Db::get();

 

$sql = $db->select()->from('table.contents')

->where('status = ?','publish')

->where('type = ?', 'post')

->where('created <= unix_timestamp(now())', 'post') //添加这一句避免未达到时间的文章提前曝光

->limit($defaults['number'])

->order('RAND()');

 

$result = $db->fetchAll($sql);

echo $defaults['before'];

foreach($result as $val){

$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);

echo str_replace(array('{permalink}', '{title}'),array($val['permalink'], $val['title']), $defaults['xformat']);

}

echo $defaults['after'];

}

// 获取浏览器信息
function getBrowser($agent)
{
    if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
        $outputer = 'Internet Explore';
    } else if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Firefox/', $regs[0]);
        $FireFox_vern = explode('.', $str1[1]);
        $outputer = 'FireFox';
    } else if (preg_match('/Maxthon([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Maxthon/', $agent);
        $Maxthon_vern = explode('.', $str1[1]);
        $outputer = 'MicroSoft Edge';
    } else if (preg_match('#360([a-zA-Z0-9.]+)#i', $agent, $regs)) {
        $outputer = '360 Fast Browser';
    } else if (preg_match('/Edge([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Edge/', $regs[0]);
        $Edge_vern = explode('.', $str1[1]);
        $outputer = 'MicroSoft Edge';
    } else if (preg_match('/UC/i', $agent)) {
        $str1 = explode('rowser/',  $agent);
        $UCBrowser_vern = explode('.', $str1[1]);
        $outputer = 'UC Browser';
    }  else if (preg_match('/QQ/i', $agent, $regs)||preg_match('/QQ Browser\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('rowser/',  $agent);
        $QQ_vern = explode('.', $str1[1]);
        $outputer = 'QQ Browser';
    } else if (preg_match('/UBrowser/i', $agent, $regs)) {
        $str1 = explode('rowser/',  $agent);
        $UCBrowser_vern = explode('.', $str1[1]);
        $outputer = 'UC Browser';
    }  else if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
        $outputer = 'Opera';
    } else if (preg_match('/Chrome([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Chrome/', $agent);
        $chrome_vern = explode('.', $str1[1]);
        $outputer = 'Google Chrome';
    } else if (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Version/',  $agent);
        $safari_vern = explode('.', $str1[1]);
        $outputer = 'Safari';
    } else{
        $outputer = 'Google Chrome';
    }
    echo $outputer;
}
// 获取操作系统信息
function getOs($agent)
{
    $os = false;
    if (preg_match('/win/i', $agent)) {
        if (preg_match('/nt 6.0/i', $agent)) {
            $os = 'Windows Vista&nbsp;·&nbsp;';
        } else if (preg_match('/nt 6.1/i', $agent)) {
            $os = 'Windows 7&nbsp;·&nbsp;';
        } else if (preg_match('/nt 6.2/i', $agent)) {
            $os = 'Windows 8&nbsp;·&nbsp;';
        } else if(preg_match('/nt 6.3/i', $agent)) {
            $os = 'Windows 8.1&nbsp;·&nbsp;';
        } else if(preg_match('/nt 5.1/i', $agent)) {
            $os = 'Windows XP&nbsp;·&nbsp;';
        } else if (preg_match('/nt 10.0/i', $agent)) {
            $os = 'Windows 10&nbsp;·&nbsp;';
        } else{
            $os = 'Windows X64&nbsp;·&nbsp;';
        }
    } else if (preg_match('/android/i', $agent)) {
        if (preg_match('/android 9/i', $agent)) {
            $os = 'Android Pie&nbsp;·&nbsp;';
        }
        else if (preg_match('/android 8/i', $agent)) {
            $os = 'Android Oreo&nbsp;·&nbsp;';
        }
        else {
            $os = 'Android&nbsp;·&nbsp;';
        }
    }
    else if (preg_match('/ubuntu/i', $agent)) {
        $os = 'Ubuntu&nbsp;·&nbsp;';
    } else if (preg_match('/linux/i', $agent)) {
        $os = 'Linux&nbsp;·&nbsp;';
    } else if (preg_match('/iPhone/i', $agent)) {
        $os = 'iPhone&nbsp;·&nbsp;';
    } else if (preg_match('/mac/i', $agent)) {
        $os = 'MacOS&nbsp;·&nbsp;';
    }else if (preg_match('/fusion/i', $agent)) {
        $os = 'Android&nbsp;·&nbsp;';
    } else {
        $os = 'Linux&nbsp;·&nbsp;';
    }
    echo $os;
}

?>

