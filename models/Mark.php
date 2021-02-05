<?php
class Mark {
    public $id;
    public $title;
    public $cor;
} 
interface MarkDAO {
    public function getTitle($id);
    public function addMark(Mark $m);
    public function delMark($id);
    public function existsMark($id);
}