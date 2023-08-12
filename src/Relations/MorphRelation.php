<?php

namespace Lomkit\Rest\Relations;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Lomkit\Rest\Contracts\RelationResource;
use Lomkit\Rest\Concerns\Makeable;

class MorphRelation extends Relation
{
    use Makeable;
}