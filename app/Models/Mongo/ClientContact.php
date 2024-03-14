<?php

namespace App\Models\Mongo;

use MongoDB\Laravel\Eloquent\Model;

class ClientContact extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'clientContact';

    protected $fillable = [
        "_id",
        "Format",
        "Client_Name",
        "ContactName",
        "Email",
        "ClientId",
        "contactid",
        "deliverytime",
        "deliverytime_web_automated",
        "deliverytime_Print_automated",
        "enableforqlikview",
        "wm_enableforprint",
        "wm_enableforweb",
        "dashboard",
        "enableforbr",
        "enableforwhatsapp",
        "whatsappnumber",
        "enableformediatouch",
        "enablefordidyounotice",
        "client_status",
        "wm_client_status"
    ];
}
