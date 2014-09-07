<?php

// using ldap bind 
$ldaprdn = 'cn=admin,dc=cse,dc=iitk,dc=ac,dc=in'; // ldap rdn or dn 
$ldappass = 'pacmmc'; // associated password

// connect to ldap server 
$ldapconn = ldap_connect("ldap.example.com") or die("Could not connect to LDAP server.");

if ($ldapconn) {

// binding to ldap server 
	$ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

// verify binding 
	if ($ldapbind) { 
		echo "LDAP bind successful..."; 
	} else { 
		echo "LDAP bind failed..."; 
	}

}

