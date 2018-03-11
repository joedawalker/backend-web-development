<?php
//This is the accounts controller
/* accounts super user 
 * Email: admin@cit336.net
 * Password: Sup3rU$er
 */
session_start();

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
$adminLink = '<p><a href="/acme/products/" class="adminLink">Product Manangement</a></p>';
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
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
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
        
        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        include '../view/admin.php';
        exit;
        break;
    case'Logout':
        session_destroy();
        header('Location: /acme/');
        break;
    case 'editClient':
        $clientInfo = getClientInfo($_SESSION['clientData']['clientId']);
        if(count($clientInfo)<1){
            $upmessage = 'Sorry, account information could not be found.';
        }
        include '../view/client-update.php';
        break;
    case 'updateClient':
        // Filter and store the data
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        
        if($_SESSION['clientData']['clientEmail'] != $clientEmail) {
             //verify that a matching email doesn't exist
            $existingEmail = checkEmailExists($clientEmail);
            echo "$existingEmail";
            
            // If the email already exists return message
            if($existingEmail){
              $upmessage = '<p class="notice">That email address is already associated with another account.</p>';
              include '../view/client-update.php';
              exit;
            }
        }

        

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $upmessage = '<p id="upmessage">Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
        exit; }
        
        $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
        
        // Check and report the result
        if ($updateResult) {
            $clientData = getClient($clientEmail);
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            $message = "<p id='message'>$clientFirstname $clientLastname your account was updated successfully.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/accounts/');
            exit;
        } else {
            $upmessage = "<p id='upmessage'>Sorry, system failed to update your account. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    
    case 'changePass':
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($clientPassword);
        
        if(empty($checkPassword)){
            $pmessage = '<p id="pmessage">Password rejected. Please enter a new password using the correct password format.</p>';
            // get original client info so preceding form remains filled in;
            $clientInfo = getClientInfo($_SESSION['clientData']['clientId']);
            if(count($clientInfo)<1){
             $upmessage = 'Sorry, account information could not be found.';
            }
        include '../view/client-update.php';
        exit; }
        
        //make password unreadable
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        
        $pswdResult = updatePassword($clientId, $hashedPassword);
        
        // Check and report the password change status
        if ($pswdResult) {
            $clientData = getClient($_SESSION['clientData']['clientEmail']);
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            $message = "<p id='message'>$clientData[clientFirstname] $clientData[clientLastname] your password was updated successfully.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/accounts/');
            exit;
        } else {
             // get original client info so preceding form remains filled in;
            $clientInfo = getClientInfo($_SESSION['clientData']['clientId']);
            if(count($clientInfo)<1){
             $upmessage = 'Sorry, account information could not be found.';
            }
            $pmessage = "<p id='pmessage'>Sorry, system failed to update your password. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    default:
        include '../view/admin.php';
}

