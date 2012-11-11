<?php
class CGallery extends CWidget
{
    public $path;
    public $activePage = 1;
    public $files = array();
    public $edit = false;
    public $model;


    public function init() {
    }

    public function run() {

        if (!$this->edit) {
            $this->render('CGallery');
        } else {
            $this->render('CGalleryEditable');
        }
    }
}