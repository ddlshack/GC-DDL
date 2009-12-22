<div id="main">		
    <h1>Downloads Listing</h1>
    <table style="width: 100%;">
        <tr>
            <td style="width: 10%;text-align:center;"><strong>Type</strong></td>
            <td style="width: 70%;"><strong>Download Title</strong></td>
            <td style="width: 10%;text-align:center;"><strong>Date</strong></td>
            <td style="width: 10%;text-align:center;"><strong>Views</strong></td>
        </tr>
        <!-- BEGIN lstdls -->
            <tr>
                <td style="text-align:center;border-bottom: 1px #454545 dashed;">{lstdls.TYPE}</td>
                <td style="border-bottom: 1px #454545 dashed;"><a href="{lstdls.URL}">{lstdls.TITLE}</a></td>
                <td style="text-align:center;border-bottom: 1px #454545 dashed;">{lstdls.DATE}</td>
                <td style="text-align:center;border-bottom: 1px #454545 dashed;">{lstdls.VIEWS}</td>
            </tr>
        <!-- END lstdls -->
    </table>
	<br />		
    <p>
        <strong>Pages: </strong>
        <!-- BEGIN pages -->
            <a href="{pages.HREF}">{pages.NUM}</a>
        <!-- END pages -->
    </p>
</div>