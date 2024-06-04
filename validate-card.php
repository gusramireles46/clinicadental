<?php
require 'vendor/autoload.php';
use Respect\Validation\Validator as validator;
header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);
$cardNumber = $input['cardNumber'] ?? '';
$isValid = validator::creditCard()->validate($cardNumber);
echo json_encode(['valid' => $isValid]);