<?php

class ApiInterna {

    private $key = '!EYsCiszmzwaDKr2@bGTA^s$M3kJP^anK7Vzq@Tnbj^pLBFB&H';
    private $ssl = true;
    private $domin = 'api.dutysaude.com.br';

    public function getKey() {
        return $this->key;
    }

    public function getEndPoint($path) {
        if ($this->ssl) {
            return "https://" . $this->domin . "/" .$path;
        } else {
            return "http://" . $this->domin . "/" . $path;
        }
    }
}
