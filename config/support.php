<?php

return [

    /*
    | WhatsApp number for wa.me links (digits only, country code included, no +).
    | Example Nepal: 97798xxxxxxxx
    */
    'whatsapp_digits' => env('SUPPORT_WHATSAPP_DIGITS', '9779765726294'),

    /*
    | Optional Facebook Messenger / m.me link for the dashboard contact hub.
    */
    'messenger_url' => env('SUPPORT_MESSENGER_URL'),

];
