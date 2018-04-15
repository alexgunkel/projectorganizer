<?php
/**
 * This file is part of ProjectOrganizer.
 *
 * ProjectOrganizer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ProjectOrganizer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ProjectOrganizer.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category TYPO3 Extension
 * @package  Project Organizer
 * @author   Alexander Gunkel <alexandergunkel@gmail.com>
 * @license  GPL
 * @link     http://www.gnu.org/licenses/
 */

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Project Organizer',
    'description' => 'This is a simple organizer extension to manage projects. Projects can be added, edited and validated.',
    'category' => 'misc',
    'version' => '0.0.2',
    'dependencies' => 'cms',
    'conflicts' => '',
    'priority' => 'top',
    'loadOrder' => '',
    'module' => '',
    'state' => 'alpha',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearcacheonload' => 1,
    'lockType' => '',
    'author' => 'Alexander Gunkel',
    'author_email' => 'alexandergunkel@gmail.com',
    'author_company' => '',
    'CGLcompliance' => '',
    'CGLcompliance_note' => '',
    'constraints' => array(
        'depends' => array(
            'typo3' => '7.6.0-8.9.99',
            'php' => '7.1',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
    'autoload' => array(
            'psr-4' => array('AlexGunkel\\ProjectOrganizer\\' => 'Classes/')
    ),
    '_md5_values_when_last_written' => '',
    'suggests' => array(
    ),
);
