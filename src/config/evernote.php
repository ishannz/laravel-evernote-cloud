<?php

return [
    /*
     * Enable sandbox version default to true
     */
    'sandbox' => env('EVERNOTE_SANDBOX', true),

    /*
     * Evernote key
     */
    'key' => env('EVERNOTE_KEY', ''),

    /*
     * Evernote secret
     */
    'secret' => env('EVERNOTE_SECRET', ''),

    /*
     * Evernote callback url
     */
    'callback' => env('EVERNOTE_CALL_BACK', ''),

    /*
     * Is evernote use in China?
     * China use yinxiang instead of evernote.
     */
    'china' => env('EVERNOTE_CHINA', false),
];
