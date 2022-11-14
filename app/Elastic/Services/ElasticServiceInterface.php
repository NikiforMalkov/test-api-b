<?php

namespace App\Elastic\Services;

interface ElasticServiceInterface {

    public function search(string $indexName, $query = null, $sort = null);

    public function addToIndex(string $indexName, string $id, array $data);

    public function deleteIndexByName(string $name);

    public function createIndex(string $name, array $config);

    public function updateMappingSettings(string $indexName, array $properties);
}
