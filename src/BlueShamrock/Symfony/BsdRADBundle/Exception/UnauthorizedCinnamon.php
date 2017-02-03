<?php

namespace BlueShamrock\Symfony\BsdRADBundle\Exeption;

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

    protected $code = '307';

    protected $message = 'Unauthorized Cinnamon on the table.';

}