<?php

/*
 * Project: ODDS & ENDS
 * File: /classes/url.php
 * Purpose: class for the url object.
 * Author: Robert Dziuba & Inga Schwarze
 */
class Url
{
    private $scheme;
    private $host;
    private $port;
    private $user;
    private $pass;
    private $path;
    private $query;
    private $fragment;

    function __construct($url)
    {
        $this->scheme = parse_url($url, PHP_URL_SCHEME);
        $this->user = parse_url($url, PHP_URL_USER);
        $this->pass = parse_url($url, PHP_URL_PASS);
        $this->host = parse_url($url, PHP_URL_HOST);
        $this->port = parse_url($url, PHP_URL_PORT);
        $this->path = parse_url($url, PHP_URL_PATH);
        $this->query = parse_url($url, PHP_URL_QUERY);
        $this->fragment = parse_url($url, PHP_URL_FRAGMENT);
    }

    public function generate($url){
        return $this->scheme."://".$this->host.$url;
    }

    /**
     * @return mixed
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return mixed
     */
    public function getFragment()
    {
        return $this->fragment;
    }


}