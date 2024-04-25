<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;
use DateTime;
use App\Models\ScheduleManager;
use Illuminate\Support\Facades\Validator;

class ScheduleManagerController extends Controller
{
    protected $term;

    /**
     * TermController constructor.
     * @param ScheduleManager $schedule
     */
    public function __construct(ScheduleManager $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * @return $this
     */
    public function index(Request $request)
    {
        //dd($request);
        $options = array(
            'service_type_no' => $request->get('service_type_no'),
            'date' => date("Y-d-m", strtotime($request->get('date')))
        );
        $schedules = $this->schedule::orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.pages.oz.schedule.schedules')->with('schedules', $schedules);
    }

    /**
     * @param $id
     * @return $this
     */

    public function edit_schedule($id)
    {
        if (isset($id)) {
            $schedule = $this->schedule::find($id);
            return view('admin.pages.oz.schedule.schedules')
                ->with('schedule', $schedule);
        }

    }

    /**
     * @param \App\Http\Controllers\Admin\Request $request
     * @param $id
     * @return $this|RedirectResponse
     */
    public function schedule_update_save(Request $request)
    {
//        dd($request->all());
        $id = $request->id;

        $hourRange = explode(' - ', $request->hour_range);
        $validator = Validator::make($request->all(),
            [
                'service_type_no' => 'required',
                'date' => 'required',
                'teams' => 'required',
                'hour_range' => 'required',

            ],
        );
        if ($validator->fails()) {
            return redirect()->back()
                ->with(['status' => 0, 'message' => 'Missing input']);
        } else {
            // store
            $getDate = $request->get('date');

            $create_date_format = date_create($getDate);

            $sttdate = date_format($create_date_format, 'Y-m-d');
            $day = date_format($create_date_format, 'l');
            $month = date_format($create_date_format, 'F');
            $year = date_format($create_date_format, 'Y');

//            $attributes = [];
//            dd($request->teams);
            foreach ($request->teams as $team) {
                $attributes = [
                    'service_id' => $request->get('service_type_no'),
                    'zone_id' => $request->get('zone_id'),
                    'date' => $sttdate,
                    'day' => $day,
                    'month' => $month,
                    'year' => $year,
                    //'start_between' => $request->get('start_between'),
                    //'end_between' => $request->get('end_between'),
                    'from_hour' => $hourRange[0],
                    'within_hour' => $hourRange[1],
                    'team_id' => $team,
                    //'total_person' => $request->get('total_person'),
                    //'available_person' => $request->get('available_person'),
                    'team_availability' => $request->get('team_availability'),
                    'is_booked' => $request->get('is_booked'),
                ];
                $this->schedule->where('id', $id)->update($attributes);
            }


//             dd($attributes);
            try {
                return redirect()->back()->with(['status' => 1, 'message' => 'Successfully save changed']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }

    /**
     * @param Request $request
     * @return $this
     * @internal param Request $request
     */
    public function store(Request $request)
    {
        // read more on validation at

        $hourRange = explode(' - ', $request->hour_range);
//        dd($hourRange);
        $validator = Validator::make($request->all(),
            [
                'service_type_no' => 'required',
                'date' => 'required',
                'teams' => 'required',
                'hour_range' => 'required',
//                'within_hour' => 'required'
            ]
        );
//        dd($request->all());
        // process the login
        if ($validator->fails()) {
            return redirect()->back()
                ->with(['status' => 0, 'message' => 'Missing input']);
        } else {
            // store

            $getDate = $request->get('date');
//            $ndate = DateTime::createFromFormat('d/m/Y', $date);
//            dd($date);
//            $stt = strtotime($ndate->format('m/d/Y'));
            $create_date_format = date_create($getDate);
//            $stt = date_format($create_date_format,"d/m/Y");
//            dd(date_format($create_date_format, 'l'));

            $sttdate = date_format($create_date_format, 'Y-m-d');
            $day = date_format($create_date_format, 'l');
            $month = date_format($create_date_format, 'F');
            $year = date_format($create_date_format, 'Y');

            //dd(date('Y-m-d', $stt));
            $attributes = [];
            foreach ($request->teams as $team){
                $attributes []= [
                    'service_id' => $request->get('service_type_no'),
                    'zone_id' => $request->get('zone_id'),
                    'date' => $sttdate,
                    'day' => $day,
                    'month' => $month,
                    'year' => $year,
                    //'start_between' => $request->get('start_between'),
                    //'end_between' => $request->get('end_between'),
                    'from_hour' => $hourRange[0],
                    'within_hour' => $hourRange[1],
                    'team_id' => $team,
                    //'total_person' => $request->get('total_person'),
                    //'available_person' => $request->get('available_person'),
                    'team_availability' => $request->get('team_availability'),
                    'is_booked' => $request->get('is_booked'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

//            dd($attributes);
            try {
                $done = $this->schedule->insert($attributes);
                //dd($done);
                return redirect()->back()->with(['status' => 1, 'message' => 'Successfully save changed']);
            } catch (\Illuminate\Database\QueryException $ex) {
                //dd($ex);
                return redirect('schedules')->withErrors($ex->getMessage());
            }
        }

    }

    /**
     * @param $id
     * @return $this
     */
    public function destroy($id)
    {
        $data = $this->schedule->find($id);
        $data->delete();
        try {
            return redirect()->back()->with('success', 'Successfully deleted');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function btchDestroy(Request $request){
        // Date Range
//        dd($request->all());
        $date_range = $request->get('date_range');
        $dates = explode('-', $date_range);
        $start_date = date('Y-m-d', strtotime(trim($dates[0])));
        $end_date = date('Y-m-d', strtotime(trim($dates[1])));
        $data = $this->schedule::whereBetween('date', [$start_date, $end_date])
                        ->where('service_id', $request->service_type_no)
                        ->where('zone_id', $request->zone_id);
//        dd($data);
        $data = $data->delete();
        return redirect()->back()->with('success', 'Successfully deleted');
    }


    // Custom Methods

    public function check_if_cat_url_exists(Request $request)
    {
        $seo_url = $request->get('seo_url');
        $schedule = $this->schedule->getByAny('seo_url', $seo_url);
        if ($schedule->first()) {
            $url = $schedule->first()->seo_url;
            $nu = $url . '-' . date('ms');
            $m = $nu;
        } else {
            $m = $seo_url;
        }
        return response()->json(['url' => $m]);

    }


    // Bunch schedule generator

    public function schedule_generator()
    {
        return view('admin.pages.oz.schedule.schedule_generator');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function save_schedules(Request $request)
    {

        // Date Range
        $date_range = $request->get('date_range');
        $dates = explode('-', $date_range);
        $start_date = date('Y-m-d', strtotime(trim($dates[0])));
        $end_date = date('Y-m-d', strtotime(trim($dates[1])));

        // Time Range
        $time_range = $request->get('time_range');
        $times = explode('-', $time_range);
        $from_hour = trim($times[0]);
        $within_hour = trim($times[1]);

        $get_array = $this->create_date_range([
            'start_date' => $start_date,
            'end_date' => $end_date,
            'service_id' => $request->get('service_id'),
            'zone_id' => $request->get('zone_id'),
            'from_hour' => $from_hour,
            'within_hour' => $within_hour,
            'teams' => $request->get('teams'),
            'team_availability' => $request->get('team_availability'),
            'is_booked' => $request->get('is_booked')
        ]);


        try {
            foreach ($get_array as $k => $arr) {
                $this->schedule->insert($get_array[$k]);
            }
            return redirect()->back()->with(['status' => 1, 'message' => 'Successfully schedule generated']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('schedule_generator')->withErrors($ex->getMessage());
        }
    }


    public function create_date_range(array $options = array())
    {
        $default = array(
            'start_date' => null,
            'end_date' => null,
            'service_id' => null,
            'zone_id' => null,
            'from_hour' => null,
            'within_hour' => null,
            'teams' => null,
            'team_availability' => null,
            'is_booked' => null,
            'format' => "Y-m-d"
        );
        $new = array_merge($default, $options);


        $begin = new DateTime($new['start_date']);
        $end = new DateTime($new['end_date']);
        $end = $end->modify('+1 day');
        $interval = new DateInterval('P1D'); // 1 Day
        $period = new DatePeriod($begin, $interval, $end);
        $total = $end->diff($begin)->format("%a");
        $new_date = new DateTime();
        $today = $new_date->format('Y-m-d H:i:s');

        $range = [];

        foreach ($new['teams'] as $k => $team) {

            foreach ($period as $key => $value) {
                $range[$team][$key]['service_id'] = $new['service_id'];
                $range[$team][$key]['zone_id'] = $new['zone_id'];
                $range[$team][$key]['date'] = $value->format($new['format']);
                $range[$team][$key]['day'] = $value->format('l');
                $range[$team][$key]['month'] = $value->format('F');
                $range[$team][$key]['year'] = $value->format('Y');
                $range[$team][$key]['from_hour'] = $new['from_hour'];
                $range[$team][$key]['within_hour'] = $new['within_hour'];
                $range[$team][$key]['team_id'] = $team;
                $range[$team][$key]['team_availability'] = $new['team_availability'];
                $range[$team][$key]['is_booked'] = $new['is_booked'];
                $range[$team][$key]['created_at'] = $today;
                $range[$team][$key]['updated_at'] = $today;

                // $range[$team]
            }

        }
        return $range;
    }


}
