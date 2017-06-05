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
        'title' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_publication',
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
            'label' => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang_tca.xlf:tx_projectorganizer_domain_model_publication.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required',
            ],
        ],
        'type' => [
            'label' => 'Art der Publikation',
            'config' => [
                'type' => 'select',
                'items' => [['', 0]],
                'foreign_table' => 'tx_projectorganizer_domain_model_publication_type',
            ],
        ],
        'year' => [
            'label' => 'Jahr',
            'config' => [
                'type' => 'input',
                'size' => 6,
                'eval' => 'trim, integer',
            ],
        ],
        'link' => [
            'label' => 'Link',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
            ],
        ],
        'institutions' => [
            'label' => 'Einrichtung',
            'config' => [
                'type' => 'select',
                'items' => [['', 0]],
                'foreign_table' => 'tx_projectorganizer_domain_model_institution',
            ],
        ],
        'projects' => [
            'label' => 'Project',
            'config' => [
                'type' => 'select',
                'items' => [['', 0]],
                'foreign_table' => 'tx_projectorganizer_domain_model_project',
            ],
        ],
        'persons' => [
            'label' => 'Autoren',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'fieldControl' => [
                    'addRecord' => [
                        'disabled' => false,
                    ],
                ],
                'MM' => 'tx_projectorganizer_mm_person_publication',
                'MM_opposite_field' => 'publication',
                'foreign_table' => 'tx_projectorganizer_domain_model_person',
                'allowed' => 'tx_projectorganizer_domain_model_person',
                'multiple' => '1',
            ],
        ],
    ),
    'types' => [
        '1' => ['showitem' => 'title, type, year, link, author'],
    ],
    'palettes' => array(),
);

?>
