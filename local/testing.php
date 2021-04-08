<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

#define('CLI_SCRIPT', true); 
require('/opt/lampp/htdocs/moodle/config.php');
//require('config.php');

//defined('MOODLE_INTERNAL') || die();
 
//function my_function_making_use_of_database() {
#global $DB, $USER;
global $DB;





#$parameters = new stdClass();
//$parameters->courseid = 7;
//$parameters->description = 'This is just a new group';
//$parameters->name = 'Beginyyner_GGK';
//$parameters->id = 5;
#$parameters->instanceid = 336;
#$parameters->fieldid = 2; 
#$parameters->data = 'Edop';
#$parameters->dataformat = 0;
#$parameter = array('instanceid' => $parameters->instanceid, 'fieldid' => $parameters->fieldid, 'data' => $parameters->data);

#$USER->id = 4;

#$userP = $DB->get_records('user_info_data', array('userid' => $USER->id, 'questionnaireid' => 1));
#$userP = $DB->get_record('user_info_data', ['userid' => 3, 'fieldid' => 10]);
#print_r ($userP);
#$userP->data  = 'on';
#$DB->update_record('user_info_data', $userP);


/*
//Get responses for the active/reflective questionnaire for logged-in user
$arFSLS_user_resp = $DB->get_records('questionnaire_response', array('userid' => $USER->id, 'questionnaireid' => 1));
$arFSLS_user_resp = array_shift($arFSLS_user_resp);

if (!empty($arFSLS_user_resp)){
    #$DB->insert_record('user_info_data', array('userid' => 3, 'fieldid' => 7, 'data' => 'activeytt', 'dataformat' => 0));
    $responses = $DB->get_records('questionnaire_resp_single', array('response_id' => $arFSLS_user_resp->id));
    $responses = array_values($responses);
    #print_r($responses);
    $reflective = 0;

    //Get questions for active/reflective dimension
    $active_reflective = array($responses[0]->choice_id, $responses[1]->choice_id, 
                            $responses[2]->choice_id,$responses[3]->choice_id,$responses[4]->choice_id, 
                            $responses[5]->choice_id, $responses[6]->choice_id, $responses[7]->choice_id, 
                            $responses[8]->choice_id, $responses[9]->choice_id, $responses[10]->choice_id);

print_r($active_reflective);
echo "<pre>";
    for ($i = 0; $i < 11; $i++) {
        if($active_reflective[$i] % 2 == 0)  {
		 print_r($active_reflective[$i]);
echo "<pre>";
            $reflective++;}
    }

    print_r('The count of reflective is ' . $reflective);
echo "<pre>";

    if (in_array($reflective, array(6, 7, 8, 9, 10, 11))){
        print_r('I am reflective');
        
        }
    elseif (in_array($reflective, array(0, 1, 2, 3, 4, 5))) {
        print_r('I am active');
        }
        
    }

#try {
#	$transaction = $DB->start_delegated_transaction();
#	$DB->insert_records('local_metadata', $parameters);
	#$DB->insert_record_raw('local_metadata', $parameters, $returnid=true, $bulk=false);
 #     $DB->insert_record('bar', $otherobject);
 
     // Assuming the both inserts work, we get to the following line.
 #    	$transaction->allow_commit();
 
#} catch(Exception $e) {
#     $transaction->rollback($e);
#}

#$DB->insert_record_raw('local_metadata', array('instanceid' => 336, 'fieldid' => 2, 'data' => 'English'));

//print_r($user);

//}

//$user_resp = $DB->get_records('questionnaire_response', array('userid' => 2, 'questionnaireid' => 2));
//$user_resp = array_shift($user_resp);
//print_r($user_resp);

//$DB->get_record_sql('SELECT * FROM {user} WHERE firstname = ? AND lastname = ?', ['Martin', 'Dougiamas']);

#$myarray = array();
#$pparameters = array();
//array_push($myarray, $DB->get_record_sql('SELECT {local_metadata}.data FROM {local_metadata} INNER JOIN {course_modules} ON {local_metadata}.instanceid = {course_modules}.id'));
//$course_modules  = $DB->get_records_sql("SELECT {local_metadata}.id, {local_metadata}.fieldid FROM {local_metadata} INNER JOIN {course_modules} ON {local_metadata}.instanceid = {course_modules}.id WHERE {local_metadata}.data != '' ");

#$courses = 7;

#$parameters  = $DB->get_records_sql("SELECT {local_metadata_field}.name FROM (({local_metadata_field} INNER JOIN {local_metadata} ON {local_metadata_field}.id = {local_metadata}.fieldid) INNER JOIN {course_modules} ON {local_metadata}.instanceid = {course_modules}.id) WHERE {local_metadata}.data != '' AND {course_modules}.course =$courses");



//SELECT mdl_local_metadata_field.name FROM ((mdl_local_metadata_field INNER JOIN mdl_local_metadata ON mdl_local_metadata_field.id = mdl_local_metadata.fieldid) INNER JOIN mdl_course_modules ON mdl_local_metadata.instanceid = mdl_course_modules.id) WHERE mdl_local_metadata.data != '' AND mdl_course_modules.course = 7

//SELECT DISTINCT mdl_local_metadata_field.name, mdl_local_metadata.instanceid, mdl_local_metadata.data FROM ((mdl_local_metadata_field INNER JOIN mdl_local_metadata ON mdl_local_metadata_field.id = mdl_local_metadata.fieldid) INNER JOIN mdl_course_modules ON mdl_local_metadata.instanceid = mdl_course_modules.id) WHERE mdl_local_metadata.data != '' AND mdl_course_modules.course = 3

//SELECT DISTINCT mdl_competency_modulecomp.cmid, mdl_competency_modulecomp.competencyid FROM ((mdl_competency_modulecomp INNER JOIN mdl_local_metadata ON mdl_competency_modulecomp.cmid = mdl_local_metadata.instanceid) INNER JOIN mdl_course_modules ON mdl_local_metadata.instanceid = mdl_course_modules.id) WHERE mdl_local_metadata.data != '' AND mdl_course_modules.course = 3


//SELECT DISTINCT mdl_local_metadata.instanceid, mdl_local_metadata_field.name, mdl_local_metadata.data FROM ((mdl_local_metadata_field INNER JOIN mdl_local_metadata ON mdl_local_metadata_field.id = mdl_local_metadata.fieldid) INNER JOIN mdl_course_modules ON mdl_local_metadata.instanceid = mdl_course_modules.id) WHERE mdl_local_metadata.data != '' AND mdl_course_modules.course = 3 ORDER by mdl_local_metadata.instanceid ASC

//SELECT (ROW_NUMBER() OVER (ORDER BY mdl_local_metadata.data)) AS cid, mdl_competency_modulecomp.cmid, mdl_competency_modulecomp.competencyid, mdl_local_metadata_field.name, mdl_local_metadata.data FROM (((mdl_competency_modulecomp INNER JOIN mdl_local_metadata ON mdl_competency_modulecomp.cmid = mdl_local_metadata.instanceid) INNER JOIN mdl_course_modules ON mdl_local_metadata.instanceid = mdl_course_modules.id) INNER JOIN mdl_local_metadata_field ON mdl_local_metadata.fieldid = mdl_local_metadata_field.id) WHERE mdl_local_metadata.data != '' AND mdl_course_modules.course = 3


//foreach ($course_modules as $cm){
//	array_push ($myarray, $cm->fieldid);}

#foreach ($parameters as $p){array_push ($pparameters, $p->name);}
//$user = $DB->get_record_sql('SELECT COUNT(*) FROM {user} WHERE deleted = 1 OR suspended = 1;');

//$course_modules = $DB->get_records('course_modules', array('course' => 7));
#print_r($pparameters);
//print_r($myarray); */

