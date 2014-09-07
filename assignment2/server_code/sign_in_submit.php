<?php

session_start();
/*** check if the users is already logged in ***/
if(isset( $_SESSION['id'] ) || isset( $_SESSION['username'] ))
{
    $message = 'User is already logged in';
}
/*** check that both the username, password have been submitted ***/
if(!isset( $_POST['username'], $_POST['password']))
{
    $message = 'Please enter a valid username and password';
}
// /*** check the username is the correct length ***/
// elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
// {
//     $message = 'Incorrect Length for Username';
// }
// ** check the password is the correct length **
// elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
// {
//     $message = 'Incorrect Length for Password';
// }
else
{
//    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
//    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

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

        $username = $_POST['username'];
        $password = $_POST['password'];

        $dn = "cn=".$username.",dc=cse,dc=iitk,dc=ac,dc=in";

        $dn_root = "cn=".$username.",dc=cse,dc=iitk,dc=ac,dc=in";
        $dn_admin = "cn=".$username.",cn=Lab_Admin,ou=root,dc=cse,dc=iitk,dc=ac,dc=in";
        $dn_staff = "cn=".$username.",cn=Staff,ou=People,ou=root,dc=cse,dc=iitk,dc=ac,dc=in";
        $dn_faculty = "cn=".$username.",cn=Faculty,ou=People,ou=root,dc=cse,dc=iitk,dc=ac,dc=in";
        $dn_btech = "cn=".$username.",ou=BTech,ou=Students,ou=People,ou=root,dc=cse,dc=iitk,dc=ac,dc=in";
        $dn_mtech = "cn=".$username.",ou=MTech,ou=Students,ou=People,ou=root,dc=cse,dc=iitk,dc=ac,dc=in";
        $dn_phd = "cn=".$username.",ou=PhD,ou=Students,ou=People,ou=root,dc=cse,dc=iitk,dc=ac,dc=in";


        // compare value
        if(ldap_bind($ds, $dn_root, $password)){
            $r=ldap_bind($ds, $dn_root, $password);
            $dn = $dn_root;
        }elseif (ldap_bind($ds, $dn_admin, $password)) {
            $r=ldap_bind($ds, $dn_admin, $password);
            $dn = $dn_admin;
        }elseif (ldap_bind($ds, $dn_staff, $password)) {
            $r=ldap_bind($ds, $dn_staff, $password);
            $dn = $dn_staff;
        }elseif (ldap_bind($ds, $dn_faculty, $password)) {
            $r=ldap_bind($ds, $dn_faculty, $password);
            $dn = $dn_faculty;
        }elseif (ldap_bind($ds, $dn_btech, $password)) {
            $r=ldap_bind($ds, $dn_btech, $password);
            $dn = $dn_btech;
        }elseif (ldap_bind($ds, $dn_mtech, $password)) {
            $r=ldap_bind($ds, $dn_mtech, $password);
            $dn = $dn_mtech;
        }else {
            $r=ldap_bind($ds, $dn_phd, $password);
            $dn = $dn_phd;
        }

        if ($r === -1) {
            echo "Error: " . ldap_error($ds);
        } elseif ($r === true) {
            $message = "You are now logged in!";
            $_SESSION['username'] = $username;
            $_SESSION['dn'] = $dn;
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