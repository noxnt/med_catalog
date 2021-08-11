<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    public const ID = 'id';
    public const NAME = 'name';
    public const MAKER_ID = 'maker_id';
    public const SUBSTANCE_ID = 'substance_id';

    protected function getCallbacks(): array
    {
        return [
            self::ID => [$this, 'id'],
            self::NAME => [$this, 'name'],
            self::MAKER_ID => [$this, 'makerId'],
            self::SUBSTANCE_ID => [$this, 'substanceId'],
        ];
    }

    public function id(Builder $builder, $value)
    {
        $builder->where('id', $value);
    }

    public function name(Builder $builder, $value)
    {
        $builder->where('name', 'like', "%{$value}%");
    }

    public function makerId(Builder $builder, $value)
    {
        $builder->where('maker_id', $value);
    }

    public function substanceId(Builder $builder, $value)
    {
        $builder->where('substance_id', $value);
    }
}
