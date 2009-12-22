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
                $val[0] = htmlentities(strip_tags($val[0]));
                if(!mysql_query('update gc_ddl_config set value = "'.addslashes(serialize($val[0])).'" where name = "'. htmlentities(addslashes($key)) .'"')) {
                    $error = true;
                }
            } elseif ($val[1] == 'integer') {
                $val[0] = intval($val[0]);
                if(!mysql_query('update gc_ddl_config set value = "'.addslashes(serialize($val[0])).'" where name = "'. htmlentities(addslashes($key)) .'"')) {
                    $error = true;
                }
            } else {
                $val[0] = intval($val[0]);
                if(!mysql_query('update gc_ddl_config set value = "'.addslashes(serialize($val[0])).'" where name = "'. htmlentities(addslashes($key)) .'"')) {
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
    $getconfigs = mysql_query('select * from gc_ddl_config');
    if (mysql_num_rows($getconfigs) > 0) {
        while ($cfgr = mysql_fetch_assoc($getconfigs)) {
            $template->assign_block_vars('cfgtbl', array(
                'GNAME' => str_replace('_',' ',stripslashes(ucfirst($cfgr['name']))),
                'NAME' => stripslashes($cfgr['name']),
                'DESC' => stripslashes($cfgr['desc']),
            ));
            if ($cfgr['possible'] == null) {
                $template->assign_block_vars('cfgtbl.string', array(
                    'VALUE' => stripslashes(unserialize($cfgr['value'])),
                    'TYPE' => 'string'
                ));
            } elseif ($cfgr['possible'] == 'integer') {
                $template->assign_block_vars('cfgtbl.string', array(
                    'VALUE' => stripslashes(unserialize($cfgr['value'])),
                    'TYPE' => 'integer'
                ));
            } else {
                $template->assign_block_vars('cfgtbl.select', array(
                    'TYPE' => ''
                ));
                $possiblevals = unserialize($cfgr['possible']);
                foreach ($possiblevals as $val => $fval) {
                    $template->assign_block_vars('cfgtbl.select.option', array(
                        'VALUE' => stripslashes($val),
                        'VTEXT' => stripslashes($fval),
                        'SELECTED' => ($val == stripslashes(unserialize($cfgr['value']))) ? 'selected="selected"' : ''
                    ));
                }
            }
        }
    }
}
?>