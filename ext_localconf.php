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
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'show_projects',
    [
        'Editor' => 'list, detail, listByTopic, edit, persist, delete, validateByValidationCode',
    ],
    [
        'Editor' => 'list, listByTopic, edit, persist, delete, detail, validateByValidationCode',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'edit_projects',
    [
        'Editor' => 'create, submit, listByTopic, validateByValidationCode',
    ],
    [
        'Editor' => 'create, submit, validateByValidationCode',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'institutions_list',
    [
        'Institution' => 'list, detail, insertForm, add, delete',
    ],
    [
        'Institution' => 'insertForm, add, list, delete',
    ]
    );

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'institutions_insert',
    [
        'Institution' => 'insertForm, add, validateByValidationCode, delete',
    ],
    [
        'Institution' => 'insertForm, add, validateByValidationCode, delete',
    ]
    );

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'experts_list',
    [
        'Expert' => 'list, detail, insertForm, submit, validateByValidationCode, delete',
    ],
    [
        'Expert' => 'insertForm, list, submit, validateByValidationCode, delete',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'experts_insert',
    [
        'Expert' => 'insertForm, submit, validateByValidationCode, delete',
    ],
    [
        'Expert' => 'insertForm, submit, validateByValidationCode, delete',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'publications_list',
    [
        'Publication' => 'list, detail, insertForm, add, delete',
    ],
    [
        'Publication' => 'insertForm, add, list, delete',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'publications_insert',
    [
        'Publication' => 'insertForm, add, delete',
    ],
    [
        'Publication' => 'insertForm, add, delete',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'validate_project',
    [
        'Validator' => 'validateByValidationCode',
    ],
    [
        'Validator' => 'validateByValidationCode',
    ]
);

?>
