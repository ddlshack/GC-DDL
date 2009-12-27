<?php
require_once 'funcs.php';
if($includes) {
    while(($file = readdir($includes)) !== false) {
        if((substr($file,0,4) == 'adm_') && substr($file,-4) == '.php') {
                include $dir.'includes/'.$file;
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
    'SITENAME' => stripslashes($SETTINGS['sitename']) . ' - Admin',
    'SLOGAN' => stripslashes($SETTINGS['slogan']),
    'DESC' => stripslashes($SETTINGS['description']).' - Powered by gc-DDL. For more information visit http://global-config.com/',
    'KEYW' => stripslashes($SETTINGS['keywords']).',global,config,open,source',
));

$_SESSION['tries'] = (isset($_SESSION['tries']) && $_SESSION['tries'] != 0) ? $_SESSION['tries'] : 0;
$_SESSION['username'] = (isset($_SESSION['username']) && $_SESSION['username'] != null) ? $_SESSION['username'] : null;
$_SESSION['is_admin'] = (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true) ? $_SESSION['is_admin'] : false;

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || $_SESSION['username'] == null || $_SESSION['is_admin'] == false || $_SESSION['is_admin'] != true) {
    $template->set_filenames(array(
        'body' => 'admin/admin_login.tpl'
    ));
    $template->assign_vars(array(
        'MSG' => 'Use the form below to log into the administration panel.'
    ));
	print_r($_POST);
    if (isset($_POST['submit'])) {
        if ($_SESSION['tries'] < $SETTINGS['login_attempts']) {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $query = mysql_query('SElECT username,password,is_admin FROM gcddl_users WHERE username="'.mysql_real_escape_string($_POST['username']).'" AND password="'.mysql_real_escape_string(md5($_POST['password'])).'"');
                if (mysql_num_rows($query) == 1) {
                    $_SESSION['tries'] = 0;
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['is_admin'] = true;
                    $template->assign_vars(array(
                        'MSG' => '<span style="color: #0F0;">Hello '.$_SESSION['username'].', you have logged in successfully. Click <a href="admin.php?p=home">here</a> if you are not re-directed.</span>',
                        'METAREDIRECT' => '<meta http-equiv="refresh" content="5;url=admin.php?p=home" />'
                    ));
                } else {
                    $_SESSION['tries'] = $_SESSION['tries'] + 1;
                    $template->assign_vars(array(
                        'MSG' => '<span style="color: #F00;">You have entered an incorrect username and password combination.</span>'
                    ));
                }
            } else {
                $_SESSION['tries'] = $_SESSION['tries'] + 1;
                $template->assign_vars(array(
                    'MSG' => '<span style="color: #F00;">You missed a field.</span>'
                ));
            }
            } else {
            $template->assign_vars(array(
                'MSG' => '<span style="color: #F00;">You have failed to log in too many times.</span>'
            ));
        }
    }   
    $template->pparse('head');
    $template->pparse('body');
    $template->pparse('foot');
} else {
    if (!isset($_REQUEST['p'])) {
        $template->set_filenames(array(
            'body' => 'admin/admin_home.tpl',
        ));
        admin_home($template);
    } else {
        if (function_exists('admin_'.addslashes($_REQUEST['p']))) {
            $pagefileaaa = addslashes($_REQUEST['p']);
            if(isset($adminpages[$pagefileaaa])){
                if (function_exists($funcname) == true) {
					$template->set_filenames(array(
						'body' => 'admin/'.$adminpages[$pagefileaaa]['file'],
					));
					$funcname = 'admin_'.$pagefileaaa;
				}
				else
				{
					$template->set_filenames(array(
						'body' => 'admin/admin_home.tpl',
					));
					admin_home($template);
				}
            } else {
                $template->set_filenames(array(
                    'body' => 'admin/admin_home.tpl',
                ));
                admin_home($template);
            }
        } else {
            $template->set_filenames(array(
                'body' => 'admin/admin_home.tpl',
            ));
            admin_home($template);
        }
    }
    $template->set_filenames(array(
        'sidebar' => 'admin/admin_sidebar.tpl',
    ));
    foreach ($adminpages as $funcname => $tmpname) {
        $template->assign_block_vars('admin_navi',array(
            'HREF' => 'admin.php?p='.strtolower($funcname),
            'TEXT' => str_replace('_',' ',ucfirst($funcname))
        ));
    }
    $template->pparse('head');
    $template->pparse('sidebar');
    $template->pparse('body');
    $template->pparse('foot');
}
?>
