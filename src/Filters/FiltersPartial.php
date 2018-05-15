<?php

namespace Spatie\QueryBuilder\Filters;

use Illuminate\Database\Eloquent\Builder;

class FiltersPartial implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        if (is_array($value)) {
            return $query->where(function (Builder $query) use ($value, $property) {
                foreach ($value as $partialValue) {
                    $query->orWhere($property, 'ILIKE', "%{$partialValue}%");
                }
            });
        }

        return $query->where($property, 'ILIKE', "%{$value}%");
    }
}
