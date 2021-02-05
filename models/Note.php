<?php
class Note {
    public $id;
    public $title;
    public $txt;
    public $id_mark;
    public $created_at;
    public $cor;
    public $status_trash;
} 
interface NoteDAO {
    public function getNoteAll($offset, $limit);
    public function addNote(Note $n);
    public function updateNote(Note $n);
    public function deleteAllByIdMark($id_mark);
    public function modoOnTrash($id);
    public function modoOffTrash($id);
    public function modoDelTrash($id);
    public function getNoteAllByMark($title_mark);
}