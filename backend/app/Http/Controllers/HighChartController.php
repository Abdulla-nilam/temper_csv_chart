<?php

namespace App\Http\Controllers;

use App\Repositories\HighChartRepositoryInterface;
use Illuminate\Http\Request;

class HighChartController extends Controller
{
    protected $highChartRepository;

    /**
     * HighChartController constructor.
     *
     * @param HighChartRepositoryInterface $highChartRepository
     */
    public function __construct(
        HighChartRepositoryInterface $highChartRepository
    ) {
        $this->highChartRepository = $highChartRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $steps = array(0, 20, 40, 50, 70, 90, 99, 100);
        $response = $this->highChartRepository->all($steps);

        $number = 1;
        $data = array();
        foreach ($response['data'] as $key => $item) {
            $start = $response['weeks'][$key]['start'];
            $end = $response['weeks'][$key]['end'];
            $data[] = [
                'name' => 'Week ' . $start . " - " . $end,
                'data' => $item,

            ];

            $number++;
        }

        return view('highchart', [
            'complete_percentage' => json_encode($steps),
            'series'              => json_encode($data, true),
            'user_count'          => json_encode($response['user_count'], true)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
