<div id="main">		
    <h1>Submit Downloads</h1>
    
    <p>
        {RESULT}
    </p>
    
    <form action="" method="post">
        <table style="width: 100%">
            <tr>
                <td style="width: 1%; text-align: center; border-bottom: 2px #454545 solid;">&nbsp;</td>
                <td style="width: 40%; text-align: center; border-bottom: 2px #454545 solid;"><strong>Title</strong></td>
                <td style="width: 40%; text-align: center; border-bottom: 2px #454545 solid;"><strong>URL</strong></td>
                <td style="width: 19%; text-align: center; border-bottom: 2px #454545 solid;"><strong>Category</strong></td>
            </tr>
            <!-- BEGIN subtbl -->
                <tr>
                    <td style="text-align: center; border-bottom: 1px #454545 dashed;">{subtbl.NUMBER}</td>
                    <td style="text-align: center; border-bottom: 1px #454545 dashed;"><input type="text" name="title[]" value="" style="width: 95%;" /></td>
                    <td style="text-align: center; border-bottom: 1px #454545 dashed;"><input type="text" name="url[]" value="" style="width: 95%;" /></td>
                    <td style="text-align: center; border-bottom: 1px #454545 dashed;">
                        <select name="type[]" style="width: 95%;">
                            <option value="">Select One:</option>
                            <!-- BEGIN type -->
                                <option value="{subtbl.type.SLUG}">{subtbl.type.NAME}</option>
                            <!-- END type -->
                        </select>
                    </td>
                </tr>
            <!-- END subtbl -->
            <tr>
                <td colspan="4" style="width: 15%; text-align: center; padding-top: 10px;">
                    Site Name: <input type="text" name="sname" value="" style="width: 50%;" /><br /><br />
                </td>
            </tr>
            <tr>
                <td colspan="4" style="width: 15%; text-align: center; padding-top: 10px;">
                    Site URL: <input type="text" name="surl" value="" style="width: 50%;" /><br /><br />
                </td>
            </tr>
            <tr>
                <td colspan="4" style="width: 15%; text-align: center; padding-top: 10px;">
                Admin Email: <input type="text" name="email" value="" style="width: 50%;" /><br /><br />
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center; padding-top: 10px;"><input type="submit" value="Submit Downloads!" /></td>
            </tr>
        </table>
    </form>
</div>