<?php
include 'funcs.php';

$template->set_filenames(array(
	'head' => 'body_header.tpl',
    'sidebar' => 'body_sidebar.tpl',
    'body' => 'body_submit.tpl',
    'foot' => 'body_footer.tpl'
));

$template->assign_vars(array(
    'SITENAME' => stripslashes($SETTINGS['sitename']) . ' - Submit',
    'SLOGAN' => stripslashes($SETTINGS['slogan']),
    'DESC' => stripslashes($SETTINGS['description']).' - Powered by gc-DDL. For more information visit http://global-config.com/',
    'KEYW' => stripslashes($SETTINGS['keywords']).',global,config,open,source',
));

$categories = mysql_query('select id,cat_name,cat_slug from gc_ddl_categories');
while ($cat1 = mysql_fetch_assoc($categories)) {
    $cats[$cat1['id']][0] = $cat1['cat_name'];
    $cats[$cat1['id']][1] = $cat1['cat_slug'];
    $catss[$cat1['cat_slug']] = $cat1['id'];
}

result($template,'RESULT','Please be sure to follow the rules... or it might end up in your site being blacklisted.',null);

if (!empty($_POST['title'][0]) && !empty($_POST['url'][0]) && !empty($_POST['type'][0]) && isset($_POST['surl']) && isset($_POST['email']) && isset($_POST['sname'])) {
    $surl = murl($_POST['surl'],false);
    if ($surl != false) {
        $siteexists = mysql_query('select id from gc_ddl_sites where surl="'.htmlentities(addslashes($surl)).'"');
        $sname = $_POST['sname'];
        $email = $_POST['email'];
        if (mysql_num_rows($siteexists) == 0) {
            mysql_query('insert into gc_ddl_sites (sname,surl,semail,firstsub,lastsub) VALUES ("'.htmlentities(addslashes($sname)).'","'.htmlentities(addslashes($surl)).'","'.htmlentities(addslashes($email)).'","'.time().'","'.time().'")') or die (result($template,'RESULT','There was an error putting your site into the database.','#F00'));
            $siteid = mysql_insert_id();
        } else {
            $siteid = mysql_fetch_assoc($siteexists);
            $siteid = $siteid['id'];
        }
        $title = $_POST['title'];
        $url = $_POST['url'];
        $type = $_POST['type'];
        $urlmismatch = false;
        $insertingerror = false;
        $founddupes = false;
        for ($i=0;$i<10;$i++) {
            if (($urlmismatch == false && $insertingerror == false && $founddupes == false) && (!empty($title[$i]) && !empty($url[$i]) && !empty($type[$i])) && isset($catss[$type[$i]])) {
                if (murl($url[$i],false) == $surl) {
                    if ($SETTINGS['allow_dupes'] == 1) {
                        mysql_query('insert into gc_ddl_queued (title,url,sid,cat,date) values ("'.htmlentities(addslashes($title[$i])).'","'.htmlentities(addslashes(murl($url[$i],true))).'","'.$siteid.'","'.$catss[$type[$i]].'","'.time().'")') or die(eval('$insertingerror = true;'));
                    } else {
                        $timelimit = mktime(0, 0, 0, date('m') , date('d') - ($SETTINGS['allow_dupes_every_when']*7), date('Y'));
                        $dupesexist1 = mysql_query('select id from gc_ddl_queued where url = "'.htmlentities(addslashes(murl($url[$i],true))).'" and date > "'.$timelimit.'" limit 1') or die (eval('$insertingerror = true;'));
                        $dupesexist2 = mysql_query('select id from gc_ddl_downloads where url = "'.htmlentities(addslashes(murl($url[$i],true))).'" and date > "'.$timelimit.'" limit 1') or die (eval('$insertingerror = true;'));
                        if (mysql_num_rows($dupesexist1) == 0 && mysql_num_rows($dupesexist2) == 0) {
                            mysql_query('insert into gc_ddl_queued (title,url,sid,cat,date) values ("'.htmlentities(addslashes($title[$i])).'","'.htmlentities(addslashes(murl($url[$i],true))).'","'.$siteid.'","'.$catss[$type[$i]].'","'.time().'")') or die(mysql_error());
                        } else {
                            $founddupes = true;
                            result($template,'RESULT','The administrator has disabled the submission of duplicate downloads.','#F00');
                        }
                    }
                    
                } else {
                    $urlmismatch = true;
                    result($template,'RESULT','Your site URL and the URL of your downloads do not match.','#F00');
                }
            }
            if ($insertingerror == true) {
                result($template,'RESULT','There has been an error when trying to insert your downloads.','#F00');
            }
        }
        if ($insertingerror == false && $founddupes == false && $urlmismatch == false) {
            mysql_query('update gc_ddl_sites set lastsub = "'.time().'" where id = "'.$siteid.'"');
            result($template,'RESULT','Your downloads have been accepted into the queue.','#0F0');
        }
    } else {
        result($template,'RESULT','Make sure that your Site URL is formatted correctly (begins with <strong>http://</strong>, and is a valid URL).','#F00');
    }
}


for ($i=1;$i<=10;$i++) {
    $template->assign_block_vars('subtbl',array(
        'NUMBER' => $i
    ));
    foreach ($cats as $key => $val) {
        $template->assign_block_vars('subtbl.type',array(
            'SLUG' => $val[1],
            'NAME' => $val[0]
        ));
    }
}

$template->pparse('head');
$template->pparse('sidebar');
$template->pparse('body');
$template->pparse('foot');
ob_end_flush();
?>
