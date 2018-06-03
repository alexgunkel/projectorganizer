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
        'title' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_project',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'hideTable' => false,
        'rootLevel' => false,
        'default_sortby' => 'ORDER BY title ASC',
        'security' => [
            'ignoreWebMountRestriction' => true,
            'ignoreRootLevelRestriction' => true,
        ],
        'deleted' => 'deleted',
        'enableColumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title'
    ],
    'interfaces' => array(
        'showRecordFieldList' => 'title'
    ),
    'columns' => array(
        'title' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_project.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required',
            ],
        ],
        'hidden' => [
            'label' => 'Hide:',
            'config' => [
                'type' => 'check',
            ],
        ],
        'tstamp' => [
            'label' => 'letzte Änderung',
            'config' => [
                'type' => 'none',
                'format' => 'date',
                'eval' => 'date',
            ],
        ],
        'show_in_map' => [
            'label' => 'Show in map:',
            'config' => [
                'type' => 'check',
            ],
        ],
        'demo_project' => [
            'label' => 'Demo-Projekt:',
            'config' => [
                'type' => 'check',
            ],
        ],
        'hypos' => [
            'label' => 'Show in map:',
            'config' => [
                'type' => 'check',
            ],
        ],
        'validation_state' => [
            'label' => 'Status der Validierung',
            'config' => [
                'type' => 'none',
                'size' => 1,
            ],
        ],
        'contact_person' => [
            'label' => 'Kontaktperson',
            'config' => [
                'type' => 'passthrough',
                'size' => 1,
                'maxitems' => 1,
                'foreign_table' => 'tx_projectorganizer_domain_model_person',
            ],
        ],
        'description' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:label.description',
            'config' => [
                'type' => 'text',
                'cols' => 48,
                'rows' => 30,
            ],
        ],
        'runtime_start' => [
            'label' => 'Laufzeit von',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 20,
                'eval' => 'date,required',
            ],
        ],
        'runtime_end' => [
            'label' => 'Laufzeit bis',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 20,
                'eval' => 'date,required',
            ],
        ],
        'volume' => [
            'label' => 'Fördervolumen',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim',
            ],
        ],
        'overall_volume' => [
            'label' => 'Gesamtvolumen',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim',
            ],
        ],
        'link' => [
            'label' => 'Link zum Projekt',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'size' => 40,
            ],
        ],
        'contact_email' => [
            'label' => 'E-Mail',
            'config' => [
                'type' => 'input',
                'eval' => 'email',
                'size' => 40,
            ],
        ],
        'location' => [
            'label' => 'Ort',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim',
            ],
        ],
        'status' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_status',
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
                'foreign_table' => 'tx_projectorganizer_domain_model_status',
            ],
        ],
        'password_hash' => [
            'label' => 'Details & Erfahrungen',
            'config' => [
                'type' => 'text',
                'size' => 20,
                'eval' => 'trim, required',
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
        'orig' => [
            'label' => 'Original',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_projectorganizer_domain_model_project',
                'size' => 1,
                'maxitems' =>1,
            ],
        ],
        'region' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_region',
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
                'foreign_table' => 'tx_projectorganizer_domain_model_region',
            ],
        ],
        'institution' => [
            'label' => 'Beteiligte Einrichtungen',
            'config' => [
                'foreign_table' => 'tx_projectorganizer_domain_model_institution',
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'MM' => 'tx_projectorganizer_mm_project_institution',
            ],
        ],
        'researchprogram' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_researchprogram',
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
                'foreign_table' => 'tx_projectorganizer_domain_model_researchprogram',
            ],
        ],
        'topics' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_topic',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_projectorganizer_domain_model_topic',
                'MM' => 'tx_projectorganizer_mm_project_topic',
                'foreign_selecter' => 'projects',
            ],
        ],
        'publications' => [
            'label' => 'Veröffentlichungen',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'fieldControl' => [
                    'addRecord' => [
                        'disabled' => false,
                    ],
                ],
                'MM' => 'tx_projectorganizer_mm_project_publication',
                'allowed' => 'tx_projectorganizer_domain_model_publication',
                'foreign_table' => 'tx_projectorganizer_domain_model_publication',
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
                'MM' => 'tx_projectorganizer_mm_project_persons',
                'allowed' => 'tx_projectorganizer_domain_model_person',
                'foreign_table' => 'tx_projectorganizer_domain_model_person',
            ],
        ],
    ),
    'types' => [
        '1' => ['showitem' => 'title, accepted, accepted_by, show_in_map, demo_project, hypos, topics, runtime_start, runtime_end, region, status,
        --div--;Projektdetails, description, volume, overall_volume, link, place, wsk_element, researchprogram,
        --div--;Kontakte, institutions, persons, contact_person,
        --div--;Publikationen, publications'],
    ],
    'palettes' => array(),
);
