<?php
function db_select($conn, $table, $conditions = array(), $order_by = false, $like = false)
{
    if (is_array($conditions) && $table) {
        $where = array();
        if ($like) {
            $comparitor = " LIKE ";
        } else {
            $comparitor = "=";
        }
        foreach ($conditions as $field => $value) {
            $where[] = $conn->real_escape_string($field) . $comparitor . "'" . $conn->real_escape_string($value) . "'";
        }
        $query = "SELECT * FROM " . $conn->real_escape_string($table);
        if (count($where) > 0) {
            $query .= " WHERE " . join(' AND ', $where);
        }
        if (!is_array($order_by)) {
            $order_by = array(
                'Name' => 'asc'
            );
        }
        if (is_array($order_by)) {
            if (count($order_by) > 0) {
                $order = array();
                foreach ($order_by as $field => $direction) {
                    $order[] = $field . " " . $direction;
                }
                $query .= " ORDER BY " . join(', ', $order);
            }
        }

        return $conn->query($query);
    }
}

function db_fetch($conn, $table, $conditions = array(), $order_by = false, $like = false)
{
    $result_array = array();
    $result = db_select($conn, $table, $conditions, $order_by, $like);
    while ($row = $result->fetch_array()) {
        $result_array[] = $row;
    }

    return $result_array;
}

function db_fetch_row($conn, $table, $name, $order_by = false)
{
    $conditions = array(
        'Name' => $name
    );

    $result = db_select($conn, $table, $conditions, $order_by);

    if ($result === false) {
        die($conn->error);
    }

    return $result->fetch_assoc();
}

function db_fetch_row_con($conn, $table, $conditions, $order_by = false)
{
    $result = db_select($conn, $table, $conditions, $order_by);

    if ($result === false) {
        die($conn->error);
    }

    return $result->fetch_assoc();
}

function db_delete_row($conn, $table, $field, $id)
{
    $query = "DELETE FROM " . $conn->real_escape_string($table) . " WHERE " . $conn->real_escape_string($field) . "=" . $conn->real_escape_string($id);
    return $conn->query($query);
}


function db_insert($conn, $table, $data, $check_if_exists = false)
{
    if (is_array($data) && $table) {
        $row = db_fetch_row($conn, $table, $data['Name']);
        $fields = array();
        $values = array();

        foreach ($data as $field => $value) {
            $fields[] = $conn->real_escape_string($field);
            $values[] = "'" . $conn->real_escape_string($value) . "'";
        }

        $query = "INSERT INTO " . $conn->real_escape_string($table) . " (" . join(', ', $fields) . ") VALUES(" . join(', ', $values) . ");";
        $conn->query($query);
        if (!$conn->query($query)) {
            die($conn->error);
        }

        return $conn->insert_id;
    }
}

function db_update($conn, $table, $conditions, $data)
{
    if (is_array($conditions) && $table) {
        $where = array();
        $set = array();

        foreach ($data as $field => $value) {
            $fields[] = $conn->real_escape_string($field);
            $values[] = "'" . $conn->real_escape_string($value) . "'";
        }
        foreach ($data as $field => $value) {
            $set[] = $conn->real_escape_string($field) . "='" . $conn->real_escape_string($value) . "'";
        }
        foreach ($conditions as $field => $value) {
            $where[] = $conn->real_escape_string($field) . "='" . $conn->real_escape_string($value) . "'";
        }
        $query = "UPDATE " . $conn->real_escape_string($table) . " SET " . join(', ', $set) . " WHERE " . join(' AND ', $where);
        return $conn->query($query);
    }
}
?>