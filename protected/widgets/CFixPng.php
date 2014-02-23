<?php
class CFixPng extends CWidget
{
    public $isIE = false;

    public function init() {
        $browser = Helpers::getBrowser();
        $this->isIE = ($browser['name'] == 'Internet Explorer');
    }

    public function run() {
        if ($this->isIE) {
            $this->render('CFixPng');
        }
    }
}