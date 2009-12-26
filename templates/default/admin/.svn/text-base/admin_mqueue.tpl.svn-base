<script language="JavaScript">
function checkAll(theForm, cName, status) {
	for (i=0,n=theForm.elements.length;i<n;i++) {
		if (theForm.elements[i].className.indexOf(cName) !=-1) {
		    theForm.elements[i].checked = status;
		  }
	}
}
</script>
<div id="main">		
    <h1>Manage Queue</h1>
    <p>
        {RESULT}
    </p>
	<form action="" method="post" id="submit">
		<table style="width: 100%;">
			<tr>
				<td style="width: 10%; border-bottom: 2px #454545 solid; text-align: center;">
					<strong>Type</strong>
				</td>
				<td style="width: 70%; border-bottom: 2px #454545 solid;">
					<strong>Title</strong>
				</td>
				<td style="width: 10%; border-bottom: 2px #454545 solid; text-align: center;">
					<strong>Submitter</strong>
				</td>
				<td style="width: 10%; border-bottom: 2px #454545 solid; text-align: center;">
					<strong>Action | Select All</strong>
				</td>
			</tr>
			<!-- BEGIN queued_downloads -->
			<tr>
				<td style="border-bottom: 2px #454545 dashed; text-align: center;">
					{queued_downloads.TYPE}
				</td>
				<td style="border-bottom: 2px #454545 dashed;">
					<a href="{queued_downloads.URL}">{queued_downloads.TITLE}</a>
				</td>
				<td style="border-bottom: 2px #454545 dashed; text-align: center;">
					<a href="{queued_downloads.SURL}">{queued_downloads.SNAME}</a>
				</td>
				<td style="border-bottom: 2px #454545 dashed; text-align: center;">
					<input type="checkbox" name="action[]" value="{queued_downloads.ID}" class="{queued_downloads.SID}" />
					{queued_downloads.SELECTALL}
				</td>
			</tr>
			<!-- END queued_downloads -->
		</table>
	</form>
</div>