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
        $this->token    = $token;
        $this->sandbox  = config('evernote.sandbox');
        $this->china    = config('evernote.china');
        $this->key      = config('evernote.key');
        $this->secret   = config('evernote.secret');
        $this->callback = config('evernote.callback');
    }

    /**
     * @return string|null
     */
    public function authorize()
    {
        $oauth_handler = new \Evernote\Auth\OauthHandler($this->sandbox, false, $this->china);
        try {
            $oauth_data  = $oauth_handler->authorize($this->key, $this->secret, $this->getCallbackUrl());

            if (isset($oauth_data['oauth_token'])) {
                $this->token = $oauth_data['oauth_token'];
                $ret         = $this->token;
            } else {
                $ret = null;
            }
        } catch (\Evernote\Exception\AuthorizationDeniedException $e) {
            //If the user decline the authorization, an exception is thrown.
            $ret = null;
        } catch (\Exception $e) {
            $ret = null;
        }

        return $ret;
    }

    /**
     * @return string
     */
    public function getCallbackUrl()
    {
        return url($this->callback);
    }

    /**
     * @param string $token
     *
     * @return array
     */
    public function notebookList($token)
    {
        $client = new \Evernote\Client($token, $this->sandbox, null, null, $this->china);

        $notebooks = $client->listNotebooks();

        return $notebooks;
    }
}
