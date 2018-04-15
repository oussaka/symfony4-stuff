<?php
/**
 * Created by PhpStorm.
 * User: oussaka
 * Date: 12/04/2018
 * Time: 09:50
 */

namespace App\Mailer;

use Psr\Log\LoggerInterface;

class Emailer
{

    public function __construct(string $mySweetParam, $logger)
    {
        $logger->alert('BOOM!');
        $logger->debug($mySweetParam);

        dump($mySweetParam);
    }

    public function create(): \Swift_Message
    {

    }
}