<?php
if (!$safe) {
    exit;
}

// Function Name: Make URL
// Parameters: 
//              $url : (string) The URL that you want to pass through the function.
//              $path : (boolean) Do you want the path to be returned? (true = yes, false = no)
function murl($url,$path) {
    $url1 = parse_url($url);
    if (isset($url1['host']) && isset($url1['path'])) {
        $url1 = ((substr($url1['host'],0,4) == 'www.') ? substr($url1['host'],4,(strlen($url1['host']))) : $url1['host']) . (($path==true) ? $url1['path'] : '');
        return($url1);
    }
    return(false);
}

// Function Name : Result
// Parameters: 
//              $template : (reference variable) The variable of your template...
//              $name : (string) The PUBLIC (as in not a part of a block) variable to show the result in.
//              $message : (string) The message you want to show.
//              $colour : (string) What colour do you want it? if you don't want to set a colour... then leave
//                                  it blank.

function result (&$template, $name, $message, $colour) {
    $template->assign_vars(array(
        $name => ((!empty($colour)) ? '<span style="color: '.$colour.';">' : '').$message.((!empty($colour)) ? '</span>' : '')
    ));
}

?>