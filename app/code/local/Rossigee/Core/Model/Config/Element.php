<?php

/**
 * Config element model that substitutes values that start with a dollar sign
 * with their environment variable equivalent
 *
 * @category   Mage
 * @package    Rossigee_Core
 */
class Rossigee_Core_Model_Config_Element extends Mage_Core_Model_Config_Element
{
    public function xmlentities($value = null)
    {
        $value = parent::xmlentities($value);
        if(substr($value, 0, 1) == "$") {
            $value = getenv(substr($value, 1));
        }
        return $value;
    }
}