#$userid = 4;

#$users = [2,4];

$enrolled_users = $DB->get_records_sql("SELECT c.id, u.id FROM {course} c JOIN {context} ct ON c.id = ct.instanceid
                                JOIN {role_assignments} ra ON ra.contextid = ct.id  JOIN {user} u ON u.id = ra.userid
                                JOIN {role} r ON r.id = ra.roleid where c.id = 9");

foreach ($enrolled_users as $u) {
    $USER = new stdClass();
    $USER->id = $u->id;


    //Get responses for the active/reflective questionnaire for logged-in user
    $arFSLS_user_resp = $DB->get_records('questionnaire_response', array('userid' => $USER->id, 'questionnaireid' => 1));
    $arFSLS_user_resp = array_shift($arFSLS_user_resp);


    if (!empty($arFSLS_user_resp)){
        $responses = $DB->get_records('questionnaire_resp_single', array('response_id' => $arFSLS_user_resp->id));
        $responses = array_values($responses);
        $reflective = 0;

        //Get questions for active/reflective dimension
        $active_reflective = array($responses[0]->choice_id, $responses[1]->choice_id, 
                            $responses[2]->choice_id,$responses[3]->choice_id,$responses[4]->choice_id, 
                            $responses[5]->choice_id, $responses[6]->choice_id, $responses[7]->choice_id, 
                            $responses[8]->choice_id, $responses[9]->choice_id, $responses[10]->choice_id);

        for ($i = 0; $i < 11; $i++) {
            if($active_reflective[$i] % 2 == 0){   
                $reflective++;
            }
        }
        
        if (in_array($reflective, array(6, 7, 8, 9, 10, 11))){
            $user_data = $DB->get_record_sql('SELECT * FROM {user_info_data} WHERE userid = ? AND fieldid = ?', [$USER->id, 1]);
            if ($user_data == null){
                $DB->insert_record('user_info_data', array('userid' => $USER->id, 'fieldid' => 1, 'data' => 'reflective'));
            }
        }
        elseif (in_array($reflective, array(0, 1, 2, 3, 4, 5))) {
            $user_data = $DB->get_record_sql('SELECT * FROM {user_info_data} WHERE userid = ? AND fieldid = ?', [$USER->id, 1]);
            if ($user_data == null){
                $DB->insert_record('user_info_data', array('userid' => $USER->id, 'fieldid' => 1, 'data' => 'active'));
            }
        }
    }


    //Get responses for the visual/verbal questionnaire for logged-in user
    $vvFSLS_user_resp = $DB->get_records('questionnaire_response', array('userid' => $USER->id, 'questionnaireid' => 2));
    $vvFSLS_user_resp = array_shift($vvFSLS_user_resp);


    if (!empty($vvFSLS_user_resp)){
        $responses = $DB->get_records('questionnaire_resp_single', array('response_id' => $vvFSLS_user_resp->id));
        $responses = array_values($responses);
        $reflective = 0;

        //Get questions for visual/verbal dimension
        $visual_verbal = array($responses[0]->choice_id, $responses[1]->choice_id, 
                            $responses[2]->choice_id,$responses[3]->choice_id,$responses[4]->choice_id, 
                            $responses[5]->choice_id, $responses[6]->choice_id, $responses[7]->choice_id, 
                            $responses[8]->choice_id, $responses[9]->choice_id, $responses[10]->choice_id);

        for ($i = 0; $i < 11; $i++) {
            if($visual_verbal[$i] % 2 == 0){   
                $verbal++;
            }
        }
        
        if (in_array($verbal, array(6, 7, 8, 9, 10, 11))){
            $user_data = $DB->get_record_sql('SELECT * FROM {user_info_data} WHERE userid = ? AND fieldid = ?', [$USER->id, 3]);
            if ($user_data == null){
                $DB->insert_record('user_info_data', array('userid' => $USER->id, 'fieldid' => 3, 'data' => 'verbal'));
            }
        }
        elseif (in_array($verbal, array(0, 1, 2, 3, 4, 5))) {
            $user_data = $DB->get_record_sql('SELECT * FROM {user_info_data} WHERE userid = ? AND fieldid = ?', [$USER->id, 3]);
            if ($user_data == null){
                $DB->insert_record('user_info_data', array('userid' => $USER->id, 'fieldid' => 3, 'data' => 'visual'));
            }
        }
    }





}