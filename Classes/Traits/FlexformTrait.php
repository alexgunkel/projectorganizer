<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 07.04.18
 * Time: 18:05
 */

namespace AlexGunkel\ProjectOrganizer\Traits;


use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * Trait FlexformTrait
 * @package AlexGunkel\ProjectOrganizer\Traits
 */
trait FlexformTrait
{
    /**
     * @param string $identifier
     * @return string
     */
    private function readAsString(string $identifier): ?string
    {
        return $this->readSettings($identifier);
    }

    /**
     * @param string $identifier
     * @return int|null
     */
    private function readAsInteger(string $identifier): ?int
    {
        $contentAsString = $this->readSettings($identifier);

        if (MathUtility::canBeInterpretedAsInteger($contentAsString)) {
            return (int) $contentAsString;
        }

        return null;
    }

    /**
     * @param string $identifier
     * @return null|string
     */
    private function readSettings(string $identifier): ?string
    {
        if (isset($this->settings[$identifier]) && '' !== $this->settings[$identifier]) {
            return (string) $this->settings[$identifier];
        }

        return null;
    }
}