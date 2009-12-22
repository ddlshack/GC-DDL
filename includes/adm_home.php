<?php
if (!$safe) {
    exit;
}
$adminpages['home']['file'] = 'admin_home.tpl';
function admin_home(&$template) {
    $totals = mysql_query('select count(gc_ddl_downloads.id) as down, count(gc_ddl_queued.id) as queue from gc_ddl_queued, gc_ddl_downloads');
    $downs = mysql_result($totals, 'down');
    $queue = mysql_result($totals, 'queue');
    $template->assign_vars(array(
        'TOTALD' => $downs,
        'TOTALQ' => $queue
    ));
}
?>