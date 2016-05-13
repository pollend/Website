<?php

namespace PN\Resources;


use PN\Foundation\Presenters\Presenter;

class ParkPresenter extends Presenter implements ResourcePresenterInterface
{
    public function imageUrl()
    {
        return $this->model->getImage()->source;
    }

    public function getStatGroups()
    {
        return [
            'Rating' => [
                'RatingPriceSatisfaction',
                'RatingCleanliness',
                'RatingHappiness',
            ],
            'Stats' => [
                'GuestCount',
                'ParkYear',
            ],
            'Park' => [
                'SizeX',
                'SizeY',
                'Money',
                'ParkEntranceFee',
            ]
        ];
    }

    public function isReleasable()
    {
        return false;
    }

    public function getVersion()
    {
        return null;
    }

    public function getZipBallUrl()
    {
        return null;
    }
}
