<?php
namespace App\UseCases;
use App\DTO\FindIncomeDTO;
use App\Http\Resources\IncomeResource;
use App\Models\Income;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FindIncome
{
    public function handle(FindIncomeDTO $data): AnonymousResourceCollection
    {
        $foundData=Income::where('income_purpose_id','=',$data->income_purpose_id)
                            ->orWhere('amount','=',$data->amount)
                            ->orWhere('possession','=',$data->possession)
                            ->orWhere('detail','=',$data->detail)
                            ->whereBetwheen('at_date', [$data->first_date_time, $data->last_date_time])
                            ->get();

        return IncomeResource::collection($foundData);
    }
}