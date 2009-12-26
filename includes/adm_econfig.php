<?php
if (!$safe) {
    exit;
}

$adminpages['edit_config']['file'] = 'admin_econfig.tpl';

function admin_edit_config(&$template) {
    $template->assign_vars(array(
        'RESULT' => 'You can edit the configuration of this DDL Script below.'
    ));
    if (isset($_POST['sitename'])) {
        $error = false;
        foreach ($_POST as $key => $val) {
            if ($val[1] == 'string') {
                if(!mysql_query('UPDATE gc_ddl_config SET value = "'.mysql_real_escape_string(serialize($val[0])).'" WHERE name = "'. mysql_real_escape_string($key) .'"')) {
                    $error = true;
                }
            } elseif ($val[1] == 'integer') {
                $val[0] = intval($val[0]);
                if(!mysql_query('UPDATE gc_ddl_config SET value = "'.mysql_real_escape_string(serialize($val[0])).'" WHERE name = "'. mysql_real_escape_string($key) .'"')) {
                    $error = true;
                }
            } else {
                $val[0] = intval($val[0]);
                if(!mysql_query('UPDATE gc_ddl_config SET value = "'.mysql_real_escape_string(serialize($val[0])).'" WHERE name = "'. mysql_real_escape_string($key) .'"')) {
                    $error = true;
                }
            }
        }
        if ($error == false) {
            $template->assign_vars(array(
                'RESULT' => '<span style="color: #0F0;">The settings were successfully changed. Click <a href="admin.php?p=edit_config">here</a> if the page does not automatically refresh.</span>',
                'METAREDIRECT' => '<meta http-equiv="refresh" content="5;url=admin.php?p=edit_config" />'
            ));
        } else {
            $template->assign_vars(array(
                'RESULT' => mysql_error()
            ));
        }
    }
    $getconfigs = mysql_query('SELECT * FROM gc_ddl_config');
    if (mysql_num_rows($getconfigs) > 0) {
        while ($cfgr = mysql_fetch_assoc($getconfigs)) {
            $template->assign_block_vars('cfgtbl', array(
                'GNAME' => str_replace('_',' ',ucfirst($cfgr['name'])),
                'NAME' => $cfgr['name'],
                'DESC' => $cfgr['desc'],
            ));
            if ($cfgr['possible'] == null) {
                $template->assign_block_vars('cfgtbl.string', array(
                    'VALUE' => unserialize($cfgr['value']),
                    'TYPE' => 'string'
                ));
            } elseif ($cfgr['possible'] == 'integer') {
                $template->assign_block_vars('cfgtbl.string', array(
                    'VALUE' => unserialize($cfgr['value']),
                    'TYPE' => 'integer'
                ));
            } else {
                $template->assign_block_vars('cfgtbl.select', array(
                    'TYPE' => ''
                ));
                $possiblevals = unserialize($cfgr['possible']);
                foreach ($possiblevals as $val => $fval) {
                    $template->assign_block_vars('cfgtbl.select.option', array(
                        'VALUE' => $val,
                        'VTEXT' => $fval,
                        'SELECTED' => $val == unserialize($cfgr['value']) ? 'selected="selected"' : ''
                    ));
                }
            }
        }
    }
}
?>
