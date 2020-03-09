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
return array(
    'ctrl' => [
        'title' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_topic',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'hideTable' => false,
        'rootLevel' => false,
        'default_sortby' => 'ORDER BY title ASC',
        'iconfile' => 'EXT:project_organizer/Resources/Public/Icons/Backend/project-organizer.svg',
        'security' => [
            'ignoreWebMountRestriction' => true,
            'ignoreRootLevelRestriction' => true,
        ],
        'searchFields' => 'title'
    ],
    'interfaces' => array(
        'showRecordFieldList' => 'title'
    ),
    'columns' => array(
        'title' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_topic.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required',
            ],
        ],
        'persons' => [
            'label' => 'Personen',
            'config' => [
                'readOnly' => true,
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_projectorganizer_domain_model_person',
                'MM' => 'tx_projectorganizer_mm_person_topic',
                'foreign_table' => 'tx_projectorganizer_domain_model_person',
                'MM_opposite_field' => 'topics',
            ],
        ],
        'projects' => [
            'label' => 'Projekte',
            'config' => [
                'readOnly' => true,
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_projectorganizer_domain_model_project',
                'MM' => 'tx_projectorganizer_mm_project_topic',
                'foreign_table' => 'tx_projectorganizer_domain_model_project',
                'MM_opposite_field' => 'topics',
            ],
        ],
        'institutions' => [
            'label' => 'Einrichtungen',
            'config' => [
                'readOnly' => true,
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_projectorganizer_domain_model_institution',
                'MM' => 'tx_projectorganizer_mm_institution_topic',
                'foreign_table' => 'tx_projectorganizer_domain_model_institution',
                'MM_opposite_field' => 'topics',
            ],
        ],
    ),
    'types' => [
        '1' => ['showitem' => 'title,
         --div--;Usages, persons, projects, institutions'],
    ],
    'palettes' => array(),
);

?>
