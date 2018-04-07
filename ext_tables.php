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

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'AlexGunkel.' . $_EXTKEY,
    'show_projects',
    'Project list'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'AlexGunkel.' . $_EXTKEY,
    'edit_projects',
    'Create and edit projects'
);
$TCA['tt_content']['types']['list']['subtypes_excludelist']['projectorganizer_edit_projects'] = 'layout,select_key,pages,recursive';
$TCA['tt_content']['types']['list']['subtypes_addlist']['projectorganizer_edit_projects'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'projectorganizer_edit_projects',
    'FILE:EXT:project_organizer/Configuration/FlexForms/project_organizer_edit_projects.xml'
);

$TCA['tt_content']['types']['list']['subtypes_excludelist']['projectorganizer_show_projects'] = 'layout,select_key,pages,recursive';
$TCA['tt_content']['types']['list']['subtypes_addlist']['projectorganizer_show_projects'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'projectorganizer_show_projects',
    'FILE:EXT:project_organizer/Configuration/FlexForms/project_organizer_show_projects.xml'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'AlexGunkel.' . $_EXTKEY,
    'validate_project',
    'Projekte validieren'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'AlexGunkel.' . $_EXTKEY,
    'experts',
    'Expert list'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'AlexGunkel.' . $_EXTKEY,
    'topics',
    'Themenfelder'
);

if (TYPO3_MODE === 'BE') {

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'AlexGunkel.' . $_EXTKEY,
        'web',
        'Projects',
        '',
        array(
            'Manager' => 'listOpenRequests, detail, validate, refuse, delete',
        ),
        array(
            'access' => 'admin',
            'icon' => 'EXT:project_organizer/Resources/Public/Icons/Backend/project-organizer.svg',
            'labels'  => 'LLL:EXT:project_organizer/Resources/Private/Language/locallang.xlf',
        )
    );

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    $_EXTKEY,
    'Configuration/TypoScript/',
    'ProjectOrganizer Static Files'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="DIR:EXT:project_organizer/Configuration/TSConfig/Page" extension="ts">'
);

?>
