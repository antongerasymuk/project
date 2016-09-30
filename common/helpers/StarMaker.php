<?php
namespace common\helpers;

class StarMaker
{
    public function make($rating)
    {
//        $rating = 9.5;
        $starts = [];

        // calc full starts
        $fullStars = (int)($rating / 2);

        for ($i = 0; $i < $fullStars; $i++) {
            $starts[] = 'full';
        }

        if ($fullStars == 5) {
            return $starts;
        }

        $halfStars = $rating % 2;

        for ($i = 0; $i < $halfStars; $i++) {
            $starts[] = 'half';
        }

        $startsLength = count($starts);

        if ($startsLength < 5) {
            for ($i = 0; $i < 5 - $startsLength; $i++) {
                $starts[] = 'empty';
            }
        }

        return $starts;
    }
}