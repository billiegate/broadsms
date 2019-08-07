<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class SMSClient extends Model
{
    protected $fillable = ['sender', 'message', 'recipient'];

    /**
     * @param SMS_USERNAME the username of the sms service
     */
    protected $username;

    /**
     * @param SMS_PASSPHRASE the password of the sms service
     */
    protected $password;

    /**
     * @param SMS_BASE_URL the base url of the sms service api
     */
    protected $base_url;

    
    /**
     * Initialize sms api credientials
     */
    public function __contruct() {
        $this->username = config('sms.username');
        $this->password = config('sms.password');
        $this->base_url = config('sms.base_url');
    }

    /**
     * @method gets charges on sending an sms
     * @param string $number
     * @return float 
     */
    public function charge($number) {

        foreach(file('numbers.txt') as $line) {
            $num_price = explode('=', $line);
        }
    }

    function getPrefix($number) {
        $pre = substr($number, 0, 3);
        if($pre == '234') {

        }
    }

    /**
     * @method gets the balance of the user
     * @return JSON 
     */
    public function balance() {
        $uri = 'balance?username=' . $this->username . '&password=' . $this->password;
        return $this->queryUrl( $url );
    }

    /**
     * @method gets the balance of the user
     * @param string $sender - the senderID
     * @param integer $recipient - number recieving the message
     * @param string $message - message content
     * @return JSON 
     */
    public function send($sender, $recipient, $message) {
        $uri = 'sendsms?username=' . $this->username . '&password=' . $this->password . '&sender=@@' . $sender . '@@&recipient=@@' . $recipient . '@@&message=@@' . $message . '@@';
        return $this->queryUrl( $uri );
    }

    /**
     * @method queries the endpoint
     * @param string $uri 
     */
    public function queryUrl( $uri ) {
        // $client = new Client();
        // $request = $client->get($this->base_url . $uri);
        // $response = $request->getBody()->getContents();
        $response = file_get_contents($this->base_url . $uri);
        return $response;
    }
}