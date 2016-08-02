<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\ListResource;
use Twilio\Values;
use Twilio\Version;

class ApplicationList extends ListResource {
    /**
     * Construct the ApplicationList
     * 
     * @param Version $version Version that contains the resource
     * @param string $accountSid A string that uniquely identifies this resource
     * @return \Twilio\Rest\Api\V2010\Account\ApplicationList 
     */
    public function __construct(Version $version, $accountSid) {
        parent::__construct($version);
        
        // Path Solution
        $this->solution = array(
            'accountSid' => $accountSid,
        );
        
        $this->uri = '/Accounts/' . $accountSid . '/Applications.json';
    }

    /**
     * Create a new ApplicationInstance
     * 
     * @param string $friendlyName Human readable description of this resource
     * @param array $options Optional Arguments
     * @return ApplicationInstance Newly created ApplicationInstance
     */
    public function create($friendlyName, array $options = array()) {
        $options = new Values($options);
        
        $data = Values::of(array(
            'FriendlyName' => $friendlyName,
            'ApiVersion' => $options['apiVersion'],
            'VoiceUrl' => $options['voiceUrl'],
            'VoiceMethod' => $options['voiceMethod'],
            'VoiceFallbackUrl' => $options['voiceFallbackUrl'],
            'VoiceFallbackMethod' => $options['voiceFallbackMethod'],
            'StatusCallback' => $options['statusCallback'],
            'StatusCallbackMethod' => $options['statusCallbackMethod'],
            'VoiceCallerIdLookup' => $options['voiceCallerIdLookup'],
            'SmsUrl' => $options['smsUrl'],
            'SmsMethod' => $options['smsMethod'],
            'SmsFallbackUrl' => $options['smsFallbackUrl'],
            'SmsFallbackMethod' => $options['smsFallbackMethod'],
            'SmsStatusCallback' => $options['smsStatusCallback'],
            'MessageStatusCallback' => $options['messageStatusCallback'],
        ));
        
        $payload = $this->version->create(
            'POST',
            $this->uri,
            array(),
            $data
        );
        
        return new ApplicationInstance(
            $this->version,
            $payload,
            $this->solution['accountSid']
        );
    }

    /**
     * Streams ApplicationInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     * 
     * @param array $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use
     *                        the default value of 50 records.  If no page_size is
     *                        defined
     *                        but a limit is defined, stream() will attempt to read
     *                        the limit
     *                        with the most efficient page size, i.e. min(limit,
     *                        1000)
     * @return \Twilio\Stream stream of results
     */
    public function stream(array $options = array(), $limit = null, $pageSize = null) {
        $limits = $this->version->readLimits($limit, $pageSize);
        
        $page = $this->page($options, $limits['pageSize']);
        
        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads ApplicationInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     * 
     * @param array $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use
     *                        the default value of 50 records.  If no page_size is
     *                        defined
     *                        but a limit is defined, read() will attempt to read
     *                        the
     *                        limit with the most efficient page size, i.e.
     *                        min(limit, 1000)
     * @return ApplicationInstance[] Array of results
     */
    public function read(array $options = array(), $limit = null, $pageSize = Values::NONE) {
        return iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of ApplicationInstance records from the API.
     * Request is executed immediately
     * 
     * @param array $options Optional Arguments
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return \Twilio\Page Page of ApplicationInstance
     */
    public function page(array $options = array(), $pageSize = Values::NONE, $pageToken = Values::NONE, $pageNumber = Values::NONE) {
        $options = new Values($options);
        $params = Values::of(array(
            'FriendlyName' => $options['friendlyName'],
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ));
        
        $response = $this->version->page(
            'GET',
            $this->uri,
            $params
        );
        
        return new ApplicationPage($this->version, $response, $this->solution);
    }

    /**
     * Constructs a ApplicationContext
     * 
     * @param string $sid Fetch by unique Application Sid
     * @return \Twilio\Rest\Api\V2010\Account\ApplicationContext 
     */
    public function getContext($sid) {
        return new ApplicationContext(
            $this->version,
            $this->solution['accountSid'],
            $sid
        );
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Api.V2010.ApplicationList]';
    }
}