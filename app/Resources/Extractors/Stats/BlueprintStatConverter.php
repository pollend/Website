<?php


namespace PN\Resources\Extractors\Stats;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PN\Resources\Exceptions\BlueprintNotTested;

class BlueprintStatConverter implements DataToStatConverterInterface
{
    public function convert(array $data) : Collection
    {
        if ($data != null) {
            $converted = array_only($data['Coaster']['Stats'], [
                'RatingExcitement',
                'RatingIntensity',
                'RatingNausea',
                'AirTime',
                'Drops',
                'TotalDropHeight',
                'BiggestDrop',
                'AverageVelocity',
                'MaxVelocity',
                'RideLengthTime',
                'RideLengthDistance',
                'Inversions',
                'HeadChoppers',
                'AverageVertG',
                'MinVertG',
                'MaxVertG',
                'AverageLatG',
                'MinLatG',
                'MaxLatG',
                'AverageLongG',
                'MinLongG',
                'MaxLongG',
            ]);

            $converted['RatingExcitement'] = $converted['RatingExcitement'] * 100;
            $converted['RatingIntensity'] = $converted['RatingIntensity'] * 100;
            $converted['RatingNausea'] = $converted['RatingNausea'] * 100;
            $converted['AverageSpeed'] = $converted['AverageVelocity'] * 3.6;
            $converted['MaxSpeed'] = $converted['MaxVelocity'] * 3.6;
            $converted['EntranceFee'] = $data['Coaster']['EntranceFee'];
            $converted['TrainCount'] = $data['Coaster']['TrainCount'];
            $converted['TrainLength'] = $data['Coaster']['TrainLength'];
            $converted['TrainTotal'] = $converted['TrainCount'] * $converted['TrainLength'];

            if ($converted['RideLengthTime'] != 0) {
                $converted['MaximumEstimatedProfit'] = (3600 / $converted['RideLengthTime']) * ($converted['TrainTotal'] * 4);
            } else {
//                throw new BlueprintNotTested('Ride Length Time is 0');
            }

            unset($converted['MaxVelocityT']);
            unset($converted['BiggestDropStartT']);
            unset($converted['AverageVelocity']);
            unset($converted['MaxVelocity']);
            unset($converted['DirectionChanges']);

            return new Collection($converted);
        }

        return new Collection();
    }
}