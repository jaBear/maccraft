<?
$return = array();

$to      = 'nobody@example.com';
$subject = 'the subject';
$headers = 'From: webmaster@example.com' . "\r\n" .
		'Content-type: text/html' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$message = 'New order from sait<br/><br/>';
if($_REQUEST['contact'] && is_array($_REQUEST['contact']))
{
	foreach ($_REQUEST['contact'] as $value) 
	{
		switch ($value['name']) {
			case 'name':
					$message .= 'Name: '.$value['value'].'<br/>';
				break;
			case 'phone':
					$message .= 'Phone: '.$value['value'].'<br/>';
				break;
			case 'addr':
					$message .= 'Address: '.$value['value'].'<br/>';
				break;
			
			default:
					$message .= 'Unknown<br/>';
				break;
		}
	}
}
if($_REQUEST['device'])
	$message .= 'Device: '.$_REQUEST['device'].'<br/>';
if($_REQUEST['model'])
	$message .= 'Model: '.$_REQUEST['model'].'<br/>';
if($_REQUEST['malfunction'])
	$message .= 'Malfunction: '.$_REQUEST['malfunction'].'<br/>';
if($_REQUEST['master'])
	$message .= 'Master: '.$_REQUEST['master'].'<br/>';

$success = mail($to, $subject, $message, $headers);
if (!$success) {
	$return['error'] = true;
  $return['error_msg'] = error_get_last();
}


die(json_encode($return));