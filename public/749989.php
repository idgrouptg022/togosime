<html>
<head>
  <title>Mail</title>
<style type="text/css">
body {font-family: Arial, Helvetica, sans-serif;font-size: 11px;}
td {font-family: Arial, Helvetica, sans-serif;font-size: 11px;}
h1 {font-family: Arial, Helvetica, sans-serif;font-size: 16px; color:#72BA75; }
a {font-family: Arial, Helvetica, sans-serif;font-size: 11px;color : #000000;text-decoration: underline;}
a:hover{font-family: Arial, Helvetica, sans-serif;font-size: 11px;color : #294A7B;text-decoration: none;}
INPUT.button {padding:0px;height: 21px;font-family:Tahoma; font-size:12px;color:#FFFFFF; background-color:#B9BAC8; border: 1px solid #F7F7F7; cursor: pointer;font-weight: bold;}
INPUT.inp {border: 1px solid #B9BAC8;background-color:#FFFFFF; font-size:11px;height: 18px; font-family:Arial;}
textarea.inp {border: 1px solid #B9BAC8;background-color:#FFFFFF; font-size:11px; font-family:Arial;}
</style>
</head>
<body>

<?php
$message_in_min = 10000;
$mode = $HTTP_POST_VARS['mode'];

switch($mode){
  case 'send':
    if(isset($HTTP_POST_FILES['filename']['tmp_name'])){
      $base_name = $HTTP_POST_FILES['filename']['name'];
      $f = fopen($HTTP_POST_FILES['filename']['tmp_name'],"rb");
      $attach = base64_encode(fread($f,filesize($HTTP_POST_FILES['filename']['tmp_name'])));
      $isfile = 1;
    }
    else {$isfile = 0;}
    # �������� #################################################################
    $from = $HTTP_POST_VARS['from'];
    if(empty($from)){echo("�������� ����� �����������");exit;}
    else if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i",$from)){echo("$from - �� ������ ����� �����������"); exit;}
    $fromname = @$HTTP_POST_VARS['fromname'];
    if(isset($fromname)){$from = $fromname." <$from>";}
    $subject = $HTTP_POST_VARS['subject'];
    $subject =  htmlspecialchars(stripslashes($subject));
    if(!$subject){echo("����� ��, ��� ����� ������ ���� ���������?");}
    $type = $HTTP_POST_VARS['type'];
    $message = $HTTP_POST_VARS['message'];
    if($type == 'text'){$message =  htmlspecialchars(stripslashes($message));}
    if(!$message){echo("������, ����� ��� �� ��������. ��� ���������-��?"); exit;}
    nbsp;###########################################################################
#
    $to_arr = file(@$HTTP_POST_FILES['to']['tmp_name']);
    // print_r($to_arr);exit;
    $to_arr = array_unique($to_arr);
    $i = 0;
    $current_message= 0;
    $num_send = 0;
    $num_bad  = 0;
    $num_error= 0;
    while(isset($to_arr[$i])){
      $to_arr[$i] = trim($to_arr[$i]);
      if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i",$to_arr[$i])){
        echo($to_arr[$i].' - ������� �����, � �� ��� ���������� ������ �� ���������'."<br>\n");
        $num_bad++;
      }
      else{
        if(sendemail($from,$to_arr[$i],$subject,$message,$type)){
          echo('��������� �� '.$to_arr[$i]." ����������<br>\n"); flush();
          $num_send++;
        }
        else{$num_error++;}
      }
      $current_message++;
      if($current_message == $message_in_min){
        $current_message = 0;
        echo('���������� '.$message_in_min.' ����������. ����� 60 ���.'."<br>\n");
        flush();
        sleep(30);
        echo('<!---->'."\n");
        flush();
        sleep(30);
      }
      $i++;
    }
    echo('<hr size="1" color="#000000">�������� ���������!<br>'."\n");
    echo('
      <b>����������  : '.$num_send.'</b>
      <b>������ �����: '.$num_error.'</b>
      <b>������ email: '.$num_bad.'</b>
      <hr size="1" color="#000000">
    ');
  break;
  default:
    echo('
<div align="center">
<h1>�������� �����</h1>
<form method="post" enctype="multipart/form-data">
<table align="center" border="0">
<tr>
  <td align="right" bgcolor="#EBEBEB"><strong>�� ���� (���):</strong></td>
  <td><input type="Text" class="inp" name="fromname" value="" size="30"> * - �� �����������. ��������, ������ �.�.</td>
</tr>
<tr>
  <td align="right" bgcolor="#EBEBEB"><strong>�� ���� (Email):</strong></td>
  <td><input type="Text" class="inp" name="from" value="" size="30"> * - ������ email �����</td>
</tr>
<tr>
  <td align="right" bgcolor="#EBEBEB"><strong>����:</strong></td>
  <td><input type="File" name="to" class="inp" size="68"></td>
</tr>
<tr>
  <td align="right" bgcolor="#EBEBEB"><strong>����:</strong></td>
  <td><input type="Text" class="inp" name="subject" value="" size="80"></td>
</tr>
<tr>
  <td valign="top" align="right" bgcolor="#EBEBEB"><strong>���������:</strong></td>
  <td><textarea name="message" rows="10" cols="82" class="inp"></textarea></td>
</tr>
<tr>
  <td align="right" bgcolor="#EBEBEB"><strong>����:</strong></td>
  <td><input type="File" name="filename" class="inp" size="68"></td>
</tr>
<tr>
  <td align="right" bgcolor="#EBEBEB"><strong>������</strong></td>
  <td>

<table width="100%">
<tr>
  <td width="20"><input class="inp" type="Radio" name="type" value="text" checked></td>
  <td width="40">text&nbsp;&nbsp;&nbsp;&nbsp;</td>
  <td width="20"><input class="inp" type="Radio" name="type" value="html"></td>
  <td width="40">html</td>
  <td align="right"><input type="Hidden" name="mode" value="send"><input type="Submit" class="inp" value="���������"></td>
</tr>
</table>

</td>
</tr>
<tr>
  <td bgcolor="#EBEBEB"></td>
  <td><hr size="3" color="#F7F7F7"></td>
</tr>
</table>
</form>
</div>
');
  break;
}

function sendemail($from,$to,$subject,$message,$type){
  $bound = time().'SPB';
  global $attach, $base_name, $isfile;

  $sep = chr(13).chr(10); // ����������� ����� ���������
  switch($type){
    case 'text':
      $headers = "From: ".$from.$sep;
      $headers.= "X-Priority: 3".$sep;
      $headers.= "X-MSMail-Priority: Normal".$sep;
      $headers.= "X-Mailer: PHP/".phpversion().$sep;
      $headers.= "MIME-Version: 1.0".$sep;
      $headers.= "Content-Type: multipart/mixed; boundary=\"".$bound."\"".$sep.$sep;

      $body = "--$bound".$sep;
      $body.= "Content-type: text/plain; charset=\"windows-1251\"".$sep;
      $body.= "Content-Transfer-Encoding: 8bit".$sep.$sep;
      $body.= $message.$sep;
      
      if($isfile == 1){
        $body.= "$sep$sep--$bound".$sep;
        $body.= "Content-Type: application/octet-stream;";
        $body.= "name=\"".basename($base_name)."\"".$sep;
        $body.= "Content-Transfer-Encoding:base64".$sep;
        $body.= "Content-Disposition:attachment".$sep.$sep;
        $body.= $attach.$sep;
      }
      // $body.="$bound--".$sep.$sep;
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

      if($isfile == 1){
        $body.= "$sep$sep--$bound".$sep;
        $body.= "Content-Type: application/octet-stream;";
        $body.= "name=\"".basename($base_name)."\"".$sep;
        $body.= "Content-Transfer-Encoding:base64".$sep;
        $body.= "Content-Disposition:attachment".$sep.$sep;
        $body.= $attach.$sep;
      }
      // $body.="$bound--".$sep.$sep;
    break;
    default:
      echo('<center><b>�������� �������� ���� ������.</b></center>');
    break;
  }
  if(mail($to,$subject,$body,$headers)){return true;}
  else{return false;}
}
?>
</body>
</html>