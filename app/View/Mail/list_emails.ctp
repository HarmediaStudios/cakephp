<?php
$total_emails = count($domain_emails);
foreach ($domain_emails as $key => $email) {
	$key++;
	echo $email['VirtualUser']['email'];
	if ($key < $total_emails) {
		echo "<br/>";
	}
}
?>