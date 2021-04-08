<?php

// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * External Web Service Template
 *
 * @package    localwstemplate
 * @copyright  2011 Moodle Pty Ltd (http://moodle.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->libdir."/externallib.php");
//use external_api;

class local_metadata extends external_api {

/**
     * Returns description of lometdata() parameters.
     *
     * @return \external_function_parameters
     */
     public static function lometadata_parameters() {
        $instanceid = new external_value(PARAM_INT, 'The course module id', VALUE_REQUIRED);
        $fieldid = new external_value(PARAM_INT, 'The type of metadata', VALUE_REQUIRED);
        $data = new external_value(PARAM_TEXT, 'The value of metadata', VALUE_REQUIRED);
        $dataformat = new external_value(PARAM_INT, 'The format of metadata', VALUE_REQUIRED);


        $params = array('instanceid' => $instanceid, 'fieldid' => $fieldid, 'data' => $data, 'dataformat' => $dataformat);

        return new external_function_parameters($params);
    }
    
    /**
     * Returns description of list_course_pparameters() parameters.
     *
     * @return \external_function_parameters
     */
    public static function list_course_pparameters_parameters() {
        $courseid = new external_value(
            PARAM_INT,
            'The course id',
            VALUE_REQUIRED
        );
        $params = array(
            'id' => $courseid,
        );
        return new external_function_parameters($params);
    }

    /**
     * Adds group and cohort metadata to course module for personalisation.
     *
     * @return \external_function_parameters
     */
    public static function course_module_personalisation_parameters() {
        $cmid = new external_value(PARAM_INT, 'The course module id', VALUE_REQUIRED);
        $availability = new external_value(PARAM_TEXT, 'The expression of availability', VALUE_REQUIRED);
        
        $params = array('id' => $cmid, 'availability' => $availability);
        return new external_function_parameters($params);
    }

     /**
     * Turns on/off personalisation for user.
     *
     * @return \external_function_parameters
     */
    public static function user_personalisation_parameters() {
        $userid = new external_value(PARAM_INT, 'The user id', VALUE_REQUIRED);
        $data = new external_value(PARAM_TEXT, 'The state of personalisation', VALUE_REQUIRED);
        
        $params = array('userid' => $userid, 'data' => $data);
        return new external_function_parameters($params);
    }


    public static function user_preferences_parameters() {
        $courseid = new external_value(PARAM_INT, 'The course id', VALUE_REQUIRED);
        $params = array('courseid' => $courseid);
        return new external_function_parameters($params);
    }

    public static function modify_user_preferences_parameters() {
        $parameter = new external_value(PARAM_TEXT, 'The personalisation parameter', VALUE_REQUIRED);
        $userid = new external_value(PARAM_INT, 'The user id', VALUE_REQUIRED);
        $data = new external_value(PARAM_TEXT, 'The value of metadata', VALUE_REQUIRED);
        
        $params = array('parameter' => $parameter, 'userid' => $userid, 'data' => $data);
        return new external_function_parameters($params);
    }

    /**
     * Adds metadata to course module.
     */
    public static function lometadata($instanceid, $fieldid, $data, $dataformat) {
        global $CFG, $DB;
        require_once($CFG->dirroot . '/config.php');

        $params = self::validate_parameters(self::lometadata_parameters(), array(
            'instanceid' => $instanceid,
            'fieldid' => $fieldid,
            'data' => $data,
            'dataformat' => $dataformat,
        ));

        if ($course_module_metadata = $DB->get_record('local_metadata', ['instanceid' => $instanceid, 'fieldid' => $fieldid])){
            $course_module_metadata->data  = $data;
            $DB->update_record('local_metadata', $course_module_metadata);
            }

	    else {
            $transaction = $DB->start_delegated_transaction();
            //self::validate_context(context_module::instance($params['instanceid']));
            $DB->insert_records('local_metadata', array($params));
            $transaction->allow_commit();
        }
	
    }

    public static function modify_user_preferences($parameter, $userid, $data) {
        global $CFG, $DB;
        require_once($CFG->dirroot . '/config.php');

        $params = self::validate_parameters(self::modify_user_preferences_parameters(), array(
            'parameter' => $parameter,
            'userid' => $userid,
            'data' => $data,
            ));

        $param = $DB->get_record('user_info_field', ['shortname' => $parameter]);
  
        if ($user_data = $DB->get_record('user_info_data', ['userid' => $userid, 'fieldid' => $param->id])){
            $user_data->data  = $data;
            $DB->update_record('user_info_data', $user_data);
            }

    }

        /**
     * Adds preferences to user.
     */
    public static function user_preferences($courseid) {
        global $CFG, $DB;
        require_once($CFG->dirroot . '/config.php');

        $params = self::validate_parameters(self::user_preferences_parameters(), array(
            'courseid' => $courseid
        ));

        $enrolled_users = $DB->get_records_sql("SELECT c.id, u.id FROM {course} c JOIN {context} ct ON c.id = ct.instanceid
                                JOIN {role_assignments} ra ON ra.contextid = ct.id  JOIN {user} u ON u.id = ra.userid
                                JOIN {role} r ON r.id = ra.roleid where c.id = $courseid");

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
    }
    
    /**
     * List the personalization parameters in this course.
     *
     * @param int $courseid The course id to check.
     * @return array
     */
    public static function list_course_pparameters($courseid) {
        global $CFG, $DB;
        require_once($CFG->dirroot . '/config.php');

        $params = self::validate_parameters(self::list_course_pparameters_parameters(), array(
            'id' => $courseid,
        ));


        /*$result  = $DB->get_records_sql("SELECT {local_metadata_field}.name 
                                          FROM (({local_metadata_field} 
                                           INNER JOIN {local_metadata} 
                                            ON {local_metadata_field}.id = {local_metadata}.fieldid) 
                                            INNER JOIN {course_modules} 
                                            ON {local_metadata}.instanceid = {course_modules}.id) 
                                            WHERE {local_metadata}.data != '' 
                                            AND {course_modules}.course =$courseid"); */


	$result  = $DB->get_records_sql("SELECT DISTINCT (ROW_NUMBER() OVER (ORDER BY {competency_modulecomp}.competencyid)) AS id, 
					{competency_modulecomp}.competencyid, {competency_modulecomp}.cmid,  
					{local_metadata_field}.name, {local_metadata}.data
					FROM ((({competency_modulecomp} 
					INNER JOIN {local_metadata} ON {competency_modulecomp}.cmid = {local_metadata}.instanceid) 
					INNER JOIN {course_modules} ON {local_metadata}.instanceid = {course_modules}.id) 
					INNER JOIN {local_metadata_field} ON {local_metadata}.fieldid = {local_metadata_field}.id) 
					WHERE {local_metadata}.data != '' AND {course_modules}.course =$courseid"); 
        
        return $result;
    }

    /**
     * Adds restriction for group and cohorts to course module.
     *
     * @param int $cmid The course module id to check.
     * @return array
     */
    public static function course_module_personalisation($cmid, $availability) {
        global $CFG, $DB;
        require_once($CFG->dirroot . '/config.php');

        $params = self::validate_parameters(self::course_module_personalisation_parameters(), array(
            'id' => $cmid, 'availability' => $availability
        ));
        
        if ($course_module = $DB->get_record('course_modules', ['id' => $cmid])){
            $course_module->availability  = $availability;
            $DB->update_record('course_modules', $course_module);
            }
            
    }

    /**
     * Turns personalisation on or off for user
     *
     * @param int $userid The user id to check.
     * @return array
     */
    public static function user_personalisation($userid, $data) {
        global $CFG, $DB;
        require_once($CFG->dirroot . '/config.php');

        $params = self::validate_parameters(self::user_personalisation_parameters(), array(
            'userid' => $userid, 'data' => $data
        ));
        
        if ($userPersonalisation = $DB->get_record('user_info_data', ['userid' => $userid, 'fieldid' => 10])){
            $userPersonalisation->data  = $data;
            $DB->update_record('user_info_data', $userPersonalisation);
            }
            
    }


    /**
     * Returns description of lometadata() result value.
     *
     * @return \external_description
     */
    public static function lometadata_returns() {
        return new external_value(PARAM_BOOL, 'True if successful.');
    }

    /**
     * Returns description of course_module_personalisation() result value.
     *
     * @return \external_description
     */
    public static function course_module_personalisation_returns() {
        return new external_value(PARAM_BOOL, 'True if successful.');
    }

    /**
     * Returns description of user_personalisation() result value.
     *
     * @return \external_description
     */
    public static function user_personalisation_returns() {
        return new external_value(PARAM_BOOL, 'True if successful.');
    }

    /**
     * Returns description of user_preferences() result value.
     *
     * @return \external_description
     */
    public static function user_preferences_returns() {
        return new external_value(PARAM_BOOL, 'True if successful.');
    }

    public static function modify_user_preferences_returns() {
        return new external_value(PARAM_BOOL, 'True if successful.');
    }

    /**
     * Returns description of list_course_pparameters() result value.
     *
     * @return \external_description
     */
    public static function list_course_pparameters_returns() {
        return new external_multiple_structure(
            new external_single_structure(array(
		'id' => new external_value(PARAM_INT, 'Unique ID'),
		'competencyid' => new external_value(PARAM_INT, 'Competency ID'),
		'cmid' => new external_value(PARAM_INT, 'Course Module ID'),
		'name' => new external_value(PARAM_TEXT, 'Metadata name'),
		'data' => new external_value(PARAM_TEXT, 'Parameter name')
		
            ))
        );
    }

}






