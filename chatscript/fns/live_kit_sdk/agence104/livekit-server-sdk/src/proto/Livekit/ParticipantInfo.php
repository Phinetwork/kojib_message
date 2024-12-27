<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_models.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.ParticipantInfo</code>
 */
class ParticipantInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string sid = 1;</code>
     */
    protected $sid = '';
    /**
     * Generated from protobuf field <code>string identity = 2;</code>
     */
    protected $identity = '';
    /**
     * Generated from protobuf field <code>.livekit.ParticipantInfo.State state = 3;</code>
     */
    protected $state = 0;
    /**
     * Generated from protobuf field <code>repeated .livekit.TrackInfo tracks = 4;</code>
     */
    private $tracks;
    /**
     * Generated from protobuf field <code>string metadata = 5;</code>
     */
    protected $metadata = '';
    /**
     * timestamp when participant joined room, in seconds
     *
     * Generated from protobuf field <code>int64 joined_at = 6;</code>
     */
    protected $joined_at = 0;
    /**
     * Generated from protobuf field <code>string name = 9;</code>
     */
    protected $name = '';
    /**
     * Generated from protobuf field <code>uint32 version = 10;</code>
     */
    protected $version = 0;
    /**
     * Generated from protobuf field <code>.livekit.ParticipantPermission permission = 11;</code>
     */
    protected $permission = null;
    /**
     * Generated from protobuf field <code>string region = 12;</code>
     */
    protected $region = '';
    /**
     * indicates the participant has an active publisher connection
     * and can publish to the server
     *
     * Generated from protobuf field <code>bool is_publisher = 13;</code>
     */
    protected $is_publisher = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $sid
     *     @type string $identity
     *     @type int $state
     *     @type \Livekit\TrackInfo[]|\Google\Protobuf\Internal\RepeatedField $tracks
     *     @type string $metadata
     *     @type int|string $joined_at
     *           timestamp when participant joined room, in seconds
     *     @type string $name
     *     @type int $version
     *     @type \Livekit\ParticipantPermission $permission
     *     @type string $region
     *     @type bool $is_publisher
     *           indicates the participant has an active publisher connection
     *           and can publish to the server
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitModels::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string sid = 1;</code>
     * @return string
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * Generated from protobuf field <code>string sid = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setSid($var)
    {
        GPBUtil::checkString($var, True);
        $this->sid = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string identity = 2;</code>
     * @return string
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * Generated from protobuf field <code>string identity = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setIdentity($var)
    {
        GPBUtil::checkString($var, True);
        $this->identity = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.ParticipantInfo.State state = 3;</code>
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Generated from protobuf field <code>.livekit.ParticipantInfo.State state = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setState($var)
    {
        GPBUtil::checkEnum($var, \Livekit\ParticipantInfo\State::class);
        $this->state = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .livekit.TrackInfo tracks = 4;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    /**
     * Generated from protobuf field <code>repeated .livekit.TrackInfo tracks = 4;</code>
     * @param \Livekit\TrackInfo[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTracks($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Livekit\TrackInfo::class);
        $this->tracks = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string metadata = 5;</code>
     * @return string
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * Generated from protobuf field <code>string metadata = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setMetadata($var)
    {
        GPBUtil::checkString($var, True);
        $this->metadata = $var;

        return $this;
    }

    /**
     * timestamp when participant joined room, in seconds
     *
     * Generated from protobuf field <code>int64 joined_at = 6;</code>
     * @return int|string
     */
    public function getJoinedAt()
    {
        return $this->joined_at;
    }

    /**
     * timestamp when participant joined room, in seconds
     *
     * Generated from protobuf field <code>int64 joined_at = 6;</code>
     * @param int|string $var
     * @return $this
     */
    public function setJoinedAt($var)
    {
        GPBUtil::checkInt64($var);
        $this->joined_at = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string name = 9;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Generated from protobuf field <code>string name = 9;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 version = 10;</code>
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Generated from protobuf field <code>uint32 version = 10;</code>
     * @param int $var
     * @return $this
     */
    public function setVersion($var)
    {
        GPBUtil::checkUint32($var);
        $this->version = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.ParticipantPermission permission = 11;</code>
     * @return \Livekit\ParticipantPermission|null
     */
    public function getPermission()
    {
        return $this->permission;
    }

    public function hasPermission()
    {
        return isset($this->permission);
    }

    public function clearPermission()
    {
        unset($this->permission);
    }

    /**
     * Generated from protobuf field <code>.livekit.ParticipantPermission permission = 11;</code>
     * @param \Livekit\ParticipantPermission $var
     * @return $this
     */
    public function setPermission($var)
    {
        GPBUtil::checkMessage($var, \Livekit\ParticipantPermission::class);
        $this->permission = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string region = 12;</code>
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Generated from protobuf field <code>string region = 12;</code>
     * @param string $var
     * @return $this
     */
    public function setRegion($var)
    {
        GPBUtil::checkString($var, True);
        $this->region = $var;

        return $this;
    }

    /**
     * indicates the participant has an active publisher connection
     * and can publish to the server
     *
     * Generated from protobuf field <code>bool is_publisher = 13;</code>
     * @return bool
     */
    public function getIsPublisher()
    {
        return $this->is_publisher;
    }

    /**
     * indicates the participant has an active publisher connection
     * and can publish to the server
     *
     * Generated from protobuf field <code>bool is_publisher = 13;</code>
     * @param bool $var
     * @return $this
     */
    public function setIsPublisher($var)
    {
        GPBUtil::checkBool($var);
        $this->is_publisher = $var;

        return $this;
    }

}

