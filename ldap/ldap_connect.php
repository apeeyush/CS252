<?php

session_start();
/*** check if the users is already logged in ***/
if(isset( $_SESSION['id'] ) || isset( $_SESSION['username'] ))
{
    $message = 'Users is already logged in';
}
/*** check that both the username, password have been submitted ***/
if(!isset( $_POST['username'], $_POST['password']))
{
    $message = 'Please enter a valid username and password';
}
/*** check the username is the correct length ***/
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for Username';
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
{
    $message = 'Incorrect Length for Password';
}
else
{
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

$ldaphost = 'ldap://localhost';
$ldapport = '389';

$ds = ldap_connect($ldaphost, $ldapport)
or die("Could not connect to $ldaphost");
    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

//ldap_set_option($ds, LDAP_OPT_DEBUG_LEVEL, 7);
if ($ds) 
{
    $ldapbind = ldap_bind($ds);
    if ($ldapbind) {

        // $username = "cn=admin,dc=test,dc=com";
        // $password = "password";
        $username = $_POST['username'].",dc=test,dc=com";
        $password = $_POST['password'];

        // compare value
        $r=ldap_bind($ds, $username, $password);

        if ($r === -1) {
            echo "Error: " . ldap_error($ds);
        } elseif ($r === true) {
            $message = "You are now logged in!";
            $_SESSION['username'] = $username;
            $_SESSION['id'] = '123';
        } elseif ($r === false) {
            $message = "Username/Password incorrect! Login Failed.";
        }
    }else{
        $message = "Access Denied! Please contact Admin";
    }
}
}
?>

<html>
<head>
<title>CS 252</title>
</head>
<body>
<p><?php echo $message; ?>
</body>
</html>