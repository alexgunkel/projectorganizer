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
        'title' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_institution',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'hideTable' => false,
        'rootLevel' => false,
        'default_sortby' => 'ORDER BY title ASC',
        'security' => [
            'ignoreWebMountRestriction' => true,
            'ignoreRootLevelRestriction' => true,
        ],
        'searchFields' => 'title'
    ],
    'interfaces' => array(
        'showRecordFieldList' => 'title'),
    'columns' => array(
        'title' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_institution',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required',
            ],
        ],
        'type' => [
            'label' => 'Art der Einrichtung',
            'config' => [
                'type' => 'select',
                'size' => 1,
                'maxitems' => 1,
                'item' => [
                    [
                        '---- Bitte wählen ----',
                        0
                    ]
                ],
                'foreign_table' => 'tx_projectorganizer_domain_model_institution_type',
            ],
        ],
        'place' => [
            'label' => 'Sitz',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'state' => [
            'label' => 'Bundesland',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'country' => [
            'label' => 'Staat',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'wsk_element' => [
            'label' => 'WSK-Elemente',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_projectorganizer_domain_model_wskelement',
                'size' => 6,
                'maxitems' =>5,
            ],
        ],
        'topics' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_topic',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_projectorganizer_domain_model_topic',
                'MM' => 'tx_projectorganizer_mm_institution_topic',
                'multiple' => '1',
                'foreign_selecter' => 'institutions',
            ],
        ],
        'projects' => [
            'label' => 'Projektbeteiligungen',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_projectorganizer_domain_model_project',
                'fieldControl' => [
                    'addRecord' => [
                        'disabled' => false,
                    ],
                ],
                'MM' => 'tx_projectorganizer_mm_project_institution',
                'MM_opposite_field' => 'institutions',
                'foreign_table' => 'tx_projectorganizer_domain_model_project',
                'multiple' => '1',
            ],
        ],
        'persons' => [
            'label' => 'Beteiligte Personen',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'fieldControl' => [
                    'addRecord' => [
                        'disabled' => false,
                    ],
                ],
                'MM' => 'tx_projectorganizer_mm_person_institution',
                'MM_opposite_field' => 'institutions',
                'allowed' => 'tx_projectorganizer_domain_model_person',
                'foreign_table' => 'tx_projectorganizer_domain_model_person',
                'multiple' => '1',
            ],
        ],
    ),
    'types' => [
        '1' => ['showitem' => 'title, type, place, state, country, wsk_element, topics, persons, projects'],
    ],
    'palettes' => array(),
);

?>
