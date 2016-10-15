<?php
namespace Ishannz\LaravelEvernote;
use Illuminate\Http\Request;


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
        $this->sandbox = (env('EVERNOTE_SANDBOX')) ? env('EVERNOTE_SANDBOX') : true;
        $this->china = (env('EVERNOTE_CHINA')) ? env('EVERNOTE_CHINA') : false;
        $this->key = (env('EVERNOTE_KEY')) ? env('EVERNOTE_KEY') : '';
        $this->secret = (env('EVERNOTE_SECRET')) ? env('EVERNOTE_SECRET') : '';
        $this->callback = (env('EVERNOTE_CALL_BACK')) ? env('EVERNOTE_CALL_BACK') : true;
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
        $request =  new Request();
        $thisUrl = (empty($request->server('HTTPS'))) ? "http://" : "https://";
        $thisUrl .= $request->server('SERVER_NAME');
        $thisUrl .= ($request->server('SERVER_PORT') == 80 || $request->server('SERVER_PORT') == 443) ? "" : (":" . $request->server('SERVER_PORT'));
        $thisUrl .= $request->server('SCRIPT_NAME');
        $thisUrl .= $this->callback;
        return $thisUrl;
    }

    public function notebookList($token)
    {
        $client = new \Evernote\Client($token, $this->sandbox, null, null, $this->china);

        $notebooks = array();

        $notebooks = $client->listNotebooks();
        return $notebooks;
    }

}