<?php

/**
 * Convert bytes to kilobytes.
 *
 * @param int $bytes The number of bytes to convert.
 * @param int $decimals The number of decimal places to round to.
 * @return string The formatted string representing kilobytes.
 */
if (!function_exists('convertBytesToKB')) {
    function convertBytesToKB($bytes, $decimals = 2)
    {
        return number_format($bytes / 1024, $decimals) . ' KB';
    }
}

/**
 * Get an array of US states with their abbreviations as keys and full names as values.
 *
 * @return array An associative array of US states.
 */
if (!function_exists('USA_states')) {
    function USA_states()
    {
        return [
            'AK' => 'Alaska',
            'AL' => 'Alabama',
            'AR' => 'Arkansas',
            'AZ' => 'Arizona',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DC' => 'District of Columbia',
            'DE' => 'Delaware',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'IA' => 'Iowa',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'MA' => 'Massachusetts',
            'MD' => 'Maryland',
            'ME' => 'Maine',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MO' => 'Missouri',
            'MS' => 'Mississippi',
            'MT' => 'Montana',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'NE' => 'Nebraska',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NV' => 'Nevada',
            'NY' => 'New York',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VA' => 'Virginia',
            'VT' => 'Vermont',
            'WA' => 'Washington',
            'WI' => 'Wisconsin',
            'WV' => 'West Virginia',
            'WY' => 'Wyoming',
        ];
    }
}

/**
 * Generate a request group code.
 *
 * @param int $length The length of the dynamic part of the code.
 * @return string The generated request group code.
 */
if (!function_exists('requestGroupCode')) {
    function requestGroupCode($length = 6)
    {
        $datePart = date('ymd');

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $dynamicPart = '';

        for ($i = 0; $i < $length; $i++) {
            $dynamicPart .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $datePart . $dynamicPart;
    }
}

/**
 * Generate a random alphanumeric code.
 *
 * @param int $length The length of the code to generate.
 * @return string The generated random alphanumeric code.
 */
if (!function_exists('generateRandomAlphanumericCode')) {
    function generateRandomAlphanumericCode($length)
    {
        // Define the characters to use for the random code
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        // Generate the random code
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        // Return the generated code
        return date('i') . $randomString  . date('H');
    }
}
