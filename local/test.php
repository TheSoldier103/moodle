<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

// This file is NOT a part of Moodle - http://moodle.org/
//
// This client for Moodle 2 is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//

/**
 * SOAP client for Moodle 2
 *
 * @authorr Jerome Mouneyrac
 */

require('/opt/lampp/htdocs/moodle/config.php');

/// SETUP - NEED TO BE CHANGED
$token = '4f0bc12418ab2ebaef108b62f18af7e9';
#$token = 'd000269e51b972becdf5320ee6e6bfc3';
$domainname = 'http://localhost/moodle';
$functionname = 'core_course_get_contents';
$create_group = 'core_group_create_groups';
$competency = 'core_competency_add_competency_to_course_module';
$cohorts = 'core_cohort_create_cohorts';
$lom = 'core_metadata';
$userP = 'local_user_personalisation';



//////// moodle_user_create_users ////////


/// SOAP CALL
$serverurl = $domainname . '/webservice/soap/server.php'. '?wsdl=1&wstoken=' . $token;
/*
//Check that the wsdl is available (no authentication error)
//Note: the wsdl generation script could return a xml error document instead of a WSDL document.
//      SoapClient() would not recognize this xml error document as a WSDL document and it will throw an invalid WSDL exception.
//      So we need to catch these WSDL generation errors first.
//      TODO: try this check only once. Then cache the WSDL. You don't want to do this extra call all the time.
$xml = simplexml_load_file($serverurl);
$faulcode = $xml->xpath('/SOAP-ENV:Envelope/SOAP-ENV:Body/SOAP-ENV:Fault/faultcode');
if (!empty($faulcode[0])) {
    $faultcode = (array) $faulcode[0];
    print_r($faultcode[0]);

    $faultstring = $xml->xpath('/SOAP-ENV:Envelope/SOAP-ENV:Body/SOAP-ENV:Fault/faultstring');
    if (!empty($faultstring[0])) {
        $faultstring = (array) $faultstring[0];
        print_r('<BR/>');
        print_r($faultstring[0]);
    }
    die();
}*/

////Do the main soap call
$parameters = new stdClass();
//$parameters->courseid = 7;
//$parameters->description = 'This is just a new group';
//$parameters->name = 'Beginyyner_GGK';
$parameters->instanceid = 118;
$parameters->fieldid = 2; 
$parameters->data = 'English';
$parameter = array('instanceid' => $parameters->instanceid, 'fieldid' => $parameters->fieldid, 'data' => $parameters->data);

$userid = 4;
$data = 'datas';
//print_r($parameters);

$client = new SoapClient($serverurl);

//$functions = $client->__getFunctions ();
//var_dump ($functions);

try {
//$resp = $client->__soapCall($lom, array($parameters));
//$resp = $client->__soapCall($cohorts, array([['categorytype' => ['type' => 'system', 'value' => 1],'name' => 'newcohort', 'idnumber' => 'newcohort11', 'descriptionformat' => 1]]));
//$resp = $client->__soapCall($lom, array([['instanceid' => 118, 'fieldid' => 2, 'data' => 'English', 'dataformat' => 0]]));
#$resp = $client->__soapCall($lom, array([['instanceid' => 118, 'fieldid' => 2, 'data' => 'English', 'dataformat' => 0]]));
//$resp = $client->__soapCall($functionname, array(2, 'options' => [['name' => 'excludemodules', 'value' => 0],['name' => 'excludecontents', 'value' => 0]]));
$resp = $client->__soapCall($userP, array('userid' => 3, 'data' => 'momi'));
} catch (Exception $e) {
    print_r($e);
}
if (isset($resp)) {
    print_r($resp);
}
