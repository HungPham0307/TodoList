<?php

namespace App\Models;

use App\Enums\WorkStatus;

class Work extends Model
{
    // get all record in DB
    public function index()
    {
        try {
            $result = $this->getAll();

            $arrList = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $row['className'] = [WorkStatus::getName($row['status'])];
                array_push($arrList, $row);
            }

            mysqli_free_result($result);

            $this->closeDB();

            return $arrList;
        } catch (\Throwable $th) {
            die($th);
        }
    }

    public function create()
    {
        $this->conn->begin_transaction();
        try {
            $title = isset($_POST['title']) ? $_POST['title'] : "";
            $start = isset($_POST['start']) ? $_POST['start'] : "";
            $end = isset($_POST['end']) ? $_POST['end'] : "";
            $status = isset($_POST['status']) ? $_POST['status'] : WorkStatus::PLANNING;

            $insert = "INSERT INTO works (title,start,end,status) VALUES ('" . $title . "','" . $start . "','" . $end . "','" . $status . "')";

            $this->conn->query($insert);

            $this->conn->commit();
            $this->closeDB();

            return true;
        } catch (\Throwable $th) {
            $this->conn->rollback();

            throw $th;
        }
    }

    public function update()
    {
        $this->conn->begin_transaction();
        try {
            $id = $_POST['id'];
            $title = isset($_POST['title']) ? $_POST['title'] : "";
            $start = isset($_POST['start']) ? $_POST['start'] : "";
            $end = isset($_POST['end']) ? $_POST['end'] : "";
            $status = isset($_POST['status']) ? $_POST['status'] : WorkStatus::PLANNING;

            $update = "UPDATE works SET title='" . $title . "',start='" . $start . "',end='" . $end . "',status='" . $status . "' WHERE id=" . $id;

            $this->conn->query($update);

            $this->conn->commit();
            $this->closeDB();

            return true;
        } catch (\Throwable $th) {
            $this->conn->rollback();

            throw $th;
        }
    }

    public function delete()
    {
        $this->conn->begin_transaction();
        try {
            $id = $_POST['id'];
            $delete = "DELETE from works WHERE id=" . $id;

            $this->conn->query($delete);

            $this->conn->commit();
            $this->closeDB();

            return true;
        } catch (\Throwable $th) {
            $this->conn->rollback();

            throw $th;
        }
    }

    public function getStatus()
    {
        try {
            $result = $this->getAll();

            $arrList = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $row['className'] = [WorkStatus::getName($row['status'])];
                array_push($arrList, $row);
            }

            mysqli_free_result($result);

            $this->closeDB();

            return $arrList;
        } catch (\Throwable $th) {
            die($th);
        }
    }

    public function getAll()
    {
        $select = 'SELECT * FROM works';

        return $this->conn->query($select);
    }
}
