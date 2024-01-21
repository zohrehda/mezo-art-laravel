<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $query)
    {
        $request = request();

        $operator = [
            'eq' => '=',
            'gt' => '>',
            'gte' => '>=',
            'lt' => '<',
            'lte' => '<=',
            'like' => 'like',
            'in' => 'in'
        ];

        foreach ($request->all() as $key => $value) {

            if(in_array($key,['sort','search']))
                continue;
            if (is_string($value))
                $query->where($key, $value);
            if (is_array($value))
                $query->whereIn($key, $value);
        }

        if ($request->filled('filters')) {
            foreach ($request->filters as $k => $v) {

                //   if (!in_array($k, $this->fillable))
                //     continue;

                $v = !is_array($v) ? ['eq' => $v] : $v;

                foreach ($v as $ops => $v1) {
                    if (!isset($operator[$ops]))
                        continue;
                    if (preg_match('/able_type/', $k))
                        $v1 = modelResolve($v1);

                    if ($operator[$ops] == 'in') {
                        $query->whereIn($k, $v1);
                    } else {
                        $query->where($k, $operator[$ops], $v1);
                    }
                }
            }
        }

        if ($request->filled('sort')) {
            $explode = explode(',', $request->sort);
            $sort = $explode[0];
            $order = $explode[1] ?? 'asc';

            // in_array($explode[0], $this->fillable) and 
            if (in_array($order, ['asc', 'desc'])) {
                $query->orderBy($sort, $order);
            }
        }


        if ($request->filled('with')) {

            $scopes = explode(',', $request->input('with'));
            //  dd($scopes) ;
            foreach ($scopes as $scope) {
                if ($scope == '*') {
                    $query->with($this->relationships);
                    continue;
                }

                //   if (in_array($scope, $this->relationships)) {
                $query->with($scope);
                //   }
            }
        }


        if (method_exists($this, 'scopeModelFilter')) {
            $query = $this->scopeModelFilter($query);
        }
    }

    public function loady()
    {
        $request = request();

        if (!$request->filled('with')) {
            return $this;
        }

        $scopes = explode(',', $request->input('with'));
        if (in_array('*', array_values($scopes))) {
            $this->load($this->relationships);
        } else
            $this->load($scopes);
        foreach ($scopes as $scope) {
            if ($scope == '*') {
                //$this->load($this->relationships);
                //continue;
            }
            //  if (in_array($scope, $this->relationships)) {
            //    / $this->load($scopes);
            //  return;

            //  }
        }
        return $this;
    }
}
