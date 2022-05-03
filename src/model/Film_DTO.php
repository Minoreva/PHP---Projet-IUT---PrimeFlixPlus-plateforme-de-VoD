<?php

class Film_DTO {
    private $id;
    private $workname;
    private $realisator;
    private $actor;
    private $audiotrack;
    private $subtitles;
    
    function __construct($id, $workname, $realisator, $actor, $audiotrack, $subtitles) {
        $this->id = $id;
        $this->workname = $workname;
        $this->realisator = $realisator;
        $this->actor = $actor;
        $this->audiotrack = $audiotrack;
        $this->subtitles = $subtitles;
    }

        function getWorkname() {
        return $this->workname;
    }

    function getRealisator() {
        return $this->realisator;
    }

    function getActor() {
        return $this->actor;
    }

    function getAudiotrack() {
        return $this->audiotrack;
    }

    function getSubtitles() {
        return $this->subtitles;
    }

    function setWorkname($workname): void {
        $this->workname = $workname;
    }

    function setRealisator($realisator): void {
        $this->realisator = $realisator;
    }

    function setActor($actor): void {
        $this->actor = $actor;
    }

    function setAudiotrack($audiotrack): void {
        $this->audiotrack = $audiotrack;
    }

    function setSubtitles($subtitles): void {
        $this->subtitles = $subtitles;
    }


    
}