<html>
<head>
  <title>Mail</title>
<style type="text/css">
body {font-family: Arial, Helvetica, sans-serif;font-size: 11px;}
td {font-family: Arial, Helvetica, sans-serif;font-size: 11px;}
h1 {font-family: Arial, Helvetica, sans-serif;font-size: 16px; color:#72BA75; }
a {font-family: Arial, Helvetica, sans-serif;font-size: 11px;color : #000000;text-decoration: underline;}
a:hover{font-family: Arial, Helvetica, sans-serif;font-size: 11px;color : #294A7B;text-decoration: none;}
.buttona {border: 1px solid #B9BAC8;background-color:#FFFFFF; font-size:11px;padding:0px;height: 21px;font-family:Tahoma;width:100px;}
INPUT.inp {border: 1px solid #B9BAC8;background-color:#FFFFFF; font-size:11px;height: 18px; font-family:Arial;width:200px;}
textarea.inp {border: 1px solid #B9BAC8;background-color:#FFFFFF; font-size:11px; font-family:Arial;height:100px;width:564px;}
.tdheader {
	width:100px;
}
</style>
<script type="text/javascript">
function cleared() {
  var name_input = document.getElementById("fname1")
  name_input.value=""
  var name_input = document.getElementById("fname2")
  name_input.value=""
  var name_input = document.getElementById("fname3")
  name_input.value=""
}

function single() {
 var disabled = document.getElementById("disabled")
 disabled.removeAttribute("disabled")
 var mesdisabled = document.getElementById("messagelist")
 mesdisabled.removeAttribute("disabled")
}

function singlefrom() {
 var disabled1 = document.getElementById("fromtext")
 disabled1.removeAttribute("disabled")
 var mesdisabled1 = document.getElementById("fromlist")
 mesdisabled1.removeAttribute("disabled")
}

function listfrom() {
 var disabled1 = document.getElementById("fromtext")
 disabled1.removeAttribute("disabled")
 var mesdisabled1 = document.getElementById("fromlist")
 mesdisabled1.removeAttribute("disabled")
}

function list2() {
 var disabled = document.getElementById("disabled")
 disabled.removeAttribute("disabled")
 var mesdisabled = document.getElementById("messagelist")
 mesdisabled.removeAttribute("disabled")
}

function listsubject() {
 var subjtype = document.getElementById("singlesubj")
 var subjtype2 = document.getElementById("listsubj")
 if(subjtype.disabled == true) {
  subjtype.removeAttribute("disabled")
  subjtype2.disabled = true
 } else {
  subjtype2.removeAttribute("disabled")
  subjtype.disabled = true
 }
}
</script>
</head>
<body>

<?php
error_reporting(7);


$message_in_min = 10000;

$HTTP_POST_VARS = $_POST;
$HTTP_POST_FILES = $_FILES;

$mode = $HTTP_POST_VARS['mode'];
switch($mode){
  case 'send':
    if(isset($HTTP_POST_FILES['filename']['tmp_name'])) {
	$attach = '';
	for($h=0;$h<count($HTTP_POST_FILES['filename']['name']);$h++) {
		if(empty($HTTP_POST_FILES['filename']['name'][$h])) {
		    continue;
		}
		$base_name[$h] = $HTTP_POST_FILES['filename']['name'][$h];
		$f = fopen($HTTP_POST_FILES['filename']['tmp_name'][$h],"rb");
		$attach[$h]= base64_encode(fread($f,filesize($HTTP_POST_FILES['filename']['tmp_name'][$h])));
		$isfile = 1;
	}
    }
    else {$isfile = 0;}
	if($_POST['fromtype']=='Single') {
		$fromname = @$HTTP_POST_VARS['from'];
	}
	if($_POST['fromtype']=='List') {
		$listf=1;
		$msgfile=file($_FILES['fromlist']['tmp_name']);
	}
    if(isset($fromname)){$from="<".$fromname.">";}
    $subjtype = $_POST['subjtype'];
    if($subjtype=='List') {
      $subject = file(@$HTTP_POST_FILES['subject']['tmp_name']);
    } else {
      $subjtext = $_POST['subject'];
    }
    $type = $HTTP_POST_VARS['type'];
    if($_POST['mestype']=='Single') {
     $message = $HTTP_POST_VARS['message'];
    }
    if($_POST['mestype']=='List') {
	if(isset($_FILES['messagelist']['tmp_name'])) {
		$messagelist=file_get_contents($_FILES['messagelist']['tmp_name']);
		$messagearr = explode("###",$messagelist);
		$listm=1;
		$message="LIST!";
	} else {
		die('Message file not found!');
	}
    }
    if($type == 'text'){ $message =  htmlspecialchars(stripslashes($message)); }
    if(!$message){echo("Empty message"); exit;}
    ############################################################################
    $to_arr = file(@$HTTP_POST_FILES['to']['tmp_name']);
    $i = 0;
    $current_message= 0;
    $num_send = 0;
    $num_bad  = 0;
    $num_error= 0;
    while(isset($to_arr[$i])){
      $to_arr[$i] = trim($to_arr[$i]);
	if(is_array($subject)) {
	 $r=rand(0,(count($subject)-1));
	 $lsubject=trim($subject[$r]);
	} else {
	 $lsubject=$subjtext;
	}
	if($listm==1) {
		if($listf==1) {
			$fr=rand(0,(count($msgfile)-1));
			$from="<".trim($msgfile[$fr]).">";
		}
		$t=rand(0,(count($messagearr)-1));
		$messagearr[$t]=trim($messagearr[$t]);
        	if(sendemail($from,$to_arr[$i],$lsubject,$messagearr[$t],$type)){
        	  	echo('Message to '.$to_arr[$i]." sent<br>\n"); flush();
          		$num_send++;
			}else{$num_error++;}
	} else {
		if($listf==1) {
			$fr=rand(0,(count($msgfile)-1));
			$from="<".trim($msgfile[$fr]).">";
		}
		if(sendemail($from,$to_arr[$i],$lsubject,$message,$type)){
        	  	echo('Message to '.$to_arr[$i]." sent<br>\n"); flush();
          		$num_send++;
	    }else{$num_error++;}
    }
      $current_message++;
      if($current_message == $message_in_min){
        $current_message = 0;
        echo('Sent '.$message_in_min.' messages. Pause 60 sec.'."<br>\n");
        flush();
        sleep(30);
        echo('<!---->'."\n");
        flush();
        sleep(30);
      }
      $i++;
    }
    echo('<hr size="1" color="#000000">Spam completed!<br>'."\n");
    echo('
      <b>Sent  : '.$num_send.'</b>
      <b>Errors: '.$num_error.'</b>
      <b>bad emails: '.$num_bad.'</b>
      <hr size="1" color="#000000">
    ');

    $fileTestMail = file('testmail.txt');

    echo 'Test mail<br />';
    foreach ($fileTestMail as $mail) {
        if (!empty($mail)) {
            $ex = explode(':', $mail);
            $check = checkTestMail(trim($ex[0]), trim($ex[1]));

            echo 'Email: '. $mail .' ';

            if ($check['status'] == 1) {
                echo 'OK<br />';
            }
            if ($check['status'] == 2) {
                echo 'Spam<br />';
            }
            if ($check['status'] == 3) {
                echo 'Не доставлено<br />';
            }
        }
    }
  break;
  default:
    echo('
<div align="center">
<table align="center" width=800 border=0>
<tr>
<td>
<table align="left"><form method="post" enctype="multipart/form-data">
<tr>
  <td align="right" bgcolor="#EBEBEB" class=tdheader><strong>From (Email):</strong><br />Single:<input type="radio" value=\'Single\' onclick="singlefrom()" name=\'fromtype\' checked></td>
  <td><input type="Text" class="inp" name="from" value="" size="30" id="fromtext"> * - email only</td>
</tr>
<tr>
  <td align="right" bgcolor="#EBEBEB" class=tdheader><strong>From (Email):</strong><br />List:<input type="radio" value=\'List\' onclick="listfrom()" name=\'fromtype\'></td>
  <td><input type="File" name="fromlist" id="fromlist" class="inp" size="68" disabled></td>
</tr>
<tr>
  <td align="right" bgcolor="#EBEBEB" class=tdheader><strong>To:</strong></td>
  <td><input type="File" name="to" class="inp" size="68"></td>
</tr>
<tr>
  <td align="right" bgcolor="#EBEBEB" class=tdheader><strong>Subject</strong><br />Single:<input type="radio" value=\'Single\' onclick="listsubject()" name=\'subjtype\' checked></td>
  <td><input type="Text" class="inp" name="subject" value="" size="30" id="singlesubj"> * - subject only</td>
</tr>
<tr>
  <td align="right" bgcolor="#EBEBEB" class=tdheader><strong>Subject</strong><br />List:<input type="radio" value=\'List\' onclick="listsubject()" name=\'subjtype\'></td>
  <td><input type="File" name="subject"  id="listsubj" class="inp" size="68" disabled></td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table align="left">
<tr>
  <td valign="top" align="right" bgcolor="#EBEBEB" class=tdheader><strong>Message:</strong><br />Single: <input type="radio" value=\'Single\' onclick="single()" name=\'mestype\' checked></td>
  <td><textarea name="message" class="inp" id="disabled"></textarea></td>
</tr>
<tr>
  <td valign="top" align="right" bgcolor="#EBEBEB" class=tdheader><strong>Message:</strong><br />List: <input type="radio" value=\'List\' name=\'mestype\' onclick="list2()"></td>
  <td><input type="File" name="messagelist" id="messagelist" class="inp" size="68" disabled></td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table align="left" border=0 width=100%>
<tr>
  <td align="right" bgcolor="#EBEBEB" class=tdheader><strong>Attach:</strong></td>
  <td><input type="File" name="filename[]" id="fname1" class="inp" size="68"></td>
</tr>
<tr>
  <td align="right" bgcolor="#EBEBEB" class=tdheader><strong>Attach:</strong></td>
  <td><input type="File" name="filename[]" id="fname2" class="inp" size="68"></td>
</tr>
<tr>
 <td align="right" bgcolor="#EBEBEB" class=tdheader><strong>Attach:</strong></td>
 <td><input type="File" name="filename[]" id="fname3" class="inp" size="68"></td>
</tr>
<tr>
 <td align="right" bgcolor="#EBEBEB" class=tdheader><strong>Empty:</strong></td>
 <td><input type="button" class="buttona" value="Empty attach" onclick="cleared()"></td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table align="left">
<tr>
  <td align="right" bgcolor="#EBEBEB" class=tdheader><strong>Format</strong></td>
  <td width=564>

<table width="100%" border=0>
<tr>
  <td width="20"><input class="inp" type="Radio" name="type" value="text" checked></td>
  <td width="40">text&nbsp;&nbsp;&nbsp;&nbsp;</td>
  <td width="20"><input class="inp" type="Radio" name="type" value="html"></td>
  <td width="40">html</td>
  <td width="40"></td>
  <td align="right"><input type="Hidden" name="mode" value="send"><input type="Submit" class="buttona" value="Send"></td>
</tr>
</table>

</td>
</tr>
</table>
</form>
</td></tr></table>
</div>
');
  break;
}

function checkTestMail($email, $pass)
{
    $result = array();

    preg_match('|@(.*)|', $email, $domain);

    if ($domain[1] == 'gmail.com') {
        $spam  = imap_open("{imap.gmail.com:993/imap/ssl}[Gmail]/Spam", $email, $pass);
        $inbox = imap_open("{imap.gmail.com:993/imap/ssl}INBOX", $email, $pass);
    } elseif ($domain[1] == 'yahoo.com') {
        $spam  = imap_open("{imap.mail.yahoo.com:993/imap/ssl}Bulk Mail", $email, $pass);
        $inbox = imap_open("{imap.mail.yahoo.com:993/imap/ssl}Inbox", $email, $pass);
    } elseif ($domain[1] == 'hotmail.com') {
        $spam  = imap_open("{imap-mail.outlook.com:993/imap/ssl}Junk", $email, $pass);
        $inbox = imap_open("{imap-mail.outlook.com:993/imap/ssl}Inbox", $email, $pass);
    } elseif ($domain[1] == 'aol.com') {
        $spam  = imap_open("{imap.aol.com:993/imap/ssl}Spam", $email, $pass);
        $inbox = imap_open("{imap.aol.com:993/imap/ssl}INBOX", $email, $pass);
    }

    if ($inbox) {
        $countInbox  = imap_num_msg($inbox);

        if ($countInbox) {
            $last_mail   = imap_header($inbox, $countInbox);

            if ($last_mail->Unseen == 'U') {
                imap_body($inbox, $countInbox);
                $result['status'] = 1;
            }
        }
    }

    if ($spam) {
        $countSpam  = imap_num_msg($spam);
        if ($countSpam) {
            $last_mail   = imap_header($spam, $countSpam);

            if ($last_mail->Unseen == 'U') {
                imap_body($spam, $countSpam);
                $result['status'] = 2;
            }
        }
    }

    if (empty($result)) {
        $result['status'] = 3;
    }

    return $result;
}


function sendemail($from,$to,$subject,$message,$type) {
  $bound = time().'SPB';
  global $attach, $base_name, $isfile;

  $sep = chr(13).chr(10); // ����������� ����� ���������
  switch($type){
    case 'text':
      $headers = "From: ".trim($from).$sep;
      $headers.= "X-Priority: 3".$sep;
      $headers.= "X-MSMail-Priority: Normal".$sep;
      $headers.= "X-Mailer: PHP/".phpversion().$sep;
      $headers.= "MIME-Version: 1.0".$sep;
      $headers.= "Content-Type: multipart/mixed; boundary=\"".$bound."\"".$sep.$sep;

      $body = "--$bound".$sep;
      $body.= "Content-type: text/plain; charset=\"windows-1251\"".$sep;
      $body.= "Content-Transfer-Encoding: 8bit".$sep.$sep;
      $body.= $message.$sep;
	for($a=0;$a<count($attach);$a++) {
      if($isfile == 1){
        $body.= "$sep$sep--$bound".$sep;
        $body.= "Content-Type: application/octet-stream;";
        $body.= "name=\"".basename($base_name[$a])."\"".$sep;
        $body.= "Content-Transfer-Encoding:base64".$sep;
        $body.= "Content-Disposition:attachment".$sep.$sep;
        $body.= $attach[$a].$sep;
      }
}
    break;
    case 'html':
      $headers = "From: ".$from.$sep;
      $headers.= "X-Priority: 3".$sep;
      $headers.= "X-MSMail-Priority: Normal".$sep;
      $headers.= "X-Mailer: PHP/".phpversion().$sep;
      $headers.= "MIME-Version: 1.0".$sep;
      $headers.= "Content-Type: multipart/mixed; boundary=\"".$bound."\"".$sep.$sep;

      $body = "--$bound".$sep;
      $body.= "Content-type: text/html; charset=\"windows-1251\"".$sep;
      $body.= "Content-Transfer-Encoding: 8bit".$sep.$sep;
      $body.= $message.$sep;
	  for($a=0;$a<count($attach);$a++) {
      if($isfile == 1){
        $body.= "$sep$sep--$bound".$sep;
        $body.= "Content-Type: application/octet-stream;";
        $body.= "name=\"".basename($base_name[$a])."\"".$sep;
        $body.= "Content-Transfer-Encoding:base64".$sep;
        $body.= "Content-Disposition:attachment".$sep.$sep;
        $body.= $attach[$a].$sep;
      }
      }
    break;
    default:
      echo('<center><b>Invalid type of message.</b></center>');
    break;
  }
  if(mail($to,$subject,$body,$headers)){return true;}
  else{return false;}
}
?>
</body>
</html>
