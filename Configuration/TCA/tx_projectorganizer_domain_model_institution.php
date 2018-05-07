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
        'institution_type' => [
            'label' => 'Typ',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'location' => [
            'label' => 'Hauptsitz',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'country' => [
            'label' => 'Land',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'wsk_element' => [
            'label' => 'WSK-Element',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_projectorganizer_domain_model_wskelement',
                'size' => 6,
                'item' => [
                    [
                        '---- Bitte wählen ----',
                        0
                    ]
                ],
                'maxitems' =>1,
            ],
        ],
        'topic' => [
            'label' => 'Thema',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_projectorganizer_domain_model_topic',
                'size' => 6,
                'item' => [
                    [
                        '---- Bitte wählen ----',
                        0
                    ]
                ],
                'maxitems' =>1,
            ],
        ],
    ),
    'types' => [
        '1' => ['showitem' => 'title, type, location, country, wsk_element, topic'],
    ],
    'palettes' => array(),
);

?>
