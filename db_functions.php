<?php

include_once 'config.php';

function db_connect()
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA);
    if ($conn === false) {
        die('Błąd połączenia z bazą danych!');
    }

    return $conn;
}

function db_disconnect($connection)
{
    mysqli_close($connection);
}

function db_insert($connection, $sql)
{
    if (strpos(strtolower($sql), 'insert') === false) {
        throw new RuntimeException('Not an insert query');
    }

    mysqli_query($connection, $sql);
}

function db_update($connection, $sql)
{
    if (strpos(strtolower($sql), 'update') === false) {
        throw new RuntimeException('Not an update query');
    }

    mysqli_query($connection, $sql);
}

function db_delete($connection, $sql)
{
    if (strpos(strtolower($sql), 'delete') === false) {
        throw new RuntimeException('Not an delete query');
    }

    mysqli_query($connection, $sql);
}

function db_fetch_single($connection, $sql)
{
    $query = mysqli_query($connection, $sql);

    return mysqli_fetch_array($query);
}

function db_fetch_all($connection, $sql)
{
    $query = mysqli_query($connection, $sql);

    $results = [];
    while(($record = mysqli_fetch_array($query)) !== null) {
        $results[] = $record;
    }

    return $results;
}
