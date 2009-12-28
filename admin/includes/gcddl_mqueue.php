<?php
if (!$safe) {
    exit;
}

$adminpages['manage_queue'] = array(
	'template_file' => 'admin_mqueue.tpl',
	'name' => 'Manage Queue (Manual)',
);


function admin_manage_queue(&$template) {
	
	$categories = mysql_query('SELECT id,cat_name,cat_slug FROM gcddl_categories');
	while ($cat1 = mysql_fetch_assoc($categories)) {
		$cats[$cat1['id']][0] = $cat1['cat_name'];
		$cats[$cat1['id']][1] = $cat1['cat_slug'];
		$catss[$cat1['cat_slug']] = $cat1['id'];
	}
	
	if (isset($_POST['accept'])) {
		if (isset($_POST['action'][0])) {
			$i = 0;
			foreach ($_POST['action'] as $dl) {
				$getinfo = mysql_query('SELECT * FROM gcddl_queue WHERE id = "'.intval($dl).'"');
				if (mysql_num_rows($getinfo) == 1) {
					$dli = mysql_fetch_assoc($getinfo);
					mysql_query('INSERT INTO gcddl_downloads (title,url,sid,cat,date) VALUES ("'.$dli['title'].'", "'.$dli['url'].'", "'.$dli['sid'].'", "'.$dli['cat'].'", "'.$dli['date'].'")');
					mysql_query('DELETE FROM gcddl_queue WHERE id = "'.$dli['id'].'"');
					$i++;
				}
			}
			result($template,'RESULT','A total of ' . $i . ' downloads have been added to the downloads table.', '#0F0');
		}
	}
	
	if (isset($_POST['delete'])) {
		if (isset($_POST['action'][0])) {
			$i = 0;
			foreach ($_POST['action'] as $dl) {
				mysql_query('DELETE FROM gcddl_queue WHERE id = "'.intval($dl).'"');
				$i++;
			}
			result($template,'RESULT','A total of ' . $i . ' downloads have been deleted.', '#0F0');
		}
	}
	
	$getqueue = mysql_query('SELECT * FROM gcddl_queue ORDER BY id DESC LIMIT 200');
	if (mysql_num_rows($getqueue) > 0) { 
		$lastsid = null;
		while($qdl = mysql_fetch_assoc($getqueue)) {
			if ($lastsid == null || $lastsid != $qdl['sid']) {
				$getsiteinfo = mysql_query('SELECT id,sname,surl FROM gcddl_sites WHERE id = "'.$qdl['sid'].'"') or die(mysql_error());
				$siteinfo = mysql_fetch_assoc($getsiteinfo);
				$lastsid = $qdl['sid'];
				$template->assign_block_vars('queued_downloads', array(
					'TYPE' => $cats[$qdl['cat']][0],
					'URL' => stripslashes($qdl['url']),
					'TITLE' => stripslashes($qdl['title']),
					'SURL' => stripslashes($siteinfo['surl']),
					'SNAME' => stripslashes($siteinfo['sname']),
					'SID' => $qdl['sid'],
					'SELECTALL' => '<input type="checkbox" class="{queued_downloads.SID}" style="background-color: #000; color: #F00; border: 1px #F00 solid;" onclick="checkAll(document.getElementById(\'submit\'), \''.$qdl['sid'].'\', this.checked);" />',
					'ID' => $qdl['id']
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
					'SID' => $lastsid,
					'ID' => $qdl['id']
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