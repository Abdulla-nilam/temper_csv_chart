<?php

namespace App\Repositories;

use App\Imports\HighChartImport;
use Carbon\Carbon;

class HighChartRepository implements HighChartRepositoryInterface
{
    /**
     * @param $steps
     *
     * @return array|mixed
     * @throws \Exception
     */
    public function all($steps)
    {
        $collection
            = (new HighChartImport)->toCollection(storage_path('export.csv'));

        $data = $this->format($collection);
        $weeksByDates = $this->getWeeks();
        $userCount = count($data);

        $formattedData = $this->groupByWeeksAndPercentage($weeksByDates, $data,
            $userCount, $steps);

        $return = [
            'data' => $formattedData,
            'user_count' => $userCount,
            'weeks' => $weeksByDates
        ];

        return $return;

    }

    /**
     * format CSV data
     *
     * @param $collection
     *
     * @return array
     */
    private function format($collection): array
    {
        $format = [];

        $data = $collection->first()->skip(1)->all();
        $header = $collection->first()->first()->all();

        $fieldNames = array_values($header);
        foreach ($data as $item) {
            $format[] = array_combine($fieldNames, $item->all());
        }

        return $format;
    }

    /**
     * get all weeks start and end date by given date
     *
     * @return array
     * @throws \Exception
     */
    private function getWeeks(): array
    {
        $startDate = strtotime('2016-07-19');
        $endDate = strtotime('2016-08-10');

        $weekCounts = array();
        $weeksByDate = array();

        while ($startDate < $endDate) {
            $weekCounts[] = date('W', $startDate);
            $startDate += strtotime('+1 week', 0);
        }

        foreach ($weekCounts as $weekCount) {
            $date = new Carbon();
            $date->setISODate(2016, $weekCount);
            $start = $date->startOfWeek()->format('Y-m-d');
            $end = $date->endOfWeek()->format('Y-m-d');
            $weeksByDate[] = [
                'start' => $start,
                'end'   => $end,
            ];
        }
        return $weeksByDate;
    }


    /**
     * grouping data by week and the percentage
     *
     * @param $weeksByDates
     * @param $data
     * @param $userCount
     * @param $steps
     *
     * @return array
     */
    private function groupByWeeksAndPercentage(
        $weeksByDates,
        $data,
        $userCount,
        $steps
    ): array {
        $formattedData = array();
        foreach ($weeksByDates as $weeksByDate) {
            $dataGroupByWeeks = [];
            foreach ($data as $key => $datum) {
                $isBetween = Carbon::parse($datum['created_at'])
                    ->between($weeksByDate['start'], $weeksByDate['end']);

                if ($isBetween) {
                    $dataGroupByWeeks[] = $datum;
                }
            }
            $formattedData[]
                = $this->groupByPercentage($dataGroupByWeeks, $userCount,
                $steps);
        }
        return $formattedData;
    }


    /**
     * grouping data by percentage
     *
     * @param $dataGroupByWeeks
     * @param $userCount
     * @param $steps
     *
     * @return array
     */
    private function groupByPercentage(
        $dataGroupByWeeks,
        $userCount,
        $steps
    ): array {
        $formattedData = array();

        foreach ($steps as $step) {
            $group = [];
            foreach ($dataGroupByWeeks as $key => $dataGroupByWeek) {
                if ($dataGroupByWeek['onboarding_perentage'] === $step) {
                    $group[] = $dataGroupByWeek;
                }
            }
            $formattedData[] = round((count($group) / $userCount) * 100);
        }
        return $formattedData;
    }
}
