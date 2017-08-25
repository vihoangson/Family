<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class JwtLib {

    protected $ci;

    public function __construct() {
        $this->ci =& get_instance();
    }

    public function getJwt() {
        $return = [];
        $key    = "352352345623463246trswrgsdfgsdfgsdfgsert";

        $token = [
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => time(),
            "nbf" => time() - 4123123
        ];

        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        $jwt = JWT::encode($token, $key);

        $return[] = ($jwt);

        $decoded = JWT::decode($jwt, $key, ['HS256']);

        $return[] = ($decoded);

        /*
         NOTE: This will now be an object instead of an associative array. To get
         an associative array, you will need to cast it as such:
        */
        $decoded_array = (array) $decoded;
        $return[]      = ($decoded_array);
        /**
         * You can add a leeway to account for when there is a clock skew times between
         * the signing and verifying servers. It is recommended that this leeway should
         * not be bigger than a few minutes.
         *
         * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
         */
        JWT::$leeway = 60; // $leeway in seconds
        $decoded     = JWT::decode($jwt, $key, ['HS256']);

        $return[] = ($decoded);

        return $return;
    }

}

