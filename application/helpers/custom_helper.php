<?php

// function hashValue($value){
// 	$ci =& get_instance();
// 	$ci->load->helper('phpass');

// 	$hasher = new PasswordHash(PASSWORD_HASH_STRENGTH, PASSWORD_HASH_PORTABLE);
// 	$hashedValue = $hasher->HashPassword($value);	
// 	return $hashedValue;
// }

function hash_password($value){
	$ci =& get_instance();
	$ci->load->helper('password');

	$hashed = password_hash($value, PASSWORD_BCRYPT);
	return $hashed;
}

function check_password($value, $hashed){
	$ci =& get_instance();
	$ci->load->helper('password');

	$isValid = password_verify($value, $hashed);
	return $isValid;
}

// function checkPassword($password, $hashedPassword){
// 	$ci =& get_instance();
// 	$ci->load->helper('phpass');

// 	$hasher = new PasswordHash(PASSWORD_HASH_STRENGTH, PASSWORD_HASH_PORTABLE);
// 	$isValid = $hasher->CheckPassword($password, $hashedPassword);

// 	if ($isValid)
// 		return true;
// 	else
// 		return false;

// }



?>