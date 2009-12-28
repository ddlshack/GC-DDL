<?php
require_once 'funcs.php';

$template->set_filenames(array(
	'head' => 'body_header.tpl',
    'sidebar' => 'body_sidebar.tpl',
    'body' => 'body_listdownload.tpl',
    'foot' => 'body_footer.tpl'
));

$template->assign_vars(array(
    'SITENAME' => $SETTINGS['sitename'],
    'SLOGAN' => $SETTINGS['slogan'],
    'DESC' => $SETTINGS['description'].' - Powered by gc-DDL. For more information visit http://global-config.com/',
    'KEYW' => $SETTINGS['keywords'].',global,config,open,source',
));


// Get categories
$categories = mysql_query('SElECT * FROM gcddl_categories');
while ($cat = mysql_fetch_assoc($categories)) {
    $cats[$cat['id']] = array($cat['name'], $cat['slug']);
}

// Get downloads and assign them to template
$page = $_GET['pg'] ? $_GET['pg'] : 1;
$getdownloads = mysql_query('SELECT id,title,url,cat,date,views,sid FROM gcddl_downloads LIMIT '.($page-1*$SETTINGS['downloads_per_page']).','.$SETTINGS['downloads_per_page']);
if (mysql_num_rows($getdownloads)) {
    while ($dl = mysql_fetch_assoc($getdownloads)) {
        $lastid = $dl['id'];
        $template->assign_block_vars('lstdls', array(
            'TYPE' => $cats[$dl['cat']][0],
            'TITLE' => stripslashes($dl['title']),
            'URL' => '#',
            'VIEWS' => $dl['views'],
            'DATE' => date($SETTINGS['date_format'], $dl['date'])
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
?>
