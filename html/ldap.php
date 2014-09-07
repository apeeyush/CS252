<?php
//Connect to LDAP server.
$ds=ldap_connect( 'ldap://ldapServer', '389' );

if ($ds) {

    //Using the provided user and password to login into LDAP server.
    //For the dc, normally will be the domain.
    $r=ldap_bind($ds, "cn=admin,dc=cse,dc=iitk,dc=ac,dc=in", "pacmmc");

    // You may add in any filter part on here. "uid" is a profile data inside the LDAP. You may filter by other columns depends on your LDAP setup.
    $sr=ldap_search($ds, "cn=admin,dc=cse,dc=iitk,dc=ac,dc=in", "uid=*");
 
    $info = ldap_get_entries($ds, $sr);
 
    for ($i=0; $i<$info["count"]; $i++) {
        //Print out the user information here. For those uid, displayname, userprincipalname and emailaddress are those data inside a user profile. It will be different for your LDAP setup.
        echo "uid is: " . $info[$i]["uid"][0] . "\n";
        echo "displayName entry is: " . $info[$i]["displayname"][0] . "\n";
//        echo "userPrincipalName entry is: " . $info[$i]["userprincipalname"][0] . "\n";
//        echo "userPrincipalName entry is: " . $info[$i]["emailaddress"][0] . "\n";
    }
    ldap_close($ds);
} else {
    echo "<h4>Unable to connect to LDAP server</h4>";
}
 
?>