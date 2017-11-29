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
        
        // If this variable has a $ in the first char, use an env var
        if(substr($value, 0, 1) == "$") {

            // If || is in the string, parse it correctly to handle defaults
            $defaultCharPos = strpos($value, '||');
            if ($defaultCharPos !== false) {

                // If env var exists, use it, parsing out the default values
                $envVarName = substr($value, 1, $defaultCharPos-1);
                $defaultValue = substr($value, $defaultCharPos-1);

                // Use whichever of these work for you, or maybe leave it as server if that works?
                // getenv() didn't work for me, but $_SERVER did
                
                $envValue = $_SERVER[$envVarName];
                // $envValue = getenv($envVarName);

                if($envValue) {
                        return $envValue;

                // If it doesn't, use default value provided
                } else {
                        return $defaultValue;
                }

            // No defaults, use the full value no matter what
            } else {
                return getenv(substr($value, 1));
            }

        // If not using an env var, return the hardcoded value.
        } else {
            return $value;
        }
        
    }
}
