<?php

namespace App\Elastic\Services;

use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\ClientInterface;

//TODO: добавить обработку ошибок
class ElasticService implements ElasticServiceInterface {

    public ClientInterface $client;

    public function __construct()
    {
        //TODO: вынести в конфиг
        $hosts = [
            'http://elasticsearch:'.env('ES_PORT')
        ];
        $this->client = ClientBuilder::create()
            ->setHosts($hosts)
            ->build();

    }

    public function search(string $indexName, $query = null, $sort = null) {
        $body = [];
        if ($query != null) {
            $body['query'] = $query;
        }
        if ($sort != null) {
            $body['sort'] = $sort;
        }
        $params = [
            'index' => $indexName,
            'body'  => $body
        ];

        $response = $this->client->search($params);
        return  $response->asArray();
    }

    public function addToIndex(string $indexName, string $id, array $data) {
        $params = [
            'index' => $indexName,
            'id'    => $id,
            'body'  => $data
        ];

        $this->client->index($params);
    }

    public function deleteIndexByName(string $name) {
        $deleteParams = [
            'index' => $name
        ];
        $result = $this->client->indices()->delete($deleteParams);
        return $result;
    }

    public function createIndex(string $name, array $config) {
        $params = [
            'index' => $name,
            'body' => [
                'settings' => $config
                /*
                [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 0
                ]
                */
            ]
        ];

        $result = $this->client->indices()->create($params);
        return $result;
    }

    public function updateMappingSettings(string $indexName, array $properties) {
        $params = [
            'index' => $indexName,
            'body' => [
                '_source' => [
                    'enabled' => true
                ],
                'properties' => $properties
            ]
        ];

        $this->client->indices()->putMapping($params);
    }

}
