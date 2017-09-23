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
        'title' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_engagement',
        'label' => 'position',
        'tstamp' => 'tstamp',
        'hideTable' => true,
        'rootLevel' => false,
        'default_sortby' => 'ORDER BY title ASC',
        'security' => [
            'ignoreWebMountRestriction' => true,
            'ignoreRootLevelRestriction' => true,
        ],
        'searchFields' => 'position, person, institution'
    ],
    'interfaces' => array(
        'showRecordFieldList' => 'position, person, institution'),
    'columns' => array(
        'person' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_person',
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
                'foreign_table' => 'tx_projectorganizer_domain_model_person',
            ],
        ],
        'institution' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_institution',
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
                'foreign_table' => 'tx_projectorganizer_domain_model_institution',
            ],
        ],
        'position' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_position',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'start_date' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_engagement.start_date',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'date',
            ],
        ],
        'end_date' => [
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_engagement.end_date',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'date',
            ],
        ],
    ),
    'types' => [
        '1' => ['showitem' => 'person, institution, position, start_date, end_date'],
    ],
    'palettes' => array(),
);

?>
