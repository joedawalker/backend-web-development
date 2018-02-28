<?php
//This is the accounts controller

// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the acme accounts model for use as needed
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';


// Get the array of categories
$categories = getCategories();

/*var_dump($categories);
exit;*/

$navList = buildNavList($categories);

//echo $navList;
//exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'login':
        include '../view/login.php';
        break;
    case 'registration':
        include '../view/registration.php';
        break;
    case 'register':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        //echo "$clientFirstname, $clientLastname, $clientEmail, $clientPassword";
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        
        //verify that a matching email doesn't exist
        $existingEmail = checkEmailExists($clientEmail);
        echo "$existingEmail";
        // If the email already exists return message
        if($existingEmail){
          $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
          include '../view/login.php';
          exit;
}

        

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit; }
        
        // Send the data to the model
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
        
        // Check and report the result
        if($regOutcome === 1){
         $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
         include '../view/login.php';
         exit;
        } else {
         $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
         include '../view/registration.php';
         exit;
        }
        
        break;
    case 'Login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        
        if(empty($clientEmail) || empty($checkPassword)){
        $message = '<p>Please fill in the Email and Password fields.</p>';
        include '../view/login.php';
        exit; }
        
        break;
    default:
        include '../view/home.php';
}