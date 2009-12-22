<?php
if (!$safe) {
    exit;
}

$adminpages['edit_categories']['file'] = 'admin_ecategories.tpl';

function admin_edit_categories(&$template) {
    $template->assign_vars(array(
        'RESULT' => 'Use the form below, to edit categories.'
    ));
    
    if (isset($_POST['acsb'])) {
        $exists = mysql_query('select * from gc_ddl_categories where cat_slug LIKE "'.strtolower(htmlentities(addslashes($_POST['acs']))).'" OR cat_name LIKE "'.htmlentities(addslashes($_POST['acfn'])).'" limit 1');
        if (mysql_num_rows($exists) == 0) {
            $cati = mysql_fetch_assoc($exists);
            if ($_POST['acfn'] == strip_tags($_POST['acfn']) && $_POST['acs'] == strip_tags($_POST['acs'])) {
                $error = false;
                mysql_query('insert into gc_ddl_categories (cat_slug,cat_name) VALUES ("'.strtolower(htmlentities(addslashes($_POST['acs']))).'","'.htmlentities(addslashes($_POST['acfn'])).'")') or die(eval('$error = true;'));
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
        $exists = mysql_query('select * from gc_ddl_categories where id="'.($_GET['delete']+1-1).'" limit 1');
        if (mysql_num_rows($exists) == 1) {
            $error = false;
            mysql_query('delete from gc_ddl_categories where id = "'.$_GET['delete'].'"') or die(eval('$error = true;'));
            mysql_query('delete from gc_ddl_downloads where cat = "'.$_GET['delete'].'"') or die(eval('$error = true;'));
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
        $exists = mysql_query('select * from gc_ddl_categories where id="'.($_GET['edit']+1-1).'" limit 2');
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
                    mysql_query('update gc_ddl_categories set cat_slug = "'.strtolower(htmlentities(addslashes($_POST['ecs']))).'", cat_name = "'.htmlentities(addslashes($_POST['ecfn'])).'" where id="'.$_GET['edit'].'"') or die(eval('$error = true;'));
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
    
    
    
    $getcats = mysql_query('select * from gc_ddl_categories');
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