<?php

namespace IUGOsds\SherLaravel;

class SherLaravel
{
    public $status;

    /**
     * Identify an account
     * @param string $group_id
     * @param array $traits
     * @param int $timestamp
     *
     * @return boolean
     */
    public function identifyAccount(String $group_id, ?Array $traits= [], ?int $timestamp = null)
    {
        $params = [
            'group_id' => $group_id,
            'traits' => $traits,
            'timestamp' => $timestamp ?? \Carbon\Carbon::now()->getPreciseTimestamp(3)
        ];
        if (config('sherlaravel.enabled')) {
            if (config('sherlaravel.async_calls')) {
                dispatch(function () use ($params) {
                    return $this->sherlockAPI('groups', $params);
                });
                return (object)['status' => 'Sherlock Score call is being sent in the background.'];
            } else {
                return $this->sherlockAPI('groups', $params);
            }
        } else {
            return (object)['status' => 'Sherlock Score tracking is disabled by config.'];
        }
    }

    /**
     * Identify a user
     * @param string $user_id
     * @param string $group_id
     * @param array $traits
     * @param int $timestamp
     *
     * @return boolean
     */
    public function identifyUser(String $user_id, ?String $group_id = null, ?Array $traits= [], ?int $timestamp = null)
    {
        $params = [
            'user_id' => $user_id,
            'group_id' => $group_id,
            'traits' => $traits,
            'timestamp' => $timestamp ?? \Carbon\Carbon::now()->getPreciseTimestamp(3)
        ];
        if (config('sherlaravel.enabled')) {
            if (config('sherlaravel.async_calls')) {
                dispatch(function () use ($params) {
                    $this->sherlockAPI('users', $params);
                });
                return (object)['status' => 'Sherlock Score call is being sent in the background.'];
            } else {
                return $this->sherlockAPI('users', $params);
            }
        } else {
            return (object)['status' => 'Sherlock Score tracking is disabled by config.'];
        }
    }

    /**
     * Identify a user
     * @param string $user_id
     * @param string $event
     * @param int $timestamp
     *
     * @return boolean
     */
    public function trackEvent(String $user_id, String $event, ?int $timestamp = null)
    {
        $params = [
            'user_id' => $user_id,
            'event' => $event,
            'timestamp' => $timestamp ?? \Carbon\Carbon::now()->getPreciseTimestamp(3)
        ];
        if (config('sherlaravel.enabled')) {
            if (config('sherlaravel.async_calls')) {
                dispatch(function () use ($params) {
                    return $this->sherlockAPI('events', $params);
                });
                return (object)['status' => 'Sherlock Score call is being sent in the background.'];
            } else {
                return $this->sherlockAPI('events', $params);
            }
        } else {
            return (object)['status' => 'Sherlock Score tracking is disabled by config.'];
        }
    }

    /**
     * Curl to Sherlock API endpoints
     *
     * @param null $api_method
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    public function sherlockAPI(String $api_method, Array $params = array())
    {
        if (config('sherlaravel.apiKey') === null) {
            throw new \Exception("Missing Sherlock Score api key, add SHERLOCK_SCORE_API_KEY to your .env file");
        }

        $params = array_merge(['api_key' => config('sherlaravel.apiKey')], $params);
        $params = json_encode($params);
        $url = config('sherlaravel.apiUrl') . "/$api_method";

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_ENCODING => 'gzip,deflate',
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT => config('sherlaravel.waitTimeout'),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($params)
            ],
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $params
        );

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $curl_resp = curl_exec($curl);
        if($curl_resp === false) {
            throw new \Exception('Curl error: ' . curl_error($curl));
        } else if(curl_getinfo($curl, CURLINFO_HTTP_CODE) != 202) {
            $response = json_decode($curl_resp);
            throw new \Exception('Curl error: ' . $response->message);
        } else {
            $response = json_decode($curl_resp);
            $this->status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            return (object)['status' => 'OK'];
        }

    }

}