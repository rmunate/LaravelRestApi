<?php

namespace Lomkit\Rest\Tests\Support\Rest\Resources;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Lomkit\Rest\Http\Requests\RestRequest;
use Lomkit\Rest\Http\Resource;
use Lomkit\Rest\Tests\Support\Models\BelongsToRelation;
use Lomkit\Rest\Tests\Support\Models\MorphManyRelation;
use Lomkit\Rest\Tests\Support\Models\MorphOneRelation;
use Lomkit\Rest\Tests\Support\Models\MorphToRelation;

class MorphManyResource extends Resource
{
    public static $model = MorphManyRelation::class;

    public function relations(RestRequest $request)
    {
        return [];
    }

    public function exposedFields(RestRequest $request)
    {
        return [
            'id',
            'number'
        ];
    }
}