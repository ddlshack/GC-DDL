<?php
if (!$safe) {
    exit;
}
$adminpages['home']['file'] = 'admin_home.tpl';
function admin_home(&$template) {
    $downs = mysql_num_rows(mysql_query('SELECT id FROM gc_ddl_downloads'));
    $queue = mysql_num_rows(mysql_query('SELECT id FROM gc_ddl_queued'));
    $template->assign_vars(array(
        'TOTALD' => $downs,
        'TOTALQ' => $queue
    ));
}
?>