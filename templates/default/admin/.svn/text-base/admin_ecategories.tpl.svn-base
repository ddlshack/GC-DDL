<div id="main">		
    <h1>Edit Categories</h1>
    <p>
        {RESULT}
    </p>
    <!-- BEGIN ecat -->
        <form action="" method="post">
            <p>
                Category Friendly Name: <input type="text" name="ecfn" size="20%" value="{ecat.FNAME}" /><br /><br />
                Category Slug (used for DDL Auto Submitters): <input type="text" name="ecs" size="20%" value="{ecat.SNAME}" /><br /><br />
                <input type="submit" name="ecsb" value="Submit" />
            </p>
        </form>
    <!-- END ecat -->
    <table style="width: 50%;">
        <tr>
            <td style="width: 50%; border-bottom: 2px #454545 solid; border-right: 1px #454545 dashed;"><strong>Category Friendly Name</strong></td>
            <td style="border-bottom: 2px #454545 solid;"><strong>Actions</strong></td>
        </tr>
        <!-- BEGIN cats -->
            <tr>
                <td style="border-bottom: 1px #454545 dashed; border-right: 1px #454545 dashed; text-align: center;">
                    {cats.NAME}
                </td>
                <td style="border-bottom: 1px #454545 dashed; text-align: center;">
                    [ <a href="?p=edit_categories&amp;edit={cats.ID}">Edit</a> ] | [ <a href="?p=edit_categories&amp;delete={cats.ID}">Delete</a> ]
                </td>
            </tr>
        <!-- END cats -->
    </table>
    <form action="" method="post">
        <p>
            Category Friendly Name: <input type="text" name="acfn" size="20%" value="" /><br /><br />
            Category Slug (used for DDL Auto Submitters): <input type="text" name="acs" size="20%" value="" /><br /><br />
            <input type="submit" name="acsb" value="Submit" />
        </p>
    </form>
</div>