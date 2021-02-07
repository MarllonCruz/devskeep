<?php 
require_once "models/Note.php";
require_once "dao/MarkDaoMysql.php";

class NoteDaoMysql implements NoteDAO {

    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    private function _noteObject($data) {
        $array = [];
        $markDao = new MarkDaoMysql($this->pdo);

        foreach($data as $item) {
            $note = new Note();
            $note->id = $item['id'];
            $note->title = $item['title'];
            $note->txt = $item['txt'];
            $note->id_mark = $item['id_mark'];
            $note->created_at = $item['created_at'];
            $note->cor = $item['cor'];

            if(!empty($note->id_mark)) {
                $note->title_mark = $markDao->getTitle($note->id_mark);
            }

            $array[] = $note;
        }

        return $array;
    }

    public function getNoteAll($offset, $limit) {
        $array = [];

        $sql = $this->pdo->prepare("SELECT * FROM notes WHERE status_trash = :trash 
        ORDER BY id DESC
        LIMIT ".$offset.", ".$limit."");
        $sql->bindValue(':trash', 0);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            $array = $this->_noteObject($data);
        }

        return $array;
    }

    public function getNoteSearch($search, $offset, $limit) {
        $array = [];

        $sql = $this->pdo->prepare("SELECT * FROM notes 
        WHERE status_trash = :trash AND title LIKE :search 
        OR status_trash = :trash AND txt LIKE :search 
        ORDER BY id DESC LIMIT ".$offset.", ".$limit."");
        $sql->bindValue(':trash', 0);
        $sql->bindValue(':search', '%'.$search.'%');
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            $array = $this->_noteObject($data);
        }

        return $array;
    }

    public function getNoteAllByMark($id_mark) {
        $array = [];

        $sql = $this->pdo->prepare("SELECT * FROM notes 
        WHERE status_trash = :trash AND id_mark = :id_mark
        ORDER BY id DESC");
        $sql->bindValue(':trash', 0);
        $sql->bindValue(':id_mark', $id_mark);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            $array = $this->_noteObject($data);
        }

        return $array;
    }

    public function addNote(Note $n) {

        $sql = $this->pdo->prepare("INSERT INTO notes (title, txt, created_at, status_trash)
        VALUES (:title, :txt, :created_at, :trash)");
        $sql->bindValue(':title', $n->title);
        $sql->bindValue(':txt', $n->txt);
        $sql->bindValue(':created_at', $n->created_at);
        $sql->bindValue(':trash', $n->status_trash);
        $sql->execute();

    }

    public function updateNote(Note $n) {
        
        $sql = $this->pdo->prepare("UPDATE notes 
        SET title = :title , txt = :txt, id_mark = :id_mark
        WHERE id = :id");
        $sql->bindValue(':id', $n->id);
        $sql->bindValue(':title', $n->title);
        $sql->bindValue(':txt', $n->txt);
        $sql->bindValue(':id_mark', $n->id_mark);
        $sql->execute();

    }

    public function deleteAllByIdMark($id_mark) {

        $sql = $this->pdo->prepare("DELETE  FROM notes WHERE id_mark = :id_mark");
        $sql->bindValue(':id_mark', $id_mark);
        $sql->execute();

    }

    public function modoOnTrash($id) {

        $sql = $this->pdo->prepare("UPDATE notes SET status_trash = :trash
        WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':trash', 1);
        $sql->execute();

    }

    public function modoOffTrash($id) {

        $sql = $this->pdo->prepare("UPDATE notes SET status_trash = :trash
        WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':trash', 0);
        $sql->execute();

    }

    public function modoDelTrash($id) {

        $sql = $this->pdo->prepare("DELETE  FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

    }

    public function getNoteAllModoTrash() {
        $array = [];

        $sql = $this->pdo->prepare("SELECT * FROM notes WHERE status_trash = :trash 
        ORDER BY id DESC");
        $sql->bindValue(':trash', 1);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            $array = $this->_noteObject($data);
        }

        return $array;
    }

    public function getCountNotes($id_mark = null) {
        
        $sql = 'SELECT count(*) as c FROM notes WHERE status_trash = :trash';

        if($id_mark && empty($id_mark)) {
            $sql .= 'AND id_mark = :id_mark';
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(':id_mark', $id_mark);
        } else {
            $sql = $this->pdo->prepare($sql);
        }
        
        $sql->bindValue(':trash', 0);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            return $data['c'];
        }

    }

    public function getCountNotesBySearch($filter) {

        $sql = $this->pdo->prepare('SELECT count(*) as c FROM notes 
        WHERE status_trash = :trash AND title LIKE :filter 
        OR status_trash = :trash AND txt LIKE :filter');
        $sql->bindValue(':trash', 0);
        $sql->bindValue(':filter', '%'.$filter.'%');
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            return $data['c'];
        }

    }

    public function getCountNotesByMark($id_mark) {

        $sql = $this->pdo->prepare('SELECT count(*) as c FROM notes 
        WHERE status_trash = :trash AND id_mark = :id_mark');
        $sql->bindValue(':id_mark', $id_mark);
        $sql->bindValue(':trash', 0);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            return $data['c'];
        }

    }

}