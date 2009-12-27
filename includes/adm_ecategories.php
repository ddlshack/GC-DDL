<?php
if (!$safe) {
    exit;
}

$adminpages['edit_categories'] = array(
	'template_file' => 'admin_ecategories.tpl',
	'name' => 'Edit Categories',
);

function admin_edit_categories(&$template) {
    $template->assign_vars(array(
        'RESULT' => 'Use the form below, to edit categories.'
    ));
    
    if (isset($_POST['acsb'])) {
        $exists = mysql_query('SELECT * FROM gcddl_categories WHERE cat_slug LIKE "'.mysql_real_escape_string($_POST['acs']).'" OR cat_name LIKE "'.mysql_real_escape_string($_POST['acfn']).'" LIMIT 1');
        if (mysql_num_rows($exists) == 0) {
            $cati = mysql_fetch_assoc($exists);
            if ($_POST['acfn'] == strip_tags($_POST['acfn']) && $_POST['acs'] == strip_tags($_POST['acs'])) {
                $error = false;
                if (!mysql_query('INSERT INTO gcddl_categories (cat_slug,cat_name) VALUES ("'.mysql_real_escape_string($_POST['acs']).'","'.mysql_real_escape_string($_POST['acfn']).'")')) {
					$error = true;
				}
				if ($error == false) {
                    $template->assign_vars(array(
                        'RESULT' => '<span style="color: #0F0;">That category has been added successfully. Click <a href="admin.php?p=edit_categories">here</a> if the page does not refresh.</span>',
                        'METAREDIRECT' => '<meta http-equiv="refresh" content="5;url=admin.php?p=edit_categories" />'
                    ));
                }
                else
                {
                    $template->assign_vars(array(
                        'RESULT' => '<span style="color: #F00;">There has been an error while trying to add that category.</span>'
                    ));
                }
            }
            else
            {
                $template->assign_vars(array(
                    'RESULT' => '<span style="color: #F00;">You are not allowed to use HTML.</span>'
                ));
            }
        }
        else
        {
            $template->assign_vars(array(
                'RESULT' => '<span style="color: #F00;">A similar category already exists.</span>'
            ));
        }
    }
    
    if (isset($_GET['delete'])) {
        $exists = mysql_query('SELECT * FROM gcddl_categories WHERE id="'.intval($_GET['delete']).'" LIMIT 1');
        if (mysql_num_rows($exists) == 1) {
            $error = false;
            if (!mysql_query('DELETE FROM gcddl_categories WERE id = "'.$_GET['delete'].'"') || 
			!mysql_query('DELETE FROM gcddl_downloads WHERE cat = "'.$_GET['delete'].'"')) {
				$error = true;
			}
			if ($error == false)
            {
                $template->assign_vars(array(
                    'RESULT' => '<span style="color: #0F0;">That category has been deleted. Click <a href="admin.php?p=edit_categories">here</a> if the page does not refresh.</span>',
                    'METAREDIRECT' => '<meta http-equiv="refresh" content="5;url=admin.php?p=edit_categories" />'
                ));
            }
            else
            {
                $template->assign_vars(array(
                    'RESULT' => '<span style="color: #F00;">There has been an error while trying to delete that category.</span>'
                ));
            }
        }
        else
        {
            $template->assign_vars(array(
                'RESULT' => '<span style="color: #F00;">The category with that ID does not exist.</span>'
            ));
        }
    }
    
    if (isset($_GET['edit'])) {
        $exists = mysql_query('SELECT * FROM gcddl_categories WHERE id="'.($_GET['edit']+1-1).'" LIMIT 2');
        if (mysql_num_rows($exists) == 1) {
            $cati = mysql_fetch_assoc($exists);
            if (!isset($_POST['ecsb'])) {
                $template->assign_block_vars('ecat',array(
                    'FNAME' => stripslashes($cati['cat_name']),
                    'SNAME' => strtolower(stripslashes($cati['cat_slug']))
                ));
            }
            else
            {
                if ($_POST['ecfn'] == strip_tags($_POST['ecfn']) && $_POST['ecs'] == strip_tags($_POST['ecs'])) {
                    $error = false;
                    if (!mysql_query('UPDATE gcddl_categories SET cat_slug = "'.strtolower(addslashes($_POST['ecs'])).'", cat_name = "'.addslashes($_POST['ecfn']).'" WHERE id="'.$_GET['edit'].'"')) {
						$error = true;
					}
                    if ($error == false) {
                        $template->assign_vars(array(
                            'RESULT' => '<span style="color: #0F0;">That category has been edited successfully. Click <a href="admin.php?p=edit_categories">here</a> if the page does not refresh.</span>',
                            'METAREDIRECT' => '<meta http-equiv="refresh" content="5;url=admin.php?p=edit_categories" />'
                        ));
                    }
                    else
                    {
                        $template->assign_vars(array(
                            'RESULT' => '<span style="color: #F00;">There has been an error while trying to update that category.</span>'
                        ));
                    }
                }
                else
                {
                    $template->assign_vars(array(
                        'RESULT' => '<span style="color: #F00;">You are not allowed to use HTML.</span>'
                    ));
                }
            }
            
        }
        else
        {
            $template->assign_vars(array(
                'RESULT' => '<span style="color: #F00;">The category with that ID does not exist.</span>'
            ));
        }
    }
    
    
    
    $getcats = mysql_query('SELECT * FROM gcddl_categories');
    if (mysql_num_rows($getcats) > 0) {
        while ($cat = mysql_fetch_assoc($getcats)) {
            $template->assign_block_vars('cats', array(
                'NAME' => stripslashes($cat['cat_name']),
                'ID' => $cat['id']
            ));
        }
    }
    else
    {
        $template->assign_block_vars('cats', array(
            'NAME' => 'No download categories',
            'ID' => '#'
        ));
    }
}
?>
