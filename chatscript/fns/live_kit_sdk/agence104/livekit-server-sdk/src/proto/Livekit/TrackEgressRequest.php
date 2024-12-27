<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_egress.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * record tracks individually, without transcoding
 *
 * Generated from protobuf message <code>livekit.TrackEgressRequest</code>
 */
class TrackEgressRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * required
     *
     * Generated from protobuf field <code>string room_name = 1;</code>
     */
    protected $room_name = '';
    /**
     * required
     *
     * Generated from protobuf field <code>string track_id = 2;</code>
     */
    protected $track_id = '';
    protected $output;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $room_name
     *           required
     *     @type string $track_id
     *           required
     *     @type \Livekit\DirectFileOutput $file
     *     @type string $websocket_url
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitEgress::initOnce();
        parent::__construct($data);
    }

    /**
     * required
     *
     * Generated from protobuf field <code>string room_name = 1;</code>
     * @return string
     */
    public function getRoomName()
    {
        return $this->room_name;
    }

    /**
     * required
     *
     * Generated from protobuf field <code>string room_name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setRoomName($var)
    {
        GPBUtil::checkString($var, True);
        $this->room_name = $var;

        return $this;
    }

    /**
     * required
     *
     * Generated from protobuf field <code>string track_id = 2;</code>
     * @return string
     */
    public function getTrackId()
    {
        return $this->track_id;
    }

    /**
     * required
     *
     * Generated from protobuf field <code>string track_id = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setTrackId($var)
    {
        GPBUtil::checkString($var, True);
        $this->track_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.DirectFileOutput file = 3;</code>
     * @return \Livekit\DirectFileOutput|null
     */
    public function getFile()
    {
        return $this->readOneof(3);
    }

    public function hasFile()
    {
        return $this->hasOneof(3);
    }

    /**
     * Generated from protobuf field <code>.livekit.DirectFileOutput file = 3;</code>
     * @param \Livekit\DirectFileOutput $var
     * @return $this
     */
    public function setFile($var)
    {
        GPBUtil::checkMessage($var, \Livekit\DirectFileOutput::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>string websocket_url = 4;</code>
     * @return string
     */
    public function getWebsocketUrl()
    {
        return $this->readOneof(4);
    }

    public function hasWebsocketUrl()
    {
        return $this->hasOneof(4);
    }

    /**
     * Generated from protobuf field <code>string websocket_url = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setWebsocketUrl($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getOutput()
    {
        return $this->whichOneof("output");
    }

}

