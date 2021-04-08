<?php
// This file is part of Moodle - http://moodle.org/
//
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

defined('MOODLE_INTERNAL') || die();

/**
 * Form for editing profile block settings
 *
 * @package    block_learnerprofile
 * @copyright  2010 Remote-Learner.net
 * @author     Olav Jordan <olav.jordan@remote-learner.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_learnerprofile_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $CFG;
        $mform->addElement('header', 'configheader', get_string('learnerprofile_settings', 'block_learnerprofile'));

        $mform->addElement('selectyesno', 'config_display_picture', get_string('display_picture', 'block_learnerprofile'));
        if (isset($this->block->config->display_picture)) {
            $mform->setDefault('config_display_picture', $this->block->config->display_picture);
        } else {
            $mform->setDefault('config_display_picture', '1');
        }

        $mform->addElement('selectyesno', 'config_display_country', get_string('display_country', 'block_learnerprofile'));
        if (isset($this->block->config->display_country)) {
            $mform->setDefault('config_display_country', $this->block->config->display_country);
        } else {
            $mform->setDefault('config_display_country', '1');
        }

        $mform->addElement('selectyesno', 'config_display_city', get_string('display_city', 'block_learnerprofile'));
        if (isset($this->block->config->display_city)) {
            $mform->setDefault('config_display_city', $this->block->config->display_city);
        } else {
            $mform->setDefault('config_display_city', '1');
        }

        $mform->addElement('selectyesno', 'config_display_email', get_string('display_email', 'block_learnerprofile'));
        if (isset($this->block->config->display_email)) {
            $mform->setDefault('config_display_email', $this->block->config->display_email);
        } else {
            $mform->setDefault('config_display_email', '1');
        }

    }
}