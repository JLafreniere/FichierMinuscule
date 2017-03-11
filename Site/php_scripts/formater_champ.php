<?php
function formater($champ)
{
	$champ = str_replace("'","''",$champ);
	$champ = trim($champ);
	$champ = mb_strtoupper(mb_substr($champ, 0, 1)).mb_strtolower(mb_substr($champ, 1, mb_strlen($champ, 'UTF-8') - 1, 'UTF-8'));
	return $champ;
}
?>