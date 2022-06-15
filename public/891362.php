<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>MAILER</title>
</head>
<body>

<?
function doset() {
set_time_limit(200000);
ini_set("memory_limit", "256M");
ignore_user_abort(true);
}
doset();


if ($_POST['action']=="send"){

$message = urlencode($_POST['message']);

$message = ereg_replace("%5C%22", "%22", $message);

$message = urldecode($message);
$message = stripslashes($message);
$subject = stripslashes($_POST['subject']);

}
?>
<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

<br>

<table width="100%" border="0">

<tr> 

<td width="10%"> 

<div align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 

Email:</font></div>

</td>

<td width="18%"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 

<input type="text" name="from" value="<? print $_POST['from']; ?>" size="30">

</font></td>

<td width="31%"> 

<div align="right"><font size="-1" face="Verdana, Arial, Helvetica, 

sans-serif">Name:</font></div>

</td>

<td width="41%"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 

<input type="text" name="realname" value="<? print $_POST['realname']; ?>" size="30">

</font></td>

</tr>

<tr> 

<td width="10%"> 

<div align="right"><font size="-1" face="Verdana, Arial, Helvetica, 

sans-serif">Reply-To:</font></div>

</td>

<td width="18%"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 

<input type="text" name="replyto" value="<? print $_POST['replyto']; ?>" size="30">

</font></td>

<td width="31%"> 

<div align="right"><font size="-1" face="Verdana, Arial, Helvetica, 

sans-serif">Attach File:</font></div>

</td>

<td width="41%"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 

<input type="file" name="file" size="30">

</font></td>

</tr>

<tr> 

<td width="10%"> 

<div align="right"><font size="-1" face="Verdana, Arial, Helvetica, 

sans-serif">Subiect:</font></div>

</td>

<td colspan="3"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 

<input type="text" name="subject" value="<? print stripslashes($_POST['subject']); ?>" size="90">

</font></td>

</tr>

<tr valign="top"> 

<td colspan="3"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 

<textarea name="message" cols="60" rows="10"><? print 

stripslashes($_POST['message']); ?></textarea>

<br>

<input type="radio" name="contenttype" value="plain">

Plain Text 

<input type="radio" name="contenttype" value="html" checked>

HTML 

<input type="hidden" name="action" value="send">

<input type="submit" value="Send Message">

</font></td>

<td width="41%"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 

<textarea name="emaillist" cols="30" rows="10"></textarea>

<br>
<input type="text" name="emailfinal" value="<? print $_POST['emailfinal']; ?>" 

size="22"> (EMAIL TEST)
</font></td>
</tr>
</table>
<p>For each <input type="text" name="emailz" value="<? print $_POST['emailz']; ?>" 

size="3"> emails wait <input type="text" name="wait" value="<? print $_POST['wait']; ?>" 

size="3"> seconds<br></p>
</form>



<?

if ($_POST['action']=="send"){
$message = urlencode($_POST['message']);

$message = ereg_replace("%5C%22", "%22", $message);

$message = urldecode($message);
$message = stripslashes($message);
$subject = stripslashes($_POST['subject']);


$from=$_POST['from'];
$realname=$_POST['realname'];
$replyto=$_POST['replyto'];


$emaillist=$_POST['emaillist'];
if( strpos($_POST['emailfinal'], "@") !== false)
$emaillist .= "\n". $_POST['emailfinal'];
$contenttype=$_POST['contenttype'];


$allemails = split("\n", $emaillist);

$numemails = count($allemails);



#Deschide fisierul atasat dac. este cazul, base64_encode encodeaza emailu

$file_name = $_FILES["file"]["name"];

$file = $_FILES["file"]["tmp_name"];

If ($file_name){

//@copy($file, "./$file_name") or die("The file you are trying to upload couldn't be copied to the server");

$content = fread(fopen($file,"r"),filesize($file));

$content = chunk_split(base64_encode($content));

$uid = strtoupper(md5(uniqid(time())));

$name = basename($file);

}



for($x=0; $x<$numemails; $x++){

if($_POST['emailz'] && $_POST['wait'])
if( fmod($x,$emailz) == 0 ) {
echo "-------------------------------> Trimit mail $x, si $wait secunde astept.<br>";
sleep($wait);
}

$to = $allemails[$x];

if ($to){

$to = ereg_replace(" ", "", $to);

$message = ereg_replace("&email&", $to, $message);

$subject = ereg_replace("&email&", $to, $subject);

print "Trimit mail catre $to.......";

flush();

$header = "From: $realname <$from>\r\nReply-To: $replyto\r\n";

$header .= "MIME-Version: 1.0\r\n";

If ($file_name) $header .= "Content-Type: multipart/mixed; boundary=$uid\r\n";
If ($file_name) $header .= "This is a multi-part message in MIME format.\r\n";
If ($file_name) $header .= "--$uid\r\n";

$header .= "Content-Type: text/$contenttype\r\n";

$header .= "Content-Transfer-Encoding: 8bit\r\n\r\n";

$header .= "$message\r\n";

If ($file_name) $header .= "--$uid\r\n";

If ($file_name) $header .= "Content-Type: application/octet-stream; name=\"$file_name\"\r\n";

If ($file_name) $header .= "Content-Transfer-Encoding: base64\r\n";

If ($file_name) $header .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n\r\n";

If ($file_name) $header .= "$content\r\n";

If ($file_name) $header .= "--$uid--";

mail($to, $subject, "", $header);

print " SEND<br>";

flush();

}

}

}

?> 

</body>
</html>
