<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class Driver extends Model
{
    protected $primaryKey = 'driverId';

    public function fullName()
    {
        return "{$this->forename} {$this->surname}";
    }

    public function age($getYearOnly = false)
    {
        $diff = date_diff(date_create($this->dob), date_create('today'));

        $yearText = $diff->y . " years";
        $monthText = $diff->m . " month";
        $dayText = $diff->d . " day";

        $monthText = $diff->m !== 1 ? $monthText . "s" : $monthText;
        $dayText = $diff->y !== 1 ? $dayText . "s" : $dayText;

        if ($getYearOnly) {
            return $diff->y;
        }
        return "{$yearText}, {$monthText}, {$dayText}";
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'driverId');
    }

    public function stats()
    {
        $results = Result::where('driverId', $this->driverId)->get();

        /** @var PDO $pdo */
        $pdo = DB::connection()->getPdo();

        $sql = "S"."ELECT ds.points, ds.position
                FROM drivers d, driverStandings ds, races r
                WHERE ds.raceId = r.raceId AND ds.driverId = d.driverId
                AND d.driverId = ?
                AND (r.year, r.round) IN (SELECT year, MAX(round) FROM races GROUP BY year)";

        $stm = $pdo->prepare($sql);
        $stm->execute([$this->driverId]);

        $champResults = $stm->fetchAll(\PDO::FETCH_ASSOC);

        $races = count($results);
        $wins = 0;
        $podiums = 0;
        $poles = 0;
        $titles = 0;
        $points = 0;

        foreach ($results as $result) {
            if ($result['grid'] === 1) $poles++;
            if ($result['position'] === 1) $wins++;
            if (in_array($result['position'], [1, 2, 3])) $podiums++;
        }

        foreach ($champResults as $result) {
            if ($result['position'] === 1) $titles++;
            $points += (int) $result['points'];
        }

        return [
            'races' => [
                'label' => $races === 1 ? 'race' : 'races',
                'amount' => $races
            ],
            'points' => [
                'label' => $points === 1 ? 'point' : 'points',
                'amount' => $points
            ],
            'poles' => [
                'label' => $poles === 1 ? 'pole position' : 'pole positions',
                'amount' => $poles
            ],
            'podiums' => [
                'label' => $podiums === 1 ? 'podium' : 'podiums',
                'amount' => $podiums
            ],
            'wins' => [
                'label' => $wins === 1 ? 'win' : 'wins',
                'amount' => $wins
            ],
            'titles' => [
                'label' => $titles === 1 ? 'title' : 'titles',
                'amount' => $titles
            ],
        ];
    }
}
