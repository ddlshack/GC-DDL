<?php
if (!$safe) {
    exit;
}

$adminpages['home'] = array(
	'template_file' => 'admin_home.tpl',
	'name' => 'Home',
);

function admin_home(&$template) {
    $downs = mysql_num_rows(mysql_query('SELECT id FROM gcddl_downloads'));
    $queue = mysql_num_rows(mysql_query('SELECT id FROM gcddl_queued'));
    $template->assign_vars(array(
        'TOTALD' => $downs,
        'TOTALQ' => $queue
    ));
}
?>