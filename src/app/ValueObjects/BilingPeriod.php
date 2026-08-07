<?php

namespace App\ValueOjects;

use Illuminate\Support\Carbon;

class BillingPeriod
{
    
    public readonly Carbon $startDate;
    public readonly Carbon $endDate;

    public function __construct(string $yearMonth, int $cutoffDay = 25)
    {
        $this->startDate = Carbon::parse("{$yearMonth}-{$cutoffDay}")->startOfDay();
    
        $this->endDate = $this->startDate->copy()->addMonth()->subDay()->endOfDay();    
    }

    public static function current(int $cutoffDay = 25): self
    {
        $today = Carbon::today();

        if ($today->day < $cutoffDay) {
            $yearMonth = $today->copy()->subMonth()->format('Y-m');
        }else {
            $yearMonth = $today->format('Y-m');
        }

        return new self($yearMonth, $cutoffDay);
    } 

}