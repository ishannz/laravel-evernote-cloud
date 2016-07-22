<?php
namespace Ishannz\LaravelEvernote;


class Evernote
{
    /** @var  string */
    protected $token;

    /** @var  boolean */
    protected $sandbox;

    /** @var  boolean */
    protected $china;

    /** @var  string */
    protected $key;

    /** @var  string */
    protected $secret;

    /** @var  string */
    protected $callback;

    /**
     * @param string|null $token
     */
    public function __construct($token = null)
    {
        $this->token = $token;
        $this->sandbox = (env('LE_SANDBOX')) ? env('LE_SANDBOX') : true;
        $this->china = (env('LE_CHINA')) ? env('LE_CHINA') : false;
        $this->key = (env('LE_KEY')) ? env('LE_KEY') : '';
        $this->secret = (env('LE_SECRET')) ? env('LE_SECRET') : '';
        $this->callback = (env('LE_CALL_BACK')) ? env('LE_CALL_BACK') : true;
    }

    public function authorize()
    {
        $oauth_handler = new \Evernote\Auth\OauthHandler($this->sandbox, false, $this->china);
        try {
            $oauth_data = $oauth_handler->authorize($this->key, $this->secret, $this->getCallbackUrl());
            $this->token = $oauth_data['oauth_token'];
            $ret = $this->token;

        } catch (\Evernote\Exception\AuthorizationDeniedException $e) {
            //If the user decline the authorization, an exception is thrown.
            $ret = null;
        }

        return $ret;
    }

    public function getCallbackUrl()
    {
        $thisUrl = (empty($_SERVER['HTTPS'])) ? "http://" : "https://";
        $thisUrl .= $_SERVER['SERVER_NAME'];
        $thisUrl .= ($_SERVER['SERVER_PORT'] == 80 || $_SERVER['SERVER_PORT'] == 443) ? "" : (":" . $_SERVER['SERVER_PORT']);
        $thisUrl .= $_SERVER['SCRIPT_NAME'];
        $thisUrl .= $this->callback;
        return $thisUrl;
    }

}