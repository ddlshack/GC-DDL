<?php
require_once 'funcs.php';
if($includes=opendir($dir.'includes/')) {
    while(($file = readdir($includes)) !== false) {
        if((substr($file,0,4) == 'adm_') && substr($file,-4) == '.php') {
                include_once $dir.'includes/'.$file;
        }
    }
    closedir($includes);
}

$template->set_filenames(array(
	'head' => 'body_header.tpl',
    'sidebar' => 'body_sidebar.tpl',
    'foot' => 'body_footer.tpl'
));

$template->assign_vars(array(
    'SITENAME' => $SETTINGS['sitename'] . ' - Admin',
    'SLOGAN' => $SETTINGS['slogan'],
    'DESC' => $SETTINGS['description'].' - Powered by gc-DDL. For more information visit http://global-config.com/',
    'KEYW' => $SETTINGS['keywords'].',global,config,open,source',
));

if (!$_SESSION['admin']['username'] || !$_SESSION['admin']['authed']) {
    $template->set_filenames(array(
        'body' => 'admin/admin_login.tpl'
    ));
    $template->assign_vars(array(
        'MSG' => 'Use the form below to log into the administration panel.'
    ));
    
	if($_SESSION['admin']['tries'] >= $SETTINGS['login_attempts']) {
		$template->assign_vars(array(
			'MSG' => '<span style="color: #F00;">You have failed to log in too many times.</span>'
		));
    } elseif($_POST) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$template->assign_vars(array(
				'MSG' => '<span style="color: #F00;">You missed a field.</span>'
			));
		} else {
			$query = mysql_query('SELECT username,password,is_admin FROM gcddl_users WHERE username="'.mysql_real_escape_string($_POST['username']).'" AND password="'.mysql_real_escape_string(md5($_POST['password'])).'" LIMIT 1');
			if (mysql_num_rows($query)) {
				$_SESSION['admin']['tries'] = 0;
				$_SESSION['admin']['username'] = $_POST['username'];
				$_SESSION['admin']['authed'] = true;
				$template->assign_vars(array(
					'MSG' => '<span style="color: #0F0;">Hello '.htmlspecialchars($_SESSION['admin']['username']).', you have logged in successfully. Click <a href="admin.php?p=home">here</a> if you are not re-directed.</span>',
					'METAREDIRECT' => '<meta http-equiv="refresh" content="5;url=admin.php?p=home" />'
				));
			} else {
				$_SESSION['admin']['tries']++;
				$template->assign_vars(array(
					'MSG' => '<span style="color: #F00;">You have entered an incorrect username and password combination.</span>'
				));
			}
		}
    }

} else {
	$page = $_REQUEST['p'];
	$funcname = 'admin_'.$page;
    if (!$page || !$adminpages[$page] || !function_exists($funcname)) {
        $template->set_filenames(array(
            'body' => 'admin/admin_home.tpl',
        ));
        admin_home($template);
    } else {
		$template->set_filenames(array(
			'body' => 'admin/'.$adminpages[$page]['template_file'],
		));
		$funcname($template);
	}
    $template->set_filenames(array(
        'sidebar' => 'admin/admin_sidebar.tpl',
    ));
    
    foreach ($adminpages as $funcname => $properties) {
        $template->assign_block_vars('admin_navi',array(
            'HREF' => 'admin.php?p='.urlencode($funcname),
            'TEXT' => $properties['name'] ? $properties['name'] : ucwords(str_replace('_', ' ', $funcname)),
        ));
	}
	$template->pparse('sidebar');
}
$template->pparse('head');
$template->pparse('body');
$template->pparse('foot');
?>
