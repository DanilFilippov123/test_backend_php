<?php

class GroupRepository {
    private mysqli $db;
    public function __construct($db_url, $db_user, $db_password, $db_name)
    {
        $this->db = new mysqli($db_url, $db_user, $db_password, $db_name);
    }

    public function find_by_id(int $id): ?Group {
        $rows = $this->db->query("SELECT * FROM `groups` WHERE id = $id");
        if ($rows->num_rows != 1) {
            return null;
        }
        $row = $rows->fetch_assoc();
        if (!is_array($row)) {
            throw new mysqli_sql_exception();
        }

        return new Group($row["id"], $row["id_parent"], $row["name"]);
    }

    public function get_children_by_id(int $id): array
    {
        $rows = $this->db->query("SELECT * FROM `groups` WHERE id_parent = $id");
        if ($rows->num_rows == 0) {
            return [];
        }
        $res = [];
        foreach ($rows as $row) {
            $res[] = new Group($row["id"], $row["id_parent"], $row["name"]);
        }
        return $res;
    }
}

