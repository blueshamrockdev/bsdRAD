<?php

namespace BlueShamrock\Symfony\BsdRADBundle\Exception;

use Exception;

/**
 *
 * @author Micah Breedlove <druid628@gmail.com>
 */
class UnauthorizedCinnamon extends \Exception
{
    /*
     * Jewel: I put out cinnamon.
     * Dan: Where?
     * Jewel: The meeting table.
     * Dan: On whose instruction?
     * Jewel: Cinnamon's good with peaches.
     * Dan: Do not put unauthorized cinnamon on the meeting table! That's all we need.
     */

    public static $codeNumber = '307';

    public static $defaultMessage = 'Unauthorized Cinnamon on the table.';

    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        if (empty($message)) {
            $message = static::$defaultMessage;
        }

        if ($code == 0) {
            $code = static::$codeNumber;
        }
        parent::__construct($message, $code, $previous);
    }

}