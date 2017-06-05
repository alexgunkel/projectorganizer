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
        'title' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_person',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'hideTable' => false,
        'default_sortby' => 'ORDER BY title ASC',
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
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_person.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required',
            ],
        ],
        'specialist_field' => [
            'label' => 'Fachbereich',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim',
            ],
        ],
        'entry_date' => [
            'label' => 'Tätig im Wasserstoffsektor seit',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 20,
                'eval' => 'date',
            ],
        ],
        'place' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:label.place',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim, required',
            ],
        ],
        'e_mail' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:label.email',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'email, required',
            ],
        ],
        'description' => [
            'label' => 'Details & Erfahrungen',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
            ],
        ],
        'wsk_element' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_wsk',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectCheckBox',
                'foreign_table' => 'tx_projectorganizer_domain_model_wskelement',
                'multiple' => '1',
            ],
        ],
        'topics' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_topic',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_projectorganizer_domain_model_topic',
                'MM' => 'tx_projectorganizer_mm_person_topic',
                'foreign_selecter' => 'persons',
            ],
        ],
        'projects' => [
            'label' => 'Projektbteiligungen',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_projectorganizer_domain_model_project',
                'fieldControl' => [
                    'addRecord' => [
                        'disabled' => false,
                    ],
                ],
                'MM' => 'tx_projectorganizer_mm_project_persons',
                'foreign_table' => 'tx_projectorganizer_domain_model_project',
                'foreign_field' => 'persons',
            ],
        ],
        'institutions' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_institution',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_projectorganizer_domain_model_institution',
                'fieldControl' => [
                    'addRecord' => [
                        'disabled' => false,
                    ],
                ],
                'MM' => 'tx_projectorganizer_mm_person_institution',
                'foreign_table' => 'tx_projectorganizer_domain_model_institution',
                'foreign_field' => 'persons',
            ],
        ],
        'publications' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:label.publications',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_projectorganizer_domain_model_publication',
                'fieldControl' => [
                    'addRecord' => [
                        'disabled' => false,
                    ],
                ],
                'MM' => 'tx_projectorganizer_mm_person_publication',
                'foreign_table' => 'tx_projectorganizer_domain_model_publication',
                'foreign_field' => 'persons',
            ],
        ],
    ),
    'types' => [
        '1' => ['showitem' => 'title, specialist_field, entry_date, place, topics, wsk_element,
         --div--;Details, description, projects, institutions, e_mail,
         --div--;Publikationen, publications'],
    ],
    'palettes' => array(
    ),
);

?>
