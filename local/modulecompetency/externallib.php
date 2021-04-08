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
require_once($CFG->libdir . "/externallib.php");

//use external_api;
use core_competency\api;

class local_module_competency extends external_api {

/**
     * Returns description of add_competency_to_course_module() parameters.
     *
     * @return \external_function_parameters
     */
    public static function add_competency_to_course_module_parameters() {
        $cmid = new external_value(
            PARAM_INT,
            'The course module id',
            VALUE_REQUIRED
        );
        $competencyid = new external_value(
            PARAM_INT,
            'The competency id',
            VALUE_REQUIRED
        );
        $params = array(
            'cmid' => $cmid,
            'competencyid' => $competencyid,
        );
        return new external_function_parameters($params);
    }

    /**
     * Count the competencies (visible to this user) in this course.
     *
     * @param int $cmid The course id to check.
     * @param int $competencyid Competency id.
     * @return int
     */
    public static function add_competency_to_course_module($cmid, $competencyid) {
        $params = self::validate_parameters(self::add_competency_to_course_module_parameters(), array(
            'cmid' => $cmid,
            'competencyid' => $competencyid,
        ));
        self::validate_context(context_module::instance($params['cmid']));
        return api::add_competency_to_course_module($params['cmid'], $params['competencyid']);
    }

    /**
     * Returns description of add_competency_to_course() result value.
     *
     * @return \external_description
     */
    public static function add_competency_to_course_module_returns() {
        return new external_value(PARAM_BOOL, 'True if successful.');
    }

}






