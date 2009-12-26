<?php
# Homepage to our awesome DDL Script
# Its so awesome that its just oozing awesomeness
# Its incredibly difficult to contain in fact.
include 'funcs.php';

$template->set_filenames(array(
	'head' => 'body_header.tpl',
    'sidebar' => 'body_sidebar.tpl',
    'body' => 'body_listdownload.tpl',
    'foot' => 'body_footer.tpl'
));

$template->assign_vars(array(
    'SITENAME' => stripslashes($SETTINGS['sitename']),
    'SLOGAN' => stripslashes($SETTINGS['slogan']),
    'DESC' => stripslashes($SETTINGS['description']).' - Powered by gc-DDL. For more information visit http://global-config.com/',
    'KEYW' => stripslashes($SETTINGS['keywords']).',global,config,open,source',
));

$categories = mysql_query('select id,cat_name,cat_slug from gc_ddl_categories');
while ($cat1 = mysql_fetch_assoc($categories)) {
    $cats[$cat1['id']][0] = $cat1['cat_name'];
    $cats[$cat1['id']][1] = $cat1['cat_slug'];
}

$page = (isset($_GET['pg']) && $_GET['pg'] > 1) ? $_GET['pg'] : 1;
$getdownloads = mysql_query('select id,title,url,cat,date,views,sid from gc_ddl_downloads limit '.($page-1*$SETTINGS['downloads_per_page']).','.($SETTINGS['downloads_per_page'])) or die(mysql_error());
if (mysql_num_rows($getdownloads) > 0) {
    while ($dl = mysql_fetch_assoc($getdownloads)) {
        $lastid = $dl['id'];
        $template->assign_block_vars('lstdls', array(
            'TYPE' => $cats[$dl['cat']][0],
            'TITLE' => stripslashes($dl['title']),
            'URL' => '#',
            'VIEWS' => $dl['views'],
            'DATE' => date("d-m-Y", $dl['date'])
        ));
    }
} else {
    $template->assign_block_vars('lstdls', array(
        'TYPE' => 'N/A',
        'TITLE' => 'No Downloads',
        'URL' => '#',
        'VIEWS' => '1337',
        'DATE' => '14-10-1993'
    ));
}
$template->pparse('head');
$template->pparse('sidebar');
$template->pparse('body');
$template->pparse('foot');
ob_end_flush();
?>