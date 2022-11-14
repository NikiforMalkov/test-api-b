<?php

namespace App\Jobs;

use App\Elastic\Services\ElasticService;
use App\Models\Item;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Item $item;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ElasticService $elasticService)
    {
        try {
            $elasticService->createIndex('item_index', [
                'number_of_shards' => 1,
                'number_of_replicas' => 0
            ]);
        } catch (\Exception $e) {

        }

        $elasticService->updateMappingSettings('item_index', [
            'name' => [
                'type' => 'keyword',
            ],
            'description' => [
                'type' => 'text',
                'analyzer' => 'standard'
            ],
            'category_id' => [
                'type' => 'integer'
            ]
        ]);

        $elasticService->addToIndex('item_index', $this->item->id, [
            'name' => $this->item->name,
            'description' => $this->item->description,
            'category_id' => $this->item->category_id,
        ]);
    }
}
