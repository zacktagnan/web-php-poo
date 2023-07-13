<?php

namespace App\Models;

use DateTime;
// use Libs\Utilities;
use Database\Connection;
use Cocur\Slugify\Slugify;

class Manual
{
    private $table;
    private $connection;

    /**
     * Create a new model instance.
     * Set the table and the connection to the Database
     *
     * @return void
     */
    public function __construct()
    {
        $this->table      = 'manuals';
        $this->connection = Connection::getInstance()->getConnection();
    }

    public function insert($data)
    {
        $sql      = "INSERT INTO {$this->table} ({$this->table}.slug, {$this->table}.title, {$this->table}.excerpt, {$this->table}.description, {$this->table}.order, {$this->table}.created_at, {$this->table}.updated_at) VALUES (:slug, :title, :excerpt, :description, :order, :created_at, :updated_at)";
        $prepared = $this->connection->prepare($sql);

        $data['created_at'] = $data['created_at'] ?? new DateTime('NOW', new \DateTimeZone($_ENV['APP_TIME_ZONE']));
        $created_at         = $data['created_at']->format('Y-m-d H:i:s');
        // $updated_at         = !is_null($data['updated_at'])
        $updated_at         = isset($data['updated_at'])
                        ? $data['updated_at']->format('Y-m-d H:i:s')
                        : $created_at;
        // lo anterior da fallo porque no encuentra
        // -------------------------------------------------------------------
        // $updated_at         = !is_null($data['updated_at'])
        //                 ? $data['updated_at']->format('Y-m-d H:i:s')
        //                 : $created_at;

        // $utilities = new Utilities();
        // $slug      = $utilities->generateRandomString();
        // -------------------------------------------------------------
        $slugify = new Slugify();
        $slug    = $slugify->slugify($data['title']);

        $isOk     = $prepared->execute([
            'slug'        => $slug,
            'title'       => $data['title'],
            'excerpt'     => $data['excerpt'],
            'description' => $data['description'],
            'order'       => $data['order'],
            // 'created_at'  => $data['created_at'],
            // 'updated_at'  => $data['updated_at'] ?? $data['created_at'],
            'created_at'  => $created_at,
            'updated_at'  => $updated_at,
        ]);
        // -----------------------------------------------------------
        // // - Inspeccionando la sentencia SQL preparada
        // echo $prepared->debugDumpParams();
        // echo '<hr>';
        // // - Inspeccionando los posibles errores con MySQL
        // var_dump($prepared->errorInfo());
        // die();
        // -----------------------------------------------------------
        if ($isOk) {
            return $this->connection->lastInsertId();
        }
        return false;
    }

    /**
     * Get all the records
     *
     * @return records array
     */
    public function getAll()
    {
        $sql    = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $result = $this->connection->query($sql);
        return $result->fetchAll();
    }

    /**
     * Get a record by its slug
     *
     * @param [type] $slug
     * @return record
     */
    public function getBySlug($slug)
    {
        $sql      = "SELECT * FROM {$this->table} WHERE slug=:slug";
        $prepared = $this->connection->prepare($sql);
        $prepared->execute([
            'slug' => $slug,
        ]);
        $result = $prepared->fetchAll();
        if (count($result) === 0) {
            return null;
        }
        return $result[0];
    }

    /**
     * Get a record by its id
     *
     * @param [type] $id
     * @return record
     */
    public function getById($id)
    {
        $sql      = "SELECT * FROM {$this->table} WHERE id=:id";
        $prepared = $this->connection->prepare($sql);
        $prepared->execute([
            'id' => $id,
        ]);
        $result = $prepared->fetchAll();
        if (count($result) === 0) {
            return null;
        }
        return $result[0];
    }

    public function update($slug, $data)
    {
        $sql = "UPDATE {$this->table} SET {$this->table}.title=:title, {$this->table}.excerpt=:excerpt, {$this->table}.description=:description, {$this->table}.order=:order, {$this->table}.updated_at=:updated_at WHERE slug=:slug";

        $updated_at         = new DateTime('NOW', new \DateTimeZone($_ENV['APP_TIME_ZONE']));
        $updated_at         = $updated_at->format('Y-m-d H:i:s');

        $prepared = $this->connection->prepare($sql);
        $isOk     = $prepared->execute([
            'slug'        => $slug,
            'title'       => $data['title'],
            'excerpt'     => $data['excerpt'],
            'description' => $data['description'],
            'order'       => $data['order'],
            'updated_at'  => $updated_at,
        ]);
        // print_r($prepared->errorInfo());
        // echo '<hr>';
        // $prepared->debugDumpParams();
        if ($isOk) {
            return $this->getBySlug($slug);
        }
        return false;
    }

    /**
     * Searching query results
     *
     * @param String $query
     * @return array
     */
    public function search($query)
    {
        $sql      = "SELECT * FROM {$this->table} WHERE (title LIKE :title) OR (excerpt LIKE :excerpt) ORDER BY created_at DESC";
        $prepared = $this->connection->prepare($sql);
        $prepared->execute([
            'title'   => "%$query%",
            'excerpt' => "%$query%",
        ]);
        // Devolviendo los resultados en formato de Array gracias al FETCHALL()
        return $prepared->fetchAll();
    }

    /**
     * Searching query results for unique column
     *
     * @param string $column
     * @param string $value
     * @return array
     */
    public function searchIfExists($column, $value)
    {
        $sql      = "SELECT * FROM {$this->table} WHERE {$column} = :value";
        $prepared = $this->connection->prepare($sql);
        $prepared->execute([
            'value'   => $value,
        ]);
        // Devolviendo los resultados en formato de Array gracias al FETCHALL()
        return $prepared->fetchAll();
    }

    /**
     * Searching query results for unique column comparing on another table rows
     *
     * @param string $column
     * @param string $value
     * @return array
     */
    public function searchIfExistsForAnotherRow($column, $value, $id)
    {
        $sql      = "SELECT * FROM {$this->table} WHERE {$column} = :value AND id != :id";
        $prepared = $this->connection->prepare($sql);
        $prepared->execute([
            'value' => $value,
            'id'    => $id,
        ]);
        // Devolviendo los resultados en formato de Array gracias al FETCHALL()
        return $prepared->fetchAll();
    }

    /**
     * Delete a record by its id
     *
     * @return void
     */
    public function deleteById($id)
    {
        $sql      = "DELETE FROM {$this->table} WHERE id=:id";
        $prepared = $this->connection->prepare($sql);
        $prepared->execute([
            'id' => $id,
        ]);
        $rowsAffected = $prepared->rowCount();
        // if (count($rowsAffected) === 0) {
        if ($rowsAffected === 0) {
            return null;
        }
        return $rowsAffected;
    }

    /**
     * Delete all the records
     *
     * @return void
     */
    public function deleteAll()
    {
        $sql          = "DELETE FROM {$this->table}";
        $rowsAffected = $this->connection->exec($sql);

        return $rowsAffected;
    }
}
