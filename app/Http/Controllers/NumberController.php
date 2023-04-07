<?php

namespace App\Http\Controllers;

use App\Services\CommonService;
use App\Services\NumberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NumberController extends Controller
{
    protected string $prefixValue = "ABC";
    protected $numberService;
    protected $commonService;

    public function __construct(NumberService $numberService, CommonService $commonService)
    {
        $this->numberService = $numberService;
        $this->commonService = $commonService;
    }

    /**
     * This function used to return next insert number
     * @return string
     */
    private function findNextNumber(): string
    {
        $latest_record = $this->numberService->latest();
        if ($latest_record == null) {
            $number = $this->prefixValue . '10000';
        } else {
            $number = $this->prefixValue . (int)substr($latest_record['number'], -5) + 1;// Get last 5 digit number and add 1
        }
        return $number;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = ['number' => $this->findNextNumber()];
            $this->numberService->create($data);
            DB::commit();
            return response()->json(['type' => 'Success', 'Insert Number' => $this->findNextNumber()]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return response()->json($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    /**
     * This function used to show what next number is.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNextNumber(): \Illuminate\Http\JsonResponse
    {
        try {
            $nextNumber = $this->findNextNumber();
            return response()->json(['Next Number Is' => $nextNumber]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json($exception->getMessage());
        }
    }
}
