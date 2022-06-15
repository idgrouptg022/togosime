<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>(c) private mail-worker (c)</title>
</head>
<style>
* {cursor:default !important;}
body { min-width:1024px; color:#000;}
input, textarea { border:#CCC 1px solid;padding:3px;}
label {color:#333;font-size:11px !important; cursor:pointer !important; background-color:#E4E4E4;padding:5px 8px 5px 5px;}
textarea {margin-top:10px; margin-bottom:10px;}
table td {padding:5px 5px;}
hr {color:#666; size:1; height:1px; width:100%;}

.lines {width:100%; height:1px; background-color:#999;margin:10px 0;}
.content_panel

{
    -webkit-border-radius: 16px;
    -moz-border-radius: 16px;
    border-radius: 16px;

    border: 1px solid #999999;
    color: #333333;
    cursor: pointer;
    height: 28px;
    line-height: 21px;
    outline: medium none;
    overflow: hidden;
    padding: 5px 9px;
    position: relative;
    text-shadow: 1px 1px 0 #FFFFFF;
	margin-left:267px;
}



</style></head>
<body>
<div class="lines"></div>
<center><font size="-1" face="Verdana, Arial, Helvetica, sans-serif" color="#666666"><b>(c) private mail-worker (c)</b></font></center>
<div class="lines"></div>
<?php
////////////////////////////////////////////////////////////////////////////////
ignore_user_abort(true);
set_time_limit (0);
ini_set('max_execution_time',0);
error_reporting(0);
$fileforlogs="log.txt";
////////////////////////////////////////////////////////////////////////////////
$action = $_POST['action'];
if ($action=="send")
 {
  $message = urlencode($message);
  $message = ereg_replace("%5C%22", "%22", $message);
  $message = urldecode($message);
  $message = stripslashes($message);
  $subject = stripslashes($subject);
 }
?>
<form name="form1" method="post" action="" enctype="multipart/form-data"><br>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="left" valign="middle"><td  height="30">
<div align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
Your Email:</font></div></td>
<td  height="30"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<input type="text" name="from" id="from" value="<?php if (isset($from)) echo($from) ?>" size="40">
<label><input type="checkbox" name="random_mail" onClick="javascript:document.getElementById('from').style.display=this.checked?'none':'';"> Random Emails</label>
</font></td>
<td  height="30">
<div align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
Your Name:</font></div></td>
<td  height="30"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<input type="text" name="realname" id="realname" value="<?php print $realname; ?>" size="30">
<label><input type="checkbox" name="random_name" onClick="javascript:document.getElementById('realname').style.display=this.checked?'none':'';"> Random Names</label>
</font></td></tr>
<tr align="left" valign="middle"><td  height="30">
<div align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Reply-To:</font></div></td>
<td  height="30"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<input type="text" name="replyto" id="replyto" value="<?php print $replyto; ?>" size="40">
<label><input type="checkbox" name="random_reply" onClick="javascript:document.getElementById('replyto').style.display=this.checked?'none':'';"> Random Replys-To</label>
</font></td>
<td  height="30">
<div align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
Attach File:</font></div></td>
<td  height="30"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<input type="file" name="file" size="30" style="border:none;"></font></td></tr>
<tr align="left" valign="middle">
  <td  height="30">&nbsp;</td>
  <td height="30" colspan="3">&nbsp;</td>
<tr align="left" valign="middle"><td  height="30">
<div align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Subject:</font></div>
</td><td height="30" colspan="3"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<input type="text" name="subject" id="subject" value="<?php print $subject; ?>" size="66">
<label><input type="checkbox" name="random_sabj" onClick="javascript:document.getElementById('subject').style.display=this.checked?'none':'';"> Random Subjects</label>
</font></td>
<tr valign="top">
<td colspan="3"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<br>
<div class="lines"></div><br>
<b>Message:</b>
<br>
<textarea name="message" cols="60" rows="10"><?php if (isset($message)) echo($message); else echo("Clear this and put Message"); ?>
</textarea><br>
<label><input type="radio" name="contenttype" value="plain" checked> Plain</label>
<label><input type="radio" name="contenttype" value="html"> HTML</label>
<input type="hidden" name="action" value="send">
<input type="submit" value="Start Sending" class="content_panel">
</font></td>
<td width="33%"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<br>
<div class="lines"></div><br>
<b>E-mail List:</b>
<label><input type="checkbox" name="mails_from_file" onClick="javascript:document.getElementById('emaillist').style.display=this.checked?'none':'';document.getElementById('mailfilename').style.display=this.checked?'':'none';"> Load from file</label>
<br>
<input type="input" name="mailfilename" value="filename" style="DISPLAY: none;" id="mailfilename">
<textarea name="emaillist" cols="40" rows="10" id="emaillist"><?php if (isset($emaillist)) echo($emaillist); else echo("Clear this and put Email List"); ?>
</textarea>
<br>
<label><input type="checkbox" name="log_to_file"> Save logs to file <a href="log.txt" style="color:#639;"><u><?php echo($fileforlogs)?></u></a></label>
</font></td></tr></table>
</form>
<center>
<?php
function s() {
   $word="qwrtpsdfghklzxcvbnm";
   return $word[mt_rand(0,strlen($word)-1)];
}
function g() {
   $word="eyuioa";
   return $word[mt_rand(0,strlen($word)-2)];
}
function c() {
   $word="1234567890";
   return $word[mt_rand(0,strlen($word)-3)];
}
function a() {
   $word=array('wa','sa','da','qa','ra','ta','pa','fa','ga','ha','ja','ka','la','za','xa','ca','va','ba','na','ma');
   $ab1=count($word);
   return $wq=$word[mt_rand(0,$ab1-1)];
}
function o() {
   $word=array('wo','so','do','qo','ro','to','po','fo','go','ho','jo','ko','lo','zo','xo','co','vo','bo','no','mo');
   $ab2=count($word);
   return $wq2=$word[mt_rand(0,$ab2-1)];
}
function e() {
   $word=array('we','se','de','qe','re','te','pe','fe','ge','he','je','ke','le','ze','xe','ce','ve','be','ne','me');
   $ab3=count($word);
   return $wq3=$word[mt_rand(0,$ab3-1)];
}
function i() {
   $word=array('wi','si','di','qi','ri','ti','pi','fi','gi','hi','ji','ki','li','zi','xi','ci','vi','bi','ni','mi');
   $ab4=count($word);
   return $wq4=$word[mt_rand(0,$ab4-1)];
}
function u() {
   $word=array('wu','su','du','qu','ru','tu','pu','fu','gu','hu','ju','ku','lu','zu','xu','cu','vu','bu','nu','mu');
   $ab5=count($word);
   return $wq5=$word[mt_rand(0,$ab5-1)];
}
function name0() {return c().c().c().c();}
function name1() {return a().s();}
function name2() {return o().s();}
function name3() {return e().s();}
function name4() {return i().s();}
function name5() {return u().s();}
function name6() {return a().s().g();}
function name7() {return o().s().g();}
function name8() {return e().s().g();}
function name9() {return i().s().g();}
function name10() {return u().s().g();}
function name11() {return a().s().g().s();}
function name12() {return o().s().g().s();}
function name13() {return e().s().g().s();}
function name14() {return i().s().g().s();}
function name15() {return u().s().g().s();}
function randword()
{
 $cool=array(1,2,3,4,5,6,7,8,9,10,99,100,111,666,1978,1979,1980,1981,1982,1983,1984,1985,1986,1987,1988,1989,1990,1991,1992,1993,1994,1995,1996,1997,1998,1999,2000,2001,2002,2003,2004,2005,2011);
 $func="name".mt_rand(0,15);
 $func2="name".mt_rand(0,15);
 switch (mt_rand(0,2))
  {
   case 0: return $func().$func2();
   case 1: return $func().$cool[mt_rand(0,count($cool)-9)];
   case 2: return $func();
   default: return $func();
  }
}
function randmail()
{
 $domain=array('mail.dk','gmx.net','home.nl','web.de','live.nl','online.no','bluewin.ch','live.com','live.com.au','libero.it','gmx.de','yahoo.com.au','yahoo.co.uk','hotmail.co.uk','hotmail.fr','hotmail.no','hotmail.it','yahoo.dk','yahoo.se','yahoo.no','yahoo.fr','yahoo.it','mail.com','hotmail.com','aol.com','microsoft.com','yahoo.com','gmail.com','theglobeandmail.com','mail333.com','pmail.com','lycos.com','royalmail.com','dailymail.co.uk','apple.com','imc.org','sun.com','hushmail.com','mozilla.org','worldemail.com','mailstart.com','cnn.com','operamail.com','almail.com','netscape.com','email.com','latinmail.com','bigmailbox.com','e-mps.org','internet.com','comcast.net','nova.edu');
 $dom="@".$domain[mt_rand(0,29)];
 return randword().$dom;
}
function randsabj()
{
 $c=mt_rand(1,5);
 $sabj="";
 For($a=0;$a<=$c;$a++)
 {
  $sabj .= randword()." ";
 }
 return $sabj;
}
///////////////////////GET ENV//////////////////////////////////////////////////
if ($action=="send")
 {
  $from             = $_POST['from'];
  $subject          = $_POST['subject'];
  $message          = $_POST['message'];
  $emaillist        = $_POST['emaillist'];
  $random_mail      = $_POST['random_mail'];
  $random_name      = $_POST['random_name'];
  $realname         = $_POST['realname'];
  $replyto          = $_POST['replyto'];
  $random_reply     = $_POST['random_reply'];
  $subject          = $_POST['subject'];
  $random_sabj      = $_POST['random_sabj'];
  $mailfilename     = $_POST['mailfilename'];
  $mails_from_file  = $_POST['mails_from_file'];
  $log_to_file      = $_POST['log_to_file'];
  $contenttype = $_POST['contenttype']."; charset=utf-8";
  $file_name        = $_FILES['file']['name'];
  $file        		= $_FILES['file']['tmp_name'];
//////////////////////CHECK DATA////////////////////////////////////////////////
  if ($random_mail!="on")
  { if (!$from)
    {
      echo("<font color=red>You mast enter your E-mail.</font>");
      exit;
    }
  }
  if ($random_name!="on")
  { if (!$realname)
    {
      echo("<font color=red>You mast enter your nName.</font>");
      exit;
    }
  }
  if ($random_reply!="on")
  { if (!$replyto)
    {
      echo("<font color=red>You mast enter your Reply-To field.</font>");
      exit;
    }
  }
  if ($random_sabj!="on")
  { if (!$subject)
    {
      echo("<font color=red>You mast enter Sabject.</font>");
      exit;
    }
  }
  if (!$message)
  {
   echo("<font color=red>You mast enter message to send.</font>");
   exit;
  }
  if ($mails_from_file!="on")
  { if (!$emaillist)
    {
      echo("<font color=red>You mast enter E-mails where send mails.</font>");
      exit;
    }
  }
  else
  {
    if (!file_exists($mailfilename))
    {
      echo("<font color=red>File \"".$mailfilename."\" with e-mail dosn't exists</font>");
      exit;
    }
  }
////////////////////////////////////////////////////////////////////////////////
if ($mails_from_file!="on")
{
$allemails = split("\n", $emaillist);
$numemails = count($allemails);
}
else
{
$allemails = file($mailfilename);
$numemails = count($allemails);
}

if ($file_name)
 {
  @copy($file, "./$file_name") or die("The file you are trying to upload couldn't be copied to the server");
  $content = fread(fopen($file,"r"),filesize($file));
  $content = chunk_split(base64_encode($content));
  $uid = strtoupper(md5(uniqid(time())));
  $name = basename($file);
 }

if ($log_to_file=="on")
{
  print "Work started<br>";
  print "Logs saves in ".$fileforlogs."<br>";
  flush();
}

for($x=0; $x<$numemails; $x++)
 {
  $to = $allemails[$x];
  if ($to)
   {
////////////////////////////////////////////////////////////////////////////////
    if ($random_mail=="on")
    {
     $from = randmail();
    }
    if ($random_name=="on")
    {
     $realname = randword();
    }
    if ($random_reply=="on")
    {
     $replyto = randmail();
    }
    if ($random_sabj=="on")
    {
     $subject = randsabj();
    }
////////////////////////////////////////////////////////////////////////////////
    $to = ereg_replace(" ", "", $to);
    $message = ereg_replace("&email&", $to, $message);
    $subject = ereg_replace("&email&", $to, $subject);
	
    if ($log_to_file!="on")
    {
    print "Sending mail to $to.......";
    flush();
    }
    $header = "From: $realname <$from>\r\nReply-To: $replyto\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    if ($file_name) $header .= "Content-Type: multipart/mixed; boundary=$uid\r\n";
    if ($file_name) $header .= "--$uid\r\n";
    $header .= "Content-Type: text/$contenttype\r\n";
    $header .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $header .= "$message\r\n";
    if ($file_name) $header .= "--$uid\r\n";
    if ($file_name) $header .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
    if ($file_name) $header .= "Content-Transfer-Encoding: base64\r\n";
    if ($file_name) $header .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n\r\n";
    if ($file_name) $header .= "$content\r\n";
    if ($file_name) $header .= "--$uid--";
    @mail($to, $subject, "", $header);
    if ($log_to_file!="on")
    {
    print "ok<br>";
    flush();
    }
    else
    {
    $fp = fopen ($fileforlogs, "w+");fwrite ($fp, ($x+1)." mails sended");fclose ($fp);
    }
   }
 }
}
?>
</center>
<br><div class="lines"></div>
<style type="text/css">
<!--
.style1 {
        font-size: 10px;
        font-family: Geneva, Arial, Helvetica, sans-serif;
}
-->
</style>
</body>
</html>