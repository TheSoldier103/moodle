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
 * Web service local plugin template external functions and service definitions.
 *
 * @package    localwstemplate
 * @copyright  2011 Jerome Mouneyrac
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// We defined the web service functions to install.
/*$functions = array(
        'local_wstemplate_hello_world' => array(
                'classname'   => 'local_wstemplate_external',
                'methodname'  => 'hello_world',
                'classpath'   => 'local/wstemplate/externallib.php',
                'description' => 'Return Hello World FIRSTNAME. Can change the text (Hello World) sending a new text as parameter',
                'type'        => 'read',
        )
); */

$functions = array(
    'local_course_module_features' => array(
        'classname'    => 'local_metadata',
        'methodname'   => 'lometadata',
        'classpath'    => 'local/metadata/externallib.php',
        'description'  => 'Adds features to a course module',
        'type'         => 'write',
        #'capabilities' => 'moodle/competency:coursecompetencymanage',
        'ajax'         => true,
    ),

    'local_course_module_personalisation' => array(
        'classname'    => 'local_metadata',
        'methodname'   => 'course_module_personalisation',
        'classpath'    => 'local/metadata/externallib.php',
        'description'  => 'Adds metadata for personalisation based on availability',
        'type'         => 'write',
        #'capabilities' => 'moodle/competency:coursecompetencymanage',
        'ajax'         => true,
    ),

    'local_user_personalisation' => array(
        'classname'    => 'local_metadata',
        'methodname'   => 'user_personalisation',
        'classpath'    => 'local/metadata/externallib.php',
        'description'  => 'Turns personalisation on or off for users',
        'type'         => 'write',
        #'capabilities' => 'moodle/competency:coursecompetencymanage',
        'ajax'         => true,
    ),

    'local_user_preferences' => array(
        'classname'    => 'local_metadata',
        'methodname'   => 'user_preferences',
        'classpath'    => 'local/metadata/externallib.php',
        'description'  => 'Adds preferences to users',
        'type'         => 'write',
        #'capabilities' => 'moodle/competency:coursecompetencymanage',
        'ajax'         => true,
    ),

    'local_modify_user_preferences' => array(
        'classname'    => 'local_metadata',
        'methodname'   => 'modify_user_preferences',
        'classpath'    => 'local/metadata/externallib.php',
        'description'  => 'Modifies user preferences',
        'type'         => 'write',
        #'capabilities' => 'moodle/competency:coursecompetencymanage',
        'ajax'         => true,
    ),

    'local_list_course_pparameters' => array(
        'classname'   => 'local_metadata',
        'methodname'  => 'list_course_pparameters',
        'classpath'   => 'local/metadata/externallib.php',
        'description' => 'List Personalisation Parameters represented in a course based on features of the course modules',
        'type'        => 'read',
)
);


// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
#$services = array(
#        'Course Module Metadata' => array(
#                'functions' => array ('core_course_module_features'),
#                'restrictedusers' => 0,
#                'enabled'=>1,
#        )
#);
