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
        $list = [implode(',', $methods)];
        foreach ($projects as $project) {
            $array = [];
            foreach ($methods as $method) {
                $item = $project->$method();
                if ($item instanceof ObjectStorage) {
                    continue;
                }

                if (is_object($item)) {
                    $item = $item->getUid();
                }
                $array[] = $item;
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