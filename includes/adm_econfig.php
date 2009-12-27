<?php
if (!$safe) {
    exit;
}

$adminpages['edit_config'] = array(
	'template_file' => 'admin_econfig.tpl',
	'name' => 'Edit Configuration'
);

function admin_edit_config(&$template) {
    $template->assign_vars(array(
        'RESULT' => 'You can edit the configuration of this DDL Script below.'
    ));
    if ($_POST) {
        $error = false;
        foreach ($_POST as $key => $val) {
            if ($val[1] == 'string') {
                if(!mysql_query('UPDATE gcddl_config SET value = "'.mysql_real_escape_string(serialize($val[0])).'" WHERE name = "'. mysql_real_escape_string($key) .'"')) {
                    $error = true;
                }
            } elseif ($val[1] == 'integer') {
                $val[0] = intval($val[0]);
                if(!mysql_query('UPDATE gcddl_config SET value = "'.mysql_real_escape_string(serialize($val[0])).'" WHERE name = "'. mysql_real_escape_string($key) .'"')) {
                    $error = true;
                }
            } else {
                $val[0] = intval($val[0]);
                if(!mysql_query('UPDATE gcddl_config SET value = "'.mysql_real_escape_string(serialize($val[0])).'" WHERE name = "'. mysql_real_escape_string($key) .'"')) {
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
	$getconfigs = mysql_query('SELECT * FROM gcddl_config');
	if (mysql_num_rows($getconfigs)) {
		while ($config_var = mysql_fetch_assoc($getconfigs)) {
			$template->assign_block_vars('cfgtbl', array(
				'GNAME' => ucwords(str_replace('_',' ',$config_var['name'])),
				'NAME' => $config_var['name'],
				'DESC' => $config_var['desc'],
			));
			if ($options=unserialize($config_var['possible'])) {
				$template->assign_block_vars('cfgtbl.string', array(
					'VALUE' => unserialize($config_var['value'])
				));
            } else {
                $template->assign_block_vars('cfgtbl.select', array());
                foreach ($options as $name => $friendly_name) {
                    $template->assign_block_vars('cfgtbl.select.option', array(
                        'VALUE' => $name,
                        'VTEXT' => $friendly_name,
                        'SELECTED' => $name == unserialize($config_var['value'])
                    ));
                }
            }
        }
    }
}
?>
