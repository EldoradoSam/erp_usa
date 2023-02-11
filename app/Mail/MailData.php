<?php

namespace App\Mail;

class MailData
{
    static protected $sender = 'erp@rbs.lk';

    static protected $recievers = [
        /*'shan@ceyhinzlink.com',

        'lal@riococo.com',

        'namal@riococo.com',

        'nuwan@riococo.com',

        'senesh@riococo.com',

        'info@newlifelk.com',

        'qad@riococo.com',

        'shipping@riococo.com',

        'Export@riococo.com',

        'Ana@ceyhinzlink.com',

        'edward@ceyhinzlink.com',

        'esmeralda@ceyhinzlink.com',

        'jennyc@ceyhinzlink.com',*/

        'sampathperera04@gmail.com',

      
    ];
    public static function getSender()
    {
        return MailData::$sender;
    }
    public static function getRecievers()
    {
        return MailData::$recievers;
    }
}
