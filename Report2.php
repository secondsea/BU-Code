<html>
<head>
  <Title>IT Security and Confidentiality Training</Title>
  <link rel="stylesheet" type="text/css" href="report.css" />
</head>
<body>
<?php

require 'utils.php';

//Database Connection
$server ='ITDEV';
$connectionInfo = array('Database'=> 'APACS Sandbox',  "UID"=>"stuser", "PWD" => "Training22");
//$connectionInfo = array('Database'=> 'APACS Sandbox');
$db =sqlsrv_connect($server, $connectionInfo);
if ($db === false) { exitWithSQLError('Database connection failed');  }


//LDAP
$LDAPHost = "communityaction.us";
$dn = "OU=USERS, OU=COMMUNITYACTION,DC=communityaction,DC=us";    
$LDAPUserDomain = "@communityaction.us";
$LDAPFieldsToFind = array("cn", "givenname", "samaccountname", "homedirectory", "telephonenumber", "manager", "name", "mail" );
//    print_r ($LDAPFieldsToFind);
$ds=ldap_connect($LDAPHost);  // must be a valid LDAP server!
$LDAPUser = "ITSCCTrain"; 
$LDAPUserPassword = "AccessInfo1";


    if ($ds) { 
		 ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3); 
		 	 ldap_set_option($ds, LDAP_OPT_REFERRALS, 1);  
			      $r=ldap_bind($ds,$LDAPUser.$LDAPUserDomain,$LDAPUserPassword);
				   	$filter="(samaccountname=mcusack)";
	echo $filter;
  	  $sr=ldap_search($ds, $dn, $filter, $LDAPFieldsToFind);
	  

   $info = ldap_get_entries($ds, $sr);
	
  	echo $info["count"];
	echo "pp";
	
	
	}






		$query = "SELECT  * FROM [APACS Sandbox].[dbo].[00securitytest2]  ";
	//	echo $query;
	$qresult =sqlsrv_query($db, $query,array(),array("Scrollable"=>"buffered"));  
	if ($qresult ===False) { 	$db->exitWithError('query fail'); 	}
	if(!sqlsrv_has_rows($qresult)) { 	return false; 	}
	







?>

<p style="text-align: center;"><button onclick="self.location.href = '/ReportExcel.php';">click here to trigger CSV download</button>
</p>
<div id="headings">
	<span id="HeadManager" >Manager</span>
	
</div>
<div id="headings">
	<span id="HeadEmp" >Employee</span>
	<span id="HeadEmail">Email</span>
	<span id="HeadDate">Date Taken</span>
	<span id="HeadAttempts">Attempts</span>
	<span id="HeadOld">At Time of Test</span>
	<span id="HeadNew">Current</span>
	<span id="HeadManEmail">Manager Email</span>
</div>
  <div id="results">
  
  <?php
  
  	while ($row = sqlsrv_fetch_array($qresult)) {
	$shortusername=$row['logon'];
  echo $shortusername;
 //if ($ds) { 
	//	 ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3); 
		// 	 ldap_set_option($ds, LDAP_OPT_REFERRALS, 1);  
			//      $r=ldap_bind($ds,$LDAPUser.$LDAPUserDomain,$LDAPUserPassword);
				   	//$filter="(samaccountname=mcusack)";
	
	$filter="(samaaccountname=$shortusername)";
	
	echo $filter;
  	  $sr=ldap_search($ds, $dn, $filter, $LDAPFieldsToFind);
	  

   $info = ldap_get_entries($ds, $sr);
	
  	echo $info["count"];
	echo "lets see";
	
	
	//}

  
  
  
  
  
  
  
  }
  ?>
  
  
  
  