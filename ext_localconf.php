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
        'Editor' => 'list, detail, listByTopic, edit, persist',
        'Validator' => 'validateByValidationCode',
    ],
    [
        'Editor' => 'list, listByTopic, edit, persist',
        'Validator' => 'validateByValidationCode',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'edit_projects',
    [
        'Editor' => 'create, submit, listByTopic, validateByValidationCode',
        'Validator' => 'validateByValidationCode',
    ],
    [
        'Editor' => 'create, submit, validateByValidationCode',
        'Validator' => 'validateByValidationCode',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'institutions_list',
    [
        'Institution' => 'list, detail, insertForm, add',
    ],
    [
        'Institution' => 'insertForm, add, list',
    ]
    );

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'institutions_insert',
    [
        'Institution' => 'insertForm, add, validateByValidationCode',
    ],
    [
        'Institution' => 'insertForm, add, validateByValidationCode',
    ]
    );

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'experts_list',
    [
        'Expert' => 'list, detail, insertForm, submit, validateByValidationCode',
    ],
    [
        'Expert' => 'insertForm, list, submit, validateByValidationCode',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'experts_insert',
    [
        'Expert' => 'insertForm, submit, validateByValidationCode',
    ],
    [
        'Expert' => 'insertForm, submit, validateByValidationCode',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'publications_list',
    [
        'Publication' => 'list, detail, insertForm, add',
    ],
    [
        'Publication' => 'insertForm, add, list',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'AlexGunkel.' . $_EXTKEY,
    'publications_insert',
    [
        'Publication' => 'insertForm, add',
    ],
    [
        'Publication' => 'insertForm, add',
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
