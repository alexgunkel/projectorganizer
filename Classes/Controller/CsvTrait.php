<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 07.07.18
 * Time: 14:35
 */

namespace AlexGunkel\ProjectOrganizer\Controller;


use TYPO3\CMS\Extbase\Mvc\View\EmptyView;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

trait CsvTrait
{
    /**
     * @param $projects
     */
    private function sendCsv($projects): void
    {
        $methods = array_filter(get_class_methods(reset($projects)), function ($name) {
            return 'get' === substr($name, 0, 3) ||  'is' === substr($name, 0, 2);
        });

        // available values:
        // isDemoProject, getResearchprogram, getOrig, isHypos, isShowInMap, getContactEmail, getLocation,
        // getValidationState, getInstitutions, getPasswordHash, getPassword, getUid, getPid, getContactPerson,
        // getDescription, getLink, getOverallVolume, getPublications, getRegion, getResearchprograms,
        // getRuntimeStart, getRuntimeEnd, getStatus, getTitle, getTopics, getVolume, getWskelements, isHidden,
        // isDeleted, getCrDate, getTstamp
        $displayValues = array(
            "isDemoProject",
            "getResearchprogram",
            "getContactEmail",
            "getLocation",
            "getLocation",
            "getInstitutions",
            "getContactPerson",
            "getDescription",
            "getLink",
            "getOverallVolume",
            "getPublications",
            "getRegion",
            "getResearchprograms",
            "getRuntimeStart",
            "getRuntimeEnd",
            "getTitle",
            "getTopics",
            "getVolume"
            //"getWskelements"
        );
        $methods = array_intersect($methods, $displayValues);

        $list = [implode(',', $methods)];

        foreach ($projects as $project) {
            $array = [];
            foreach ($methods as $method) {

                if (in_array($method, $displayValues)) {
                    $item = $project->$method();

                    if ($item instanceof ObjectStorage) {
                        $item = implode(', ', $item->toArray());
                    }

                    if (is_object($item)) {
                        $item = $item->getUid();
                    }
                    $array[] = '"' . str_replace('"', '\'', $item) . '"';
                }
            }
            $list[] = implode(',', $array);
        }

        $this->defaultViewObjectName = EmptyView::class;

        $headers = array(
            'Pragma' => 'public',
            'Expires' => 0,
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Cache-Control' => 'public',
            'Content-Description' => 'File Transfer',
            'Content-Type' => 'plain/text',
            'Content-Disposition' => 'attachment; filename=project.csv',
            'Content-Transfer-Encoding' => 'binary',
        );


        // send headers
        foreach ($headers as $header => $data) {
            $this->response->setHeader($header, $data);
        }

        $this->response->sendHeaders();
        echo implode(PHP_EOL, $list);
        exit(0);
    }
}