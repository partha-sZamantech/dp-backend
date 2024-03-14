<?php


namespace App\Http\Services\Bn;

use App\Models\Election;
use Illuminate\Support\Facades\Cache;

class ElectionService
{
    public $bnElectionDataCacheKey = 'bnElectionDataCacheKey';

    public function getElectionData()
    {
        if (!Cache::has($this->bnElectionDataCacheKey)) {
            $electionData = Election::query()
                ->select(['id', 'title', 'total_center', 'casted_center', 'party_one_name', 'party_two_name', 'party_three_name','party_four_name', 'party_one_votes', 'party_two_votes', 'party_three_votes', 'party_four_votes'])
                ->where('status', 1)
                ->where('deletable', 1)
                ->latest()
                ->first();

            if ($electionData) {
                Cache::forever($this->bnElectionDataCacheKey, $electionData);
            }

        } else {
            $electionData = Cache::get($this->bnElectionDataCacheKey);
        }

        return $electionData;
    }

    public function clearCache()
    {
        Cache::forget($this->bnElectionDataCacheKey);
    }

}
