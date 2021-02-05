<?php 
require_once "models/Mark.php";
require_once "dao/NoteDaoMysql.php";

class MarkDaoMysql implements MarkDAO {

    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function getMarkAll() {
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM marks");
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($data as $item) {
                $m  = new Mark();
                $m->id    = $item['id'];
                $m->title = $item['title'];
                $m->cor   = $item['cor'];

                $array[] = $m;
            }
        }

        return $array;
    }

    public function getTitle($id) {
        $sql = $this->pdo->prepare("SELECT title FROM marks WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            
            return $data['title'];
        }
    }

    public function addMark(Mark $m) {

        $sql = $this->pdo->prepare("INSERT INTO marks (title) 
        VALUES (:title)");
        $sql->bindValue(':title', $m->title);
        $sql->execute();

    }

    public function delMark($id) {
        $noteDao = new NoteDaoMysql($this->pdo);

        $sql = $this->pdo->prepare("DELETE FROM marks WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $noteDao->deleteAllByIdMark($id);

    }

    public function existsMark($id) {
        $sql = $this->pdo->prepare('SELECT * FROM marks WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0)  {
            return true;
        } else {
            return false;
        }

    } 

}