<?php

namespace App\Filters;

use App\Builders\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * The request instance.
     *
     * @var Request
     */
    private $request;

    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $query;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters to the builder.
     *
     * @param Builder $query
     * @return Builder
     */
    public function apply(Builder $query)
    {
        $this->query = $query;

        foreach ($this->filters() as $method => $value) {
            if (! method_exists($this, $method)) {
                continue;
            }
            if ((is_string($value) && strlen($value)) || (is_array($value) && ! empty($value))) {
                $this->{$method}($value);
            }
        }

        return $this->query;
    }

    /**
     * Get request filters data.
     *
     * @return array
     */
    public function filters()
    {
        return $this->request->get('filters', []);
    }

    /**
     * @param $publish_datetime
     * @return \App\Builders\Builder
     */
    protected function publish_datetime($publish_datetime)
    {
        $publishTimes = explode(' - ', $publish_datetime);
        array_walk($publishTimes, function (&$time) {
            $time = trim($time);
        });

        if (count($publishTimes) === 2) {
            $from = $publishTimes[0];
            $to = $publishTimes[1];

            return $this->query->where(function ($query) use ($from, $to) {
                $query->whereNull('publish_start_datetime')
                      ->orWhere(function ($q) use ($from, $to) {
                          $q->where('publish_end_datetime', '<=', $to)
                            ->where('publish_start_datetime', '>=', $from);
                      });
            });
        }

        return $this->query;
    }
}
