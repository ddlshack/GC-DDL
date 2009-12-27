<div id="main">		
    <h1>Edit Configuration</h1>
    <p>
        {RESULT}
   </p>
   <form action="" method="post">
       <table style="width: 100%; border: 0px;">
           <!-- BEGIN cfgtbl -->
               <tr>
                    <td style="width: 45%; border-right: 2px #454545 dashed; border-bottom: 2px #454545 dashed;">
                        <strong>{cfgtbl.GNAME}</strong><br />
                        <i>{cfgtbl.DESC}</i>
                    </td>
                    <td style="padding-left: 10px; border-bottom: 2px #454545 dashed; padding-bottom: 5px;">
                        <!-- BEGIN string -->
                            <input type="text" name="{cfgtbl.NAME}" value="{cfgtbl.string.VALUE}" style="width: 100%;" />
                        <!-- END string -->
                        <!-- BEGIN select -->
                            <select name="{cfgtbl.NAME}">
                                <!-- BEGIN option -->
                                    <option value="{cfgtbl.select.option.VALUE}" <!-- IF cfgtbl.select.option.SELECTED -->selected="selected"<!-- ENDIF --> >{cfgtbl.select.option.VTEXT}</option>
                                <!-- END option -->
                            </select>
                        <!-- END select -->
                        
                    </td>
               </tr>
            <!-- END cfgtbl -->
            <tr>
                <td colspan="2" style="text-align: center;">
                    <br />
                    <input type="submit" value="Submit" />
                </td>
            </tr>
       </table>
    </form>
</div>
