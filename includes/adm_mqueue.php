<?php
if (!$safe) {
    exit;
}

$adminpages['manage_queue']['file'] = 'admin_mqueue.tpl';

function admin_manage_queue(&$template) {
	
	$categories = mysql_query('select id,cat_name,cat_slug from gc_ddl_categories');
	while ($cat1 = mysql_fetch_assoc($categories)) {
		$cats[$cat1['id']][0] = $cat1['cat_name'];
		$cats[$cat1['id']][1] = $cat1['cat_slug'];
		$catss[$cat1['cat_slug']] = $cat1['id'];
	}
	
	$getqueue = mysql_query('SELECT * FROM gc_ddl_queued ORDER BY id DESC LIMIT 200');
	if (mysql_num_rows($getqueue) > 0) { 
		$lastsid = null;
		while($qdl = mysql_fetch_assoc($getqueue)) {
			if ($lastsid == null || $lastsid != $qdl['sid']) {
				$getsiteinfo = mysql_query('SELECT id,sname,surl FROM gc_ddl_sites WHERE id = "'.$qdl['sid'].'"') or die(mysql_error());
				$siteinfo = mysql_fetch_assoc($getsiteinfo);
				$lastsid = $qdl['sid'];
				$template->assign_block_vars('queued_downloads', array(
					'TYPE' => $cats[$qdl['cat']][0],
					'URL' => stripslashes($qdl['url']),
					'TITLE' => stripslashes($qdl['title']),
					'SURL' => stripslashes($siteinfo['surl']),
					'SNAME' => stripslashes($siteinfo['sname']),
					'SID' => $qdl['sid'],
					'SELECTALL' => ' | <input type="checkbox" class="{queued_downloads.SID}" onclick="checkAll(document.getElementById(\'submit\'), \''.$qdl['sid'].'\', this.checked);" />'
				));
			}
			else
			{
				$template->assign_block_vars('queued_downloads', array(
					'TYPE' => $cats[$qdl['cat']][0],
					'URL' => stripslashes($qdl['url']),
					'TITLE' => stripslashes($qdl['title']),
					'SURL' => '#',
					'SNAME' => '^',
					'SID' => $lastsid
				));
			}
		}
	} else {
		$template->assign_vars(array(
			'RESULT' => 'No downloads in the queue'
		));
		$template->assign_block_vars('queued_downloads', array(
			'TYPE' => 'N/A',
			'URL' => '#',
			'TITLE' => 'No downloads in the queue',
			'SURL' => '#',
			'SNAME' => 'N/A',
			'SID' => null
		));
	}
}
?>