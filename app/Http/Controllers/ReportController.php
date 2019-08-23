<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\ExtraShift;
use App\Store;
use Storage;
use App\User;
use App\Utils\Helper;
use App\WeekdayShift;
use App\WeekendShift;
use Carbon\Carbon;
use App\Shift;
use App\Utils\DayOfWeek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Roster;

class ReportController extends Controller
{
    public function getExportLayout()
    {
        return view('reports.export');
    }


    public function generateWeeks($before = 4, $after = 4)
    {
        $beforeWeek = Carbon::now()->startOfWeek()->subWeeks($before);
        $afterWeek = Carbon::now()->startOfWeek()->addWeeks($after);

        $diff = $afterWeek->diffInDays($beforeWeek);
        $weeks = array();
        for ($i = 0; $i <= $diff; $i = $i + 7) {
            $date = clone $beforeWeek;
            $week = array(
                'start' => $date->addDays($i)->format('Y-m-d'),
                'end' => $date->addDays(6)->format('Y-m-d'),
            );
            array_push($weeks, (object)$week);
        }

        return $weeks;

    }

    public function addRoster(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'weekday' => 'required|string',
            'date' => 'required:date',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i',
            'employee' => 'required:integer'
        ]);

        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()->all()], 400);
        }
        if (Helper::getDuration($request->start, $request->end) < 0) {
            return response()->json(['error' => ['Start time should not be less than the end time']], 400);
        }

        if ($request->has('id')) {
            $roster = Roster::find($request->id);
            if ($roster) {
                $updated = $roster->update([
                    'end' => $request->end,
                    'start' => $request->start,
                    'employee_id' => $request->employee
                ]);

                return $updated ? 'success' : abort(500);
            } else {
                abort(500);
            }
        }

        $roster = new Roster();
        $roster->weekday = $request->weekday;
        $roster->date = $request->date;
        $roster->start = $request->start;
        $roster->end = $request->end;
        $roster->store_id = $request->store;
        $roster->employee_id = $request->employee;
        $saved = $roster->save();
        return $saved ? 'success' : abort(500);
    }

    public function reportRosterTest(Request $request)
    {

        if (Auth::user()->isSuperAdmin()) {
            $stores = Store::all();
        } else {
            $stores = Store::where('id', Auth::user()->getStore())->get();
        }
        $date = [];
        $reports = [];
        $store = new Store;
        $employees = [];
        $countReport = [];
        if ($request->store && $request->store != '' && $request->date && $request->date != '') {
            $store = $request->store;
            $employees = Store::find($request->store)->employees()->get();
            $start = Carbon::createFromFormat('Y-m-d', $request->date)->startOfWeek();
            $end = Carbon::createFromFormat('Y-m-d', $request->date)->endOfWeek();
            $date = [$start->format('Y-m-d')];
            for ($i = 1; $i <= 6; $i++) {
                $date[] = $start->addDay()->format('Y-m-d');
            }
            $monday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[0]]
            ])->get();
            $tuesday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[1]]
            ])->get();
            $wednesday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[2]]
            ])->get();
            $thursday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[3]]
            ])->get();
            $friday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[4]]
            ])->get();
            $saturday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[5]]
            ])->get();
            $sunday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[6]]
            ])->get();
            $limit = max(count($monday), count($tuesday), count($wednesday), count($thursday), count($friday), count($saturday), count($sunday));
            for ($i = 0; $i < $limit; $i++) {
                if (isset($monday[$i])) {
                    $data = Roster::find($monday[$i]->id)->employee()->first();
                    $reports[$i]['monday']['Id'] = $monday[$i]->id;
                    $reports[$i]['monday']['storeId'] = $monday[$i]->store_id;
                    $reports[$i]['monday']['start'] = $monday[$i]->start;
                    $reports[$i]['monday']['end'] = $monday[$i]->end;
                    $reports[$i]['monday']['employeeId'] = $data->id;
                    $reports[$i]['monday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
                if (isset($tuesday[$i])) {
                    $data = Roster::find($tuesday[$i]->id)->employee()->first();
                    $reports[$i]['tuesday']['Id'] = $tuesday[$i]->id;
                    $reports[$i]['tuesday']['storeId'] = $monday[$i]->store_id;
                    $reports[$i]['tuesday']['start'] = $tuesday[$i]->start;
                    $reports[$i]['tuesday']['end'] = $tuesday[$i]->end;
                    $reports[$i]['tuesday']['employeeId'] = $data->id;
                    $reports[$i]['tuesday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
                if (isset($wednesday[$i])) {
                    $data = Roster::find($wednesday[$i]->id)->employee()->first();
                    $reports[$i]['wednesday']['Id'] = $wednesday[$i]->id;
                    $reports[$i]['wednesday']['storeId'] = $monday[$i]->store_id;
                    $reports[$i]['wednesday']['start'] = $wednesday[$i]->start;
                    $reports[$i]['wednesday']['end'] = $wednesday[$i]->end;
                    $reports[$i]['wednesday']['employeeId'] = $data->id;
                    $reports[$i]['wednesday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
                if (isset($thursday[$i])) {
                    $data = Roster::find($thursday[$i]->id)->employee()->first();
                    $reports[$i]['thursday']['Id'] = $thursday[$i]->id;
                    $reports[$i]['thursday']['storeId'] = $monday[$i]->store_id;
                    $reports[$i]['thursday']['start'] = $thursday[$i]->start;
                    $reports[$i]['thursday']['end'] = $thursday[$i]->end;
                    $reports[$i]['thursday']['employeeId'] = $data->id;
                    $reports[$i]['thursday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
                if (isset($friday[$i])) {
                    $data = Roster::find($friday[$i]->id)->employee()->first();
                    $reports[$i]['friday']['Id'] = $friday[$i]->id;
                    $reports[$i]['friday']['storeId'] = $monday[$i]->store_id;
                    $reports[$i]['friday']['start'] = $friday[$i]->start;
                    $reports[$i]['friday']['end'] = $friday[$i]->end;
                    $reports[$i]['friday']['employeeId'] = $data->id;
                    $reports[$i]['friday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
                if (isset($saturday[$i])) {
                    $data = Roster::find($saturday[$i]->id)->employee()->first();
                    $reports[$i]['saturday']['Id'] = $saturday[$i]->id;
                    $reports[$i]['saturday']['storeId'] = $monday[$i]->store_id;
                    $reports[$i]['saturday']['start'] = $saturday[$i]->start;
                    $reports[$i]['saturday']['end'] = $saturday[$i]->end;
                    $reports[$i]['saturday']['employeeId'] = $data->id;
                    $reports[$i]['saturday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
                if (isset($sunday[$i])) {
                    $data = Roster::find($sunday[$i]->id)->employee()->first();
                    $reports[$i]['sunday']['Id'] = $sunday[$i]->id;
                    $reports[$i]['sunday']['storeId'] = $monday[$i]->store_id;
                    $reports[$i]['sunday']['start'] = $sunday[$i]->start;
                    $reports[$i]['sunday']['end'] = $sunday[$i]->end;
                    $reports[$i]['sunday']['employeeId'] = $data->id;
                    $reports[$i]['sunday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
            }
            foreach ($employees as $Key => $val) {
                $count = 0;
                foreach ($reports as $k => $v) {
                    foreach ($v as $c) {
                        if ($c['employeeId'] == $val->id) {
                            $count += Helper::getDuration($c['start'], $c['end']);
                        }
                    }
                }
                $countReport[] = ['name' => $val->firstname . ' ' . $val->lastname, 'count' => $count];
            }

        }

        $request->flash();
        return view('reports.roster-test-2', ['stores' => $stores, 'dates' => $date, 'reports' => $reports, 'store' => $store, 'title' => 'Roster Test Reports',
            'employees' => $employees, 'countReport' => $countReport,
            'weeks' => $this->generateWeeks()]);

    }

    public function exportRoster(Request $request)
    {
        $reports = array();

        if ($request->has('store') && $request->has('date')) {
            try {
                $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfWeek();
                $end = Carbon::createFromFormat('Y-m-d', $request->start)->endOfWeek();
            } catch (Exception $e) {
                abort(500);
            }

            $query = Employee::query();
            if (Auth::user()->isSuperAdmin()) {
                if ($request->has('store')) {
                    $query = $query->where('store_id', $request->store);
                }
                if ($request->has('department')) {
                    $query = $query->where('department_id', $request->department);
                }
                $stores = Store::all();
                $departments = Department::all();
            } else {
                $query = $query->where('store_id', Auth::user()->getStore());
                if ($request->has('department')) {
                    $query = $query->where('department_id', $request->department);
                } else {
                    $query = $query->where('department_id', '!=', Employee::ADMIN);
                }
                $stores = Store::find(Auth::user()->getStore());
                $departments = Department::where('id', '!=', Employee::ADMIN)->get();
            }

            $employees = $query->get();

            $employees = $query->get();
            foreach ($employees as $key => $employee) {
                $employeeReports = array();
                $totalHour = 0.0;
                $totalPay = 0.0;
                $employeesRosters = Roster::where([
                    ['day', '>=', $start],
                    ['day', '<=', $end]
                ])
                    ->get();
                $employeeReports['Monday'] = array();
                $employeeReports['Tuesday'] = array();
                $employeeReports['Wednesday'] = array();
                $employeeReports['Thursday'] = array();
                $employeeReports['Friday'] = array();
                $employeeReports['Saturday'] = array();
                $employeeReports['Sunday'] = array();

                foreach ($employeesRosters as $key => $value) {

                    $hour = Helper::getDuration($value->start, $value->end);
                    $totalHour += $hour;
                    $pay = $hour * $employee->weekday_wage;
                    $totalPay += $pay;
                    array_push($employeeReports[$value->weekday],
                        (object)array(
                            'start' => $value->start,
                            'end' => $value->end,
                            'rate' => $employee->weekday_wage,
                            'hour' => $hour,
                            'pay' => $pay
                        )
                    );

                }

                $employeeReports['id'] = $employee->id;
                $employeeReports['name'] = $employee->firstname . ' ' . $employee->lastname;
                $employeeReports['rate'] = $employee->weekday_wage;
                $employeeReports['totalPay'] = $totalPay;
                $employeeReports['totalHour'] = $totalHour;
                $employeeReports['totalHourFormat'] = floor($totalHour) . ':' .
                    floor(($totalHour - floor($totalHour)) * 60);
                $reports[$employee->id] = (object)$employeeReports;
            }
        }
    }


    public function salary(Request $request)
    {
        if (Auth::user()->isSuperAdmin()) {
            $stores = Store::all();
            $departments = Department::all();
        } else {
            $stores = Store::where('id', Auth::user()->getStore())->get();
            $departments = Department::where('id', '!=', Employee::ADMIN)->get();
        }

        return view('reports.salary', ['stores' => $stores, 'title' => 'Employee Salary', 'departments' => $departments]);
    }

    public function getSalaries(Request $request)
    {
        $data = $request->all();
        $request->flash();
        $messages = [
            'start.required' => 'Choose start date',
            'end.required' => 'Choose end date',
            'start.date' => 'Choose start date',
            'end.date' => 'Choose end date',
            'end.after_or_equal' => 'End date is grater Start date'
        ];
        $validate = Validator::make($data, [
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ], $messages);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $start = date('Y-m-d H:i:s', strtotime($request->start));
        $end = date('Y-m-d H:i:s', strtotime($request->end . '+23 hours + 59 minutes + 59 seconds'));

        $query = Employee::query();
        if ($request->has('store')) {
            $query = $query->where('store_id', $request->store);
        }
        if ($request->has('department')) {
            $query = $query->where('department_id', $request->department);
        }

        $employees = $query->get();
        $employeesShifts = array();
        foreach ($employees as $key => $employee) {
            $employeesShifts[$employee->id] = $employee->shifts()
                ->where([['start', '>=', $start],
                    ['start', '<=', $end]
                ])
                ->whereColumn([['start', '<=', 'end']])
                ->get();
        }

        $employeesSalaries = array();
        foreach ($employeesShifts as $employeeId => $shifts) {

            $employeesSalaries[$employeeId] = $this->calculateSalary($employeeId, $shifts);
        }
        return redirect()->back()->with(['employeesSalaries' => $employeesSalaries]);
    }

    public function calculateShiftsHour($employeeId, $shifts = array())
    {
        $weekdayHour = 0.0;
        $weekendHour = 0.0;
        $extraHour = 0.0;

        $idx = 0;
        foreach ($shifts as $shift) {
            if ($shift->end == null) {
                continue;
            }
            $startDate = date('Y-m-d', strtotime($shift->start));
            $endDate = date('Y-m-d', strtotime($shift->end));
            $compareDate = Helper::compareTime($endDate, $startDate);
            if ($compareDate == 0) {
                $hour = $this->calculateShiftHour($shift);
                $weekdayHour += $hour['weekdayHour'];
                $weekendHour += $hour['weekendHour'];
                $extraHour += $hour['extraHour'];
            } elseif ($compareDate == 1) {
                $hour = $this->calculateNextShiftHour($shift);
                $weekdayHour += $hour['weekdayHour'];
                $weekendHour += $hour['weekendHour'];
                $extraHour += $hour['extraHour'];
                $aaaa = array('weekdayHour' => $weekdayHour,
                    'weekendHour' => $weekendHour,
                    'extraHour' => $extraHour);
                if ($employeeId == 126) {
                    Storage::disk('local')->put($idx . $shift->weekday, json_encode([$shift->weekday => $aaaa]));
                    $idx++;
                }
            }
        }

        return array('weekdayHour' => $weekdayHour,
            'weekendHour' => $weekendHour,
            'extraHour' => $extraHour);

    }

    public function calculateShiftHour_bk(Shift $shift)
    {
        $employeeId = $shift->employee_id;
        $weekdayHour = 0.0;
        $weekendHour = 0.0;
        $extraHour = 0.0;
        $weekdayShift = WeekdayShift::where([
            ['weekday', '=', $shift->weekday],
            ['employee_id', '=', $employeeId]
        ])->first();
        $weekendShift = WeekendShift::where([
            ['weekday', '=', $shift->weekday],
            ['employee_id', '=', $employeeId]
        ])->first();
        $extraShift = ExtraShift::where([
            ['weekday', '=', $shift->weekday],
            ['employee_id', '=', $employeeId]
        ])->first();

        $start = date('H:i', strtotime($shift->start));
        $end = date('H:i', strtotime($shift->end));

        $weekdayShift = $weekdayShift ? $weekdayShift : new WeekdayShift;
        $weekendShift = $weekendShift ? $weekendShift : new WeekendShift;
        $extraShift = $extraShift ? $extraShift : new ExtraShift;
        if (Helper::compareTime($start, $end) >= 0) {

        } elseif (Helper::compareTime($start, $weekdayShift->start) < 0) {
            if (Helper::isBetweenTwoTime($end, $weekdayShift->start,
                $weekdayShift->end)) {
                $weekdayHour += Helper::getDuration($weekdayShift->start,
                    $end);
            } elseif (Helper::isBetweenTwoTime($end, $weekdayShift->end,
                $weekendShift->start)) {

                $weekdayHour += Helper::getDuration($weekdayShift->start,
                    $weekdayShift->end);
            } elseif (Helper::isBetweenTwoTime($end, $weekendShift->start,
                $weekendShift->end)) {
                $weekdayHour += Helper::getDuration($weekdayShift->start,
                    $weekdayShift->end);
                $weekendHour += Helper::getDuration($weekendShift->start,
                    $end);
            } elseif (Helper::isBetweenTwoTime($end, $weekendShift->end,
                $extraShift->start)) {
                $weekdayHour += Helper::getDuration($weekdayShift->start,
                    $weekdayShift->end);
                $weekendHour += Helper::getDuration($weekendShift->start,
                    $weekendShift->end);
            } elseif (Helper::isBetweenTwoTime($end, $extraShift->start,
                $extraShift->end)) {
                $weekdayHour += Helper::getDuration($weekdayShift->start,
                    $weekdayShift->end);
                $weekendHour += Helper::getDuration($weekendShift->start,
                    $weekendShift->end);
                $extraHour += Helper::getDuration($extraShift->start,
                    $end);
//                if ($shift->employee_id == 126 && $shift->weekday == "Saturday") {
//                    $houtr = array('weekdayHour' => $weekdayHour,
//                        'weekendHour' => $weekendHour,
//                        'extraHour' => $extraHour);
//                    Storage::disk('local')->put("logplus" . "5", json_encode($houtr));
//                    Storage::disk('local')->put("logplus" . "5" . "start", json_encode($start));
//                    Storage::disk('local')->put("logplus" . "5" . "end", json_encode($end));
//                }

            } elseif (Helper::compareTime($weekdayShift->start, $end) > 0) {

            } else {
                $weekdayHour += Helper::getDuration($weekdayShift->start,
                    $weekdayShift->end);
                $weekendHour += Helper::getDuration($weekendShift->start,
                    $weekendShift->end);
                $extraHour += Helper::getDuration($extraShift->start,
                    $extraShift->end);

            }

        } elseif (Helper::isBetweenTwoTime($start, $weekdayShift->start, $weekdayShift->end)) {
            if (Helper::isBetweenTwoTime($end, $weekdayShift->start,
                $weekdayShift->end)) {
                $weekdayHour += Helper::getDuration($start,
                    $end);
            } elseif (Helper::isBetweenTwoTime($end, $weekdayShift->end,
                $weekendShift->start)) {
                $weekdayHour += Helper::getDuration($start,
                    $weekdayShift->end);
            } elseif (Helper::isBetweenTwoTime($end, $weekendShift->start,
                $weekendShift->end)) {
                $weekdayHour += Helper::getDuration($start,
                    $weekdayShift->end);
                $weekendHour += Helper::getDuration($weekendShift->start,
                    $end);
            } elseif (Helper::isBetweenTwoTime($end, $weekendShift->end,
                $extraShift->start)) {
                $weekdayHour += Helper::getDuration($start,
                    $weekdayShift->end);
                $weekendHour += Helper::getDuration($weekendShift->start,
                    $weekendShift->end);
            } elseif (Helper::isBetweenTwoTime($end, $extraShift->start,
                $extraShift->end)) {
                $weekdayHour += Helper::getDuration($start,
                    $weekdayShift->end);
                $weekendHour += Helper::getDuration($weekendShift->start,
                    $weekendShift->end);
                $extraHour += Helper::getDuration($extraShift->start,
                    $end);
            } else {
                $weekdayHour += Helper::getDuration($start,
                    $weekdayShift->end);
                $weekendHour += Helper::getDuration($weekendShift->start,
                    $weekendShift->end);
                $extraHour += Helper::getDuration($extraShift->start,
                    $extraShift->end);
            }

        } elseif (Helper::isBetweenTwoTime($start, $weekdayShift->end,
            $weekendShift->start)) {
            if (Helper::isBetweenTwoTime($end, $weekdayShift->end,
                $weekendShift->start)) {

            } elseif (Helper::isBetweenTwoTime($end, $weekendShift->start,
                $weekendShift->end)) {
                $weekendHour += Helper::getDuration($weekendShift->start,
                    $end);
            } elseif (Helper::isBetweenTwoTime($end, $weekendShift->end,
                $extraShift->start)) {
                $weekendHour += Helper::getDuration($weekendShift->start,
                    $weekendShift->end);
            } elseif (Helper::isBetweenTwoTime($end, $extraShift->start,
                $extraShift->end)) {
                $weekendHour += Helper::getDuration($weekendShift->start,
                    $weekendShift->end);
                $extraHour += Helper::getDuration($extraShift->start,
                    $end);

            } else {
                $weekendHour += Helper::getDuration($weekendShift->start,
                    $weekendShift->end);
                $extraHour += Helper::getDuration($extraShift->start,
                    $extraShift->end);
            }

        } else if (Helper::isBetweenTwoTime($start, $weekendShift->start, $weekendShift->end)) {
            if (Helper::isBetweenTwoTime($end, $weekendShift->start,
                $weekendShift->end)) {
                $weekendHour += Helper::getDuration($start,
                    $end);
            } elseif (Helper::isBetweenTwoTime($end, $weekendShift->end,
                $extraShift->start)) {
                $weekendHour += Helper::getDuration($start,
                    $weekendShift->end);
            } else if (Helper::isBetweenTwoTime($end, $extraShift->start,
                $extraShift->end)) {
                $weekendHour += Helper::getDuration($start,
                    $weekendShift->end);
                $extraHour += Helper::getDuration($extraShift->start,
                    $end);
            } else {
                $weekendHour += Helper::getDuration($start,
                    $weekendShift->end);
                $extraHour += Helper::getDuration($extraShift->start,
                    $extraShift->end);
            }

        } elseif (Helper::isBetweenTwoTime($start, $weekendShift->end,
            $extraShift->start)) {
            if (Helper::isBetweenTwoTime($end, $weekendShift->end,
                $extraShift->start)) {

            } elseif (Helper::isBetweenTwoTime($end, $extraShift->start,
                $extraShift->end)) {
                $extraHour += Helper::getDuration($extraShift->start,
                    $end);

            } else {
                $extraHour += Helper::getDuration($extraShift->start,
                    $extraShift->end);
            }

        } else if (Helper::isBetweenTwoTime($start, $extraShift->start, $extraShift->end)) {
            if (Helper::isBetweenTwoTime($end, $extraShift->start,
                $extraShift->end)) {
                $extraHour += Helper::getDuration($start,
                    $end);
            } else {
                $extraHour += Helper::getDuration($start, $extraShift->end);
            }
        }
//        if ($shift->employee_id == 126 && $shift->weekday == "Saturday") {
//            $houtr = array('weekdayHour' => $weekdayHour,
//                'weekendHour' => $weekendHour,
//                'extraHour' => $extraHour);
//            Storage::disk('local')->put("shift" . $shift->weekday, json_encode($shift));
//            Storage::disk('local')->put("hour" . $shift->weekday, json_encode($houtr));
//        }
        return array('weekdayHour' => $weekdayHour,
            'weekendHour' => $weekendHour,
            'extraHour' => $extraHour);
    }

    public function calculateShiftHour(Shift $shift)
    {
        $employeeId = $shift->employee_id;
//        $weekdayHour = 0.0;
//        $weekendHour = 0.0;
//        $extraHour = 0.0;
        $weekdayShift = WeekdayShift::where([
            ['weekday', '=', $shift->weekday],
            ['employee_id', '=', $employeeId]
        ])->first();
        $weekendShift = WeekendShift::where([
            ['weekday', '=', $shift->weekday],
            ['employee_id', '=', $employeeId]
        ])->first();
        $extraShift = ExtraShift::where([
            ['weekday', '=', $shift->weekday],
            ['employee_id', '=', $employeeId]
        ])->first();

        $start = date('H:i', strtotime($shift->start));
        $end = date('H:i', strtotime($shift->end));

        $weekdayShift = $weekdayShift ? $weekdayShift : new WeekdayShift;
        $weekendShift = $weekendShift ? $weekendShift : new WeekendShift;
        $extraShift = $extraShift ? $extraShift : new ExtraShift;

        $weekdayHour = $this->calculateTime($start, $end, $weekdayShift);
        $weekendHour = $this->calculateTime($start, $end, $weekendShift);
        $extraHour = $this->calculateTime($start, $end, $extraShift);

//        if ($shift->employee_id == 126) {
//            $hour = array('weekdayHour' => $weekdayHour,
//                'weekendHour' => $weekendHour,
//                'extraHour' => $extraHour);
//            Storage::disk('local')->put("hour", json_encode($hour));
//        }

        return array('weekdayHour' => $weekdayHour,
            'weekendHour' => $weekendHour,
            'extraHour' => $extraHour);
    }

    public function calculateTime($start, $end, $durationShift)
    {
        if (
            Helper::isBetweenTwoTime($start, $durationShift->start, $durationShift->end) &&
            Helper::isBetweenTwoTime($end, $durationShift->start, $durationShift->end)
        ) {
            return Helper::getDuration($start, $end);
        }
        if (
            Helper::isBetweenTwoTime($start, $durationShift->start, $durationShift->end) == false &&
            Helper::isBetweenTwoTime($end, $durationShift->start, $durationShift->end)
        ) {
            return Helper::getDuration($durationShift->start, $end);
        }
        if (
            Helper::isBetweenTwoTime($start, $durationShift->start, $durationShift->end) &&
            Helper::isBetweenTwoTime($end, $durationShift->start, $durationShift->end) == false
        ) {
            return Helper::getDuration($start, $durationShift->end);
        }
        if (
            Helper::isBetweenTwoTime($start, $durationShift->start, $durationShift->end) == false &&
            Helper::isBetweenTwoTime($end, $durationShift->start, $durationShift->end) == false &&
            (Helper::compareTime($start, $durationShift->start) < 0 && Helper::compareTime($durationShift->end, $end) < 0)
        ) {
            return Helper::getDuration($durationShift->start, $durationShift->end);
        }
        return 0;
    }

    public function calculateNextShiftHour(Shift $shift)
    {
        $shift1 = new Shift;
        $shift1->id = $shift->id;
        $shift1->employee_id = $shift->employee_id;
        $shift1->weekday = $shift->weekday;
        $shift1->start = $shift->start;
        $end = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($shift->start)) . '+23 hours + 59 minutes + 59 seconds'));
        $shift1->end = $end;
        $hour1 = $this->calculateShiftHour($shift1);

        $shift2 = new Shift;
        $shift2->id = $shift->id;
        $shift2->employee_id = $shift->employee_id;
        $shift2->weekday = Helper::getDayOfWeek(Helper::getWeekDayIndex($shift->weekday) + 1 == 8 ? 1 : Helper::getWeekDayIndex($shift->weekday) + 1);
        $shift2->start = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($shift->start . '+1 day'))));

        $end = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($shift2->start)) . date('H:i:s', strtotime($shift->end))));
        $shift2->end = $end;
        $hour2 = $this->calculateShiftHour($shift2);
//        if ($shift->employee_id == 126) {
//            Storage::disk('local')->put("hour2" . $shift2->weekday, json_encode($hour2));
//            Storage::disk('local')->put("shift2" . $shift2->weekday, json_encode($shift2));
//        }
        return array('weekdayHour' => $hour1['weekdayHour'] + $hour2['weekdayHour'],
            'weekendHour' => $hour1['weekendHour'] + $hour2['weekendHour'],
            'extraHour' => $hour1['extraHour'] + $hour2['extraHour']
        );
    }


    public function calculateSalary($employeeId, $shifts = array())
    {
        $hours = $this->calculateShiftsHour($employeeId, $shifts);
        $weekdayHour = $hours['weekdayHour'];
        $weekendHour = $hours['weekendHour'];
        $extraHour = $hours['extraHour'];
        $employee = Employee::find($employeeId);
        $wageWeekday = $employee->weekday_wage;
        $wageWeekend = $employee->weekend_wage;
        $extraWage = $employee->extra_wage;

        $totalPay = $employee->fixed_rate == 1 ? $employee->fixed_rate_wage : round($weekdayHour * $wageWeekday + $weekendHour * $wageWeekend +
            $extraHour * $extraWage, 2);

        $bankPay = round($totalPay * $employee->bankpay * 0.01, 2);

        $tax = round($this->calculateTax($bankPay), 2);
        $salaryAfterTax = round($totalPay - $tax, 2);
        $totalHours = $weekdayHour + $weekendHour + $extraHour;
        $employeeSalary = (object)array('id' => $employeeId,
            'name' => $employee->firstname . ' ' . $employee->lastname,
            'weekdayHour' => $weekdayHour,
            'weekendHour' => $weekendHour,
            'extraHour' => $extraHour,
            'totalHour' => $weekdayHour + $weekendHour + $extraHour,
            'bankPay' => $bankPay,
            'cashPay' => $totalPay - $bankPay,
            'totalPay' => $totalPay,
            'netBankWage' => $bankPay - $tax,
            'grossPay' => $totalPay * $employee->bankpay * 0.01,
            'tax' => $tax,
            'salary' => $salaryAfterTax
        );
        return $employeeSalary;
    }

    public function calculateTax($salary)
    {
        if ($salary < 355) {
            return 0.0;
        } else if ($salary >= 355 && $salary < 416) {
            return ($salary + 0.99) * 0.19 - 67.4635;
        } else if ($salary >= 416 && $salary < 520) {
            return ($salary + 0.99) * 0.29 - 109.7327;
        } else if ($salary >= 520 && $salary < 711) {
            return ($salary + 0.99) * 0.21 - 67.4646;
        } else if ($salary >= 711 && $salary < 1282) {
            return ($salary + 0.99) * 0.3477 - 165.4435;
        } else if ($salary >= 1282 && $salary < 1673) {
            return ($salary + 0.99) * 0.345 - 161.9819;
        } else if ($salary >= 1673 && $salary < 3461) {
            return ($salary + 0.99) * 0.39 - 237.2704;
        } else {
            return ($salary + 0.99) * 0.47 - 514.1935;
        }

    }

    public function reportRoster(Request $request)
    {
        $query = Employee::query();
        if (Auth::user()->isSuperAdmin()) {
            $stores = Store::all();
            $departments = Department::all();
            if ($request->has('store')) {
                $query = $query->where('store_id', $request->store);
            }
            if ($request->has('department')) {
                $query = $query->where('department_id', $request->department);
            }
        } else {
            $stores = Store::find(Auth::user()->getStore());
            $departments = Department::where('id', '!=', Employee::ADMIN)->get();
            if ($request->has('store')) {
                $query = $query->where('store_id', $request->store);
            }
            if ($request->has('department') && $request->department != Employee::ADMIN) {
                $query = $query->where('department_id', $request->department);
            } else {
                $query = $query->where('department_id', '!=', Employee::ADMIN);
            }
        }
        $reports = array();

        $oldEmployees = $query->get();
        if ($request->has('employee')) {
            $employee = Employee::find($request->employee);
            if ($employee) {
                $query = $query->where('id', $request->employee);
            } else {
                return view('reports.roster-forcast', ['stores' => $stores, 'title' => 'Roster Forcast Report', 'departments' => $departments, 'employees' => $oldEmployees,
                    'reports' => Helper::collectionPaginate($reports)]);
            }
        }

        $weekday = null;
        if ($request->has('date')) {
            $weekday = Carbon::createFromFormat('Y-m-d', $request->date)->format('l');
        }
        $employees = $query->with('weekdayShifts')->get();
        foreach ($employees as $key => $employee) {
            $employeeReports = array();
            $totalHour = 0.0;
            $totalPay = 0.0;
            if ($weekday != null)
                $weekdayShifts = $employee->weekdayShifts()
                    ->where('weekday', $weekday)
                    ->get();
            else
                $weekdayShifts = $employee->weekdayShifts()
                    ->get();
            foreach ($weekdayShifts as $key => $value) {
                $hour = Helper::getDuration($value->start, $value->end);
                $totalHour += $hour;
                $pay = $hour * $employee->weekday_wage;
                $totalPay += $pay;
                $employeeReports[$value->weekday] = (object)array(
                    'start' => $value->start,
                    'end' => $value->end,
                    'rate' => $employee->weekday_wage,
                    'hour' => $hour,
                    'pay' => $pay
                );
            }

            $employeeReports['id'] = $employee->id;
            $employeeReports['name'] = $employee->firstname . ' ' . $employee->lastname;
            $employeeReports['rate'] = $employee->weekday_wage;
            $employeeReports['totalPay'] = $totalPay;
            $employeeReports['totalHour'] = $totalHour;
            $employeeReports['totalHourFormat'] = floor($totalHour) . ':' .
                floor(($totalHour - floor($totalHour)) * 60);
            $reports[$employee->id] = (object)$employeeReports;
        }

        $request->flash();
        return view('reports.roster-forcast', ['stores' => $stores, 'departments' => $departments,
            'title' => 'Roster Forcast Report', 'employees' => $oldEmployees,
            'reports' => Helper::collectionPaginate($reports)]);
    }

    public function reportAttendance2(Request $request)
    {
        if (Auth::user()->isSuperAdmin()) {
            $stores = Store::all();
            if ($request->has('store'))
                $employees = Employee::where('store_id', $request->store)->get();
            else
                $employees = Employee::all();
        } else {
            $stores = Store::find(Auth::user()->getStore());
            $employees = Employee::where([
                ['store_id', '=', Auth::user()->getStore()],
                ['department_id', '!=', Employee::ADMIN]
            ])
                ->get();
        }

        $employee = null;
        $startDate = Carbon::createFromFormat('d-m-Y', date('d-m-Y'))->startOfWeek();
        $endDate = Carbon::createFromFormat('d-m-Y', date('d-m-Y'))->endOfWeek();
        $reports = array();
        if (count($request->all()) > 0 && $request->has('employee')) {
            $request->flash();
            $data = $request->all();
            $messages = [
                'employee.required' => 'Choose 1 Employee',
                'employee.integer' => 'Choose 1 employee',
            ];
            $validate = Validator::make($data, [
                'employee' => 'required|integer',
            ], $messages);
            if ($validate->fails()) {
                return redirect()->back()
                    ->with([
                        'employee' => $request->employee,
                        'employees' => $employees
                    ])
                    ->withErrors($validate)
                    ->withInput();
            }

            $startDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->startOfWeek();
            $endDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->endOfWeek();

            if ($request->has('start')) {
                $startDate = date('Y-m-d H:i:s', strtotime($request->start));
            }
            if ($request->has('end')) {
                $endDate = date('Y-m-d H:i:s', strtotime($request->end . ' ' . '23 hours 59 minutes 59 seconds'));
            }

            $employee = Employee::find($request->employee);
            if ($employee != null) {
                $totalHours = 0.0;
                $totalPay = 0.0;
                $employeeShifts = $employee->shifts()
                    ->where([
                        ['start', '>=', $startDate],
                        ['start', '<=', $endDate]
                    ])
                    ->whereColumn('start', '<=', 'end')
                    ->get();

                $reports['Monday']['weekdayHour'] = 0.0;
                $reports['Monday']['weekendHour'] = 0.0;
                $reports['Monday']['extraHour'] = 0.0;

                $reports['Tuesday']['weekdayHour'] = 0.0;
                $reports['Tuesday']['weekendHour'] = 0.0;
                $reports['Tuesday']['extraHour'] = 0.0;

                $reports['Wednesday']['weekdayHour'] = 0.0;
                $reports['Wednesday']['weekendHour'] = 0.0;
                $reports['Wednesday']['extraHour'] = 0.0;

                $reports['Thursday']['weekdayHour'] = 0.0;
                $reports['Thursday']['weekendHour'] = 0.0;
                $reports['Thursday']['extraHour'] = 0.0;

                $reports['Friday']['weekdayHour'] = 0.0;
                $reports['Friday']['weekendHour'] = 0.0;
                $reports['Friday']['extraHour'] = 0.0;

                $reports['Saturday']['weekdayHour'] = 0.0;
                $reports['Saturday']['weekendHour'] = 0.0;
                $reports['Saturday']['extraHour'] = 0.0;

                $reports['Sunday']['weekdayHour'] = 0.0;
                $reports['Sunday']['weekendHour'] = 0.0;
                $reports['Sunday']['extraHour'] = 0.0;

                $weekdayHours = 0.0;
                $weekendHours = 0.0;
                $extraHours = 0.0;

                foreach ($employeeShifts as $item => $shift) {
                    $start = date('Y-m-d', strtotime($shift->start));
                    $end = date('Y-m-d', strtotime($shift->end));
                    $compareDate = Helper::compareTime($end, $start);

                    if ($compareDate == 0) {
                        $hour = $this->calculateShiftHour($shift);
                        $reports[$shift->weekday]['weekdayHour'] += $hour['weekdayHour'];
                        $reports[$shift->weekday]['weekendHour'] += $hour['weekendHour'];
                        $reports[$shift->weekday]['extraHour'] += $hour['extraHour'];

                        $weekdayHours += $hour['weekdayHour'];
                        $weekendHours += $hour['weekendHour'];
                        $extraHours += $hour['extraHour'];
                    } elseif ($compareDate == 1) {
                        $shift1 = new Shift;
                        $shift1->id = $shift->id;
                        $shift1->employee_id = $shift->employee_id;
                        $shift1->weekday = $shift->weekday;
                        $shift1->start = $shift->start;
                        $end = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($shift->start)) . '+23 hours + 59 minutes + 59 seconds'));
                        $shift1->end = $end;
                        $hour1 = $this->calculateShiftHour($shift1);
                        $reports[$shift1->weekday]['weekdayHour'] += $hour1['weekdayHour'];
                        $reports[$shift1->weekday]['weekendHour'] += $hour1['weekendHour'];
                        $reports[$shift1->weekday]['extraHour'] += $hour1['extraHour'];

                        $weekdayHours += $hour1['weekdayHour'];
                        $weekendHours += $hour1['weekendHour'];
                        $extraHours += $hour1['extraHour'];

                        $shift2 = new Shift;
                        $shift2->id = $shift->id;
                        $shift2->employee_id = $shift->employee_id;
                        $shift2->weekday = Helper::getDayOfWeek(Helper::getWeekDayIndex($shift->weekday) + 1 == 8 ? 1 : Helper::getWeekDayIndex($shift->weekday) + 1);
                        $shift2->start = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($shift->start . '+1 day'))));

                        $end = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($shift2->start)) . date('H:i:s', strtotime($shift->end))));
                        $shift2->end = $end;


                        $hour2 = $this->calculateShiftHour($shift2);
                        $reports[$shift2->weekday]['weekdayHour'] += $hour2['weekdayHour'];
                        $reports[$shift2->weekday]['weekendHour'] += $hour2['weekendHour'];
                        $reports[$shift2->weekday]['extraHour'] += $hour2['extraHour'];

                        $weekdayHours += $hour2['weekdayHour'];
                        $weekendHours += $hour2['weekendHour'];
                        $extraHours += $hour2['extraHour'];


                    }
                }

                $totalPay = 0.0;
                $weekdayPay = 0.0;
                $weekendPay = 0.0;
                $extraPay = 0.0;

                $reports['Monday']['weekdayPay'] = round($reports['Monday']['weekdayHour'] * $employee->weekday_wage, 2);
                $reports['Monday']['weekendPay'] = round($reports['Monday']['weekendHour'] * $employee->weekend_wage, 2);
                $reports['Monday']['extraPay'] = round($reports['Monday']['extraHour'] * $employee->extra_wage, 2);
                $reports['Monday']['totalPay'] = round($reports['Monday']['weekdayPay'] + $reports['Monday']['weekendPay'] + $reports['Monday']['extraPay'], 2);
                $weekdayPay += $reports['Monday']['weekdayPay'];
                $weekendPay += $reports['Monday']['weekendPay'];
                $extraPay += $reports['Monday']['extraPay'];
                $totalPay += $reports['Monday']['totalPay'];

                $reports['Tuesday']['weekdayPay'] = round($reports['Tuesday']['weekdayHour'] * $employee->weekday_wage, 2);
                $reports['Tuesday']['weekendPay'] = round($reports['Tuesday']['weekendHour'] * $employee->weekend_wage, 2);
                $reports['Tuesday']['extraPay'] = round($reports['Tuesday']['extraHour'] * $employee->extra_wage, 2);
                $reports['Tuesday']['totalPay'] = round($reports['Tuesday']['weekdayPay'] + $reports['Tuesday']['weekendPay'] + $reports['Tuesday']['extraPay'], 2);
                $weekdayPay += $reports['Tuesday']['weekdayPay'];
                $weekendPay += $reports['Tuesday']['weekendPay'];
                $extraPay += $reports['Tuesday']['extraPay'];
                $totalPay += $reports['Tuesday']['totalPay'];

                $reports['Wednesday']['weekdayPay'] = round($reports['Wednesday']['weekdayHour'] * $employee->weekday_wage, 2);
                $reports['Wednesday']['weekendPay'] = round($reports['Wednesday']['weekendHour'] * $employee->weekend_wage, 2);
                $reports['Wednesday']['extraPay'] = round($reports['Wednesday']['extraHour'] * $employee->extra_wage, 2);
                $reports['Wednesday']['totalPay'] = round($reports['Wednesday']['weekdayPay'] + $reports['Wednesday']['weekendPay'] + $reports['Wednesday']['extraPay'], 2);
                $weekdayPay += $reports['Wednesday']['weekdayPay'];
                $weekendPay += $reports['Wednesday']['weekendPay'];
                $extraPay += $reports['Wednesday']['extraPay'];
                $totalPay += $reports['Wednesday']['totalPay'];

                $reports['Thursday']['weekdayPay'] = round($reports['Thursday']['weekdayHour'] * $employee->weekday_wage, 2);
                $reports['Thursday']['weekendPay'] = round($reports['Thursday']['weekendHour'] * $employee->weekend_wage, 2);
                $reports['Thursday']['extraPay'] = round($reports['Thursday']['extraHour'] * $employee->extra_wage, 2);
                $reports['Thursday']['totalPay'] = round($reports['Thursday']['weekdayPay'] + $reports['Thursday']['weekendPay'] + $reports['Thursday']['extraPay'], 2);
                $weekdayPay += $reports['Thursday']['weekdayPay'];
                $weekendPay += $reports['Thursday']['weekendPay'];
                $extraPay += $reports['Thursday']['extraPay'];
                $totalPay += $reports['Thursday']['totalPay'];

                $reports['Friday']['weekdayPay'] = round($reports['Friday']['weekdayHour'] * $employee->weekday_wage, 2);
                $reports['Friday']['weekendPay'] = round($reports['Friday']['weekendHour'] * $employee->weekend_wage, 2);
                $reports['Friday']['extraPay'] = round($reports['Friday']['extraHour'] * $employee->extra_wage, 2);
                $reports['Friday']['totalPay'] = round($reports['Friday']['weekdayPay'] + $reports['Friday']['weekendPay'] + $reports['Friday']['extraPay'], 2);
                $weekdayPay += $reports['Friday']['weekdayPay'];
                $weekendPay += $reports['Friday']['weekendPay'];
                $extraPay += $reports['Friday']['extraPay'];
                $totalPay += $reports['Friday']['totalPay'];

                $reports['Saturday']['weekdayPay'] = round($reports['Saturday']['weekdayHour'] * $employee->weekday_wage, 2);
                $reports['Saturday']['weekendPay'] = round($reports['Saturday']['weekendHour'] * $employee->weekend_wage, 2);
                $reports['Saturday']['extraPay'] = round($reports['Saturday']['extraHour'] * $employee->extra_wage, 2);
                $reports['Saturday']['totalPay'] = round($reports['Saturday']['weekdayPay'] + $reports['Saturday']['weekendPay'] + $reports['Saturday']['extraPay'], 2);
                $weekdayPay += $reports['Saturday']['weekdayPay'];
                $weekendPay += $reports['Saturday']['weekendPay'];
                $extraPay += $reports['Saturday']['extraPay'];
                $totalPay += $reports['Saturday']['totalPay'];

                $reports['Sunday']['weekdayPay'] = $reports['Sunday']['weekdayHour'] * $employee->weekday_wage;
                $reports['Sunday']['weekendPay'] = round($reports['Sunday']['weekendHour'] * $employee->weekend_wage, 2);
                $reports['Sunday']['extraPay'] = round($reports['Sunday']['extraHour'] * $employee->extra_wage, 2);
                $reports['Sunday']['totalPay'] = round($reports['Sunday']['weekdayPay'] + $reports['Sunday']['weekendPay'] + $reports['Sunday']['extraPay'], 2);
                $weekdayPay += $reports['Sunday']['weekdayPay'];
                $weekendPay += $reports['Sunday']['weekendPay'];
                $extraPay += $reports['Sunday']['extraPay'];
                $totalPay += $reports['Sunday']['totalPay'];

                $totalHours = round($weekdayHours + $weekendHours + $extraHours, 2);
                $reports['weekdayHours'] = $weekdayHours;
                $reports['weekendHours'] = $weekendHours;
                $reports['extraHours'] = $extraHours;
                $reports['weekdayPay'] = $weekdayPay;
                $reports['weekendPay'] = $weekendPay;
                $reports['extraPay'] = $extraPay;
                $reports['totalPay'] = round($totalPay, 2);
                $reports['totalHours'] = $totalHours;
                $reports['totalHoursFormat'] = floor($totalHours) . ':' .
                    floor(($totalHours - floor($totalHours)) * 60);
            }

        }

        return view('reports.attendance2', ['stores' => $stores, 'title' => 'Attendance Report', 'employees' => $employees, 'start' => $startDate, 'reports' => $reports, 'end' => $endDate, 'selectedEmployee' => $employee]);
    }

    public function reportAttendance(Request $request)
    {
        if (Auth::user()->isSuperAdmin()) {
            $stores = Store::all();
            if ($request->has('store'))
                $employees = Employee::where('store_id', $request->store)->get();
            else
                $employees = Employee::all();
        } else {
            $stores = Store::find(Auth::user()->getStore());
            $employees = Employee::where([
                ['store_id', '=', Auth::user()->getStore()],
                ['department_id', '!=', Employee::ADMIN]
            ])
                ->get();
        }

        $employee = null;
        $start = Carbon::createFromFormat('d-m-Y', date('d-m-Y'))->startOfWeek();
        $end = Carbon::createFromFormat('d-m-Y', date('d-m-Y'))->endOfWeek();
        $hoursWork = array();
        $reports = array();
        if (count($request->all()) > 0 && $request->has('employee')) {
            $request->flash();
            $data = $request->all();
            $messages = [
                'employee.required' => 'Choose 1 Employee',
                'employee.integer' => 'Choose 1 employee',
            ];
            $validate = Validator::make($data, [
                'employee' => 'required|integer',
            ], $messages);
            if ($validate->fails()) {
                return redirect()->back()
                    ->with([
                        'employee' => $request->employee,
                        'employees' => $employees
                    ])
                    ->withErrors($validate)
                    ->withInput();
            }

            $start = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->startOfWeek();
            $end = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->endOfWeek();

            if ($request->has('start')) {
                $start = date('Y-m-d H:i:s', strtotime($request->start));
            }
            if ($request->has('end')) {
                $end = date('Y-m-d H:i:s', strtotime($request->end . ' ' . '23 hours 59 minutes 59 seconds'));
            }

            $employee = Employee::find($request->employee);
            if ($employee != null) {
                $totalHours = 0.0;
                $totalPay = 0.0;
                $employeeShifts = $employee->shifts()
                    ->where([
                        ['start', '>=', $start],
                        ['end', '<=', $end]
                    ])
                    ->get();
                $weekdayShifts = $employee->weekdayShifts()->get();
                $weekendShifts = $employee->weekendShifts()->get();
                $extraShifts = $employee->extraShifts()->get();
                $hoursWork['countWeekday'] = 0;
                $hoursWork['countWeekend'] = 0;
                $hoursWork['countExtra'] = 0;
                $hoursWork['countWeekdayWage'] = 0;
                $hoursWork['countWeekendWage'] = 0;
                $hoursWork['countExtraWage'] = 0;
                if (count($weekdayShifts) > 0) {
                    foreach ($employeeShifts as $k => $v) {
                        foreach ($weekdayShifts as $key => $value) {
                            if ($value->weekday == $v->weekday) {
                                $start = Helper::formatTime($v->start);
                                $end = Helper::formatTime($v->end);
                                $hour = Helper::checkTime($value->start, $value->end,
                                    $start, $end);
                                $wage = floatval(Helper::checkTime($value->start, $value->end,
                                        $start, $end)) * floatval($employee->weekday_wage);
                                $hoursWork[$v->weekday]['Weekday'] = $hour;

                                $hoursWork[$v->weekday]['WeekdayWage'] = $wage;

                            }
                        }
                    }
                }
                if (count($weekendShifts) > 0) {
                    foreach ($employeeShifts as $k => $v) {
                        foreach ($weekendShifts as $key => $value) {
                            if ($value->weekday == $v->weekday) {
                                $start = Helper::formatTime($v->start);
                                $end = Helper::formatTime($v->end);
                                $hour = Helper::checkTime($value->start, $value->end,
                                    $start, $end);
                                $wage = floatval(Helper::checkTime($value->start, $value->end,
                                        $start, $end)) * floatval($employee->weekend_wage);
                                $hoursWork[$v->weekday]['Weekend'] = $hour;

                                $hoursWork[$v->weekday]['WeekendWage'] = $wage;


                            }
                        }

                    }
                }
                if (count($extraShifts) > 0) {
                    foreach ($employeeShifts as $k => $v) {
                        foreach ($extraShifts as $key => $value) {
                            if ($value->weekday == $v->weekday) {
                                $start = Helper::formatTime($v->start);
                                $end = Helper::formatTime($v->end);
                                $hour = Helper::checkTime($value->start, $value->end,
                                    $start, $end);
                                $wage = floatval(Helper::checkTime($value->start, $value->end,
                                        $start, $end)) * floatval($employee->extra_wage);
                                $hoursWork[$v->weekday]['Extra'] = $hour;

                                $hoursWork[$v->weekday]['ExtraWage'] = $wage;

                            }
                        }
                    }
                }
                foreach ($employeeShifts as $key => $value) {
                    $hours = Helper::getDuration($value->start, $value->end);
                    $totalHours += $hours;
                    $pay = $hours * $employee->weekday_wage;
                    $totalPay += $pay;
                    $reports[$value->weekday] = (object)array(
                        'start' => $value->start,
                        'end' => $value->end,
                        'rate' => $employee->weekday_wage,
                        'hours' => $hours,
                        'pay' => $pay
                    );
                }
                $reports['totalPay'] = $totalPay;
                $reports['totalHours'] = $totalHours;
                $reports['totalHoursFormat'] = floor($totalHours) . ':' .
                    floor(($totalHours - floor($totalHours)) * 60);
            }

        }
        return view('reports.attendance', ['stores' => $stores, 'title' => 'Attendance Report', 'employees' => $employees, 'start' => $start, 'hourWork' => $hoursWork,
            'reports' => $reports, 'end' => $end, 'selectedEmployee' => $employee]);
    }

    public function reportWageCost(Request $request)
    {
        $employeesWageCosts = array();
        $request->flash();
        $data = $request->all();
        $storeName = '';
        $start = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->startOfWeek();
        $end = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->endOfWeek();

        if (count($request->all())) {
            $messages = [
                'store.required' => 'Choose 1 Store',
                'store.integer' => 'Choose 1 Store',
            ];

            $validate = Validator::make($data, [
                'store' => 'required|integer',
            ], $messages);
            if ($validate->fails()) {
                return redirect('report/wage-cost')->withErrors($validate)->withInput();
            }

            if ($request->has('start')) {
                $start = date('Y-m-d H:i:s', strtotime($request->start));
            }
            if ($request->has('end')) {
                $end = date('Y-m-d H:i:s', strtotime($request->end . ' ' . '23 hours 59 minutes 59 seconds'));
            }

            $storeName = Store::find($request->store)->address;
            $employeesShifts = array();
            if (Auth::user()->isSuperAdmin()) {
                if ($request->has('department')) {
                    $employees = Employee::where([
                        ['store_id', $request->store],
                        ['department_id', $request->department]
                    ])->get();
                } else {
                    $employees = Employee::where('store_id', $request->store)->get();
                }

                $stores = Store::all();
                $departments = Department::all();

            } else {
                if ($request->has('department')) {
                    $employees = Employee::where([
                        ['store_id', Auth::user()->getStore()],
                        ['department_id', $request->department]
                    ])->get();
                } else {
                    $employees = Employee::where([
                        ['store_id', Auth::user()->getStore()],
                        ['department_id', '!=', Employee::ADMIN]
                    ])->get();
                }
                $stores = Store::where('id', Auth::user()->getStore())->get();
                $departments = Department::where('id', Auth::user()->getDepartment())->get();
            }

            foreach ($employees as $key => $employee) {
                $employeesShifts[$employee->id] = $employee->shifts()
                    ->where([['start', '>=', $start],
                        ['start', '<=', $end]
                    ])->get();
            }

            $employeesWageCosts = array();
            foreach ($employeesShifts as $key => $shifts) {
                $salary = $this->calculateSalary($key, $shifts);
                if ($salary != null) {
                    $paymentDateNumber = Employee::find($key)->payment_date;
                    $paymentDate = date('d-m-Y', strtotime($end . '+' . $paymentDateNumber . ' days'));
                    $salary->paymentDate = $paymentDate;
                    $employeesWageCosts[$key] = $salary;
                }
            }
        } else {
            if (Auth::user()->isSuperAdmin()) {
                $employees = Employee::where('store_id', $request->store)->get();
                $stores = Store::all();
                $departments = Department::all();
            } else {
                $employees = Employee::where('store_id', Auth::user()->getStore())->get();
                $stores = Store::where('id', Auth::user()->getStore())->get();
                $departments = Department::where('id', Auth::user()->getDepartment())->get();
            }
        }
        return view('reports.wage-cost', ['stores' => $stores, 'title' => 'Wage Cost',
            'storeName' => $storeName, 'start' => $start, 'end' => $end,
            'departments' => $departments,
            'employeesWageCosts' => $employeesWageCosts]);
    }

    public function reportWageCost2(Request $request)
    {
        $employeesWageCosts = array();
        $request->flash();
        $data = $request->all();
        $storeName = '';
        $start = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->startOfWeek();
        $end = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->endOfWeek();

        if (count($request->all())) {
//            $messages = [
//                'store.required' => 'Choose 1 Store',
//                'store.integer' => 'Choose 1 Store',
//            ];
//
//            $validate = Validator::make($data, [
//                'store' => 'required|integer',
//            ], $messages);
//            if ($validate->fails()) {
//                return redirect('report/wage-cost')->withErrors($validate)->withInput();
//            }

            if ($request->has('start')) {
                $start = date('Y-m-d H:i:s', strtotime($request->start));
            }
            if ($request->has('end')) {
                $end = date('Y-m-d H:i:s', strtotime($request->end . ' ' . '23 hours 59 minutes 59 seconds'));
            }

            $employeesShifts = array();
            if (Auth::user()->isSuperAdmin()) {

                $employees = Employee::orderBy('firstname')->get();;
                $stores = Store::all();
                $departments = Department::all();

            } else {

                $employees = Employee::where([
                    ['store_id', Auth::user()->getStore()],
                    ['department_id', '!=', Employee::ADMIN]
                ])->get();

                $stores = Store::where('id', Auth::user()->getStore())->get();
                $departments = Department::where('id', Auth::user()->getDepartment())->get();
            }

            foreach ($employees as $key => $employee) {
                $shiftTemp = Shift::where([
                    ['start', '>=', $start],
                    ['start', '<=', $end],
                    ['store_id', $request->store],
                    ['employee_id', $employee->id]
                ])->get();
                if(count($shiftTemp) > 0)
                    $employeesShifts[$employee->id] = $shiftTemp;
            }

            $employeesWageCosts = array();
            foreach ($employeesShifts as $key => $shifts) {
                $salary = $this->calculateSalary($key, $shifts);
                if ($salary != null) {
                    $paymentDateNumber = Employee::find($key)->payment_date;
                    $paymentDate = date('d-m-Y', strtotime($end . '+' . $paymentDateNumber . ' days'));
                    $salary->paymentDate = $paymentDate;
                    $employeesWageCosts[$key] = $salary;
                }
            }
        } else {
            if (Auth::user()->isSuperAdmin()) {
                $stores = Store::all();
                $departments = Department::all();
            } else {
                $stores = Store::where('id', Auth::user()->getStore())->get();
                $departments = Department::where('id', Auth::user()->getDepartment())->get();
            }
        }
        return view('reports.wage-cost2', ['stores' => $stores, 'title' => 'Wage Cost',
            'storeName' => $storeName, 'start' => $start, 'end' => $end,
            'departments' => $departments,
            'employeesWageCosts' => $employeesWageCosts]);
    }

    public function reportWageCost3(Request $request)
    {
        $employeesWageCosts = array();
        $request->flash();
        $storeName = '';
        $start = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->startOfWeek();
        $end = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->endOfWeek();
//        $storeArray = array();
        if (count($request->all())) {

            if ($request->has('start')) {
                $start = date('Y-m-d H:i:s', strtotime($request->start));
            }
            if ($request->has('end')) {
                $end = date('Y-m-d H:i:s', strtotime($request->end . ' ' . '23 hours 59 minutes 59 seconds'));
            }

            $employeesShifts = array();
            if (Auth::user()->isSuperAdmin()) {
                $employees = Employee::orderBy('firstname')->get();;
                $stores = Store::all();
                $departments = Department::all();
            }

            foreach ($employees as $key => $employee) {
                $shiftTemp = Shift::where([
                    ['start', '>=', $start],
                    ['start', '<=', $end],
                    ['employee_id', $employee->id]
                ])->get();
                if(count($shiftTemp) > 0)
                    $employeesShifts[$employee->id] = $shiftTemp;
            }

            $employeesWageCosts = array();

            foreach ($employeesShifts as $key => $shifts) {
                $salary = $this->calculateSalary($key, $shifts);
                if ($salary != null) {
                    $paymentDateNumber = Employee::find($key)->payment_date;
                    $paymentDate = date('d-m-Y', strtotime($end . '+' . $paymentDateNumber . ' days'));
                    $salary->paymentDate = $paymentDate;
                    $employeesWageCosts[$key] = $salary;
//                    $storeArray[$key] = $address = $shifts->store->address;
                }
            }
        } else {
            if (Auth::user()->isSuperAdmin()) {
                $stores = Store::all();
                $departments = Department::all();
            } else {
                $stores = Store::where('id', Auth::user()->getStore())->get();
                $departments = Department::where('id', Auth::user()->getDepartment())->get();
            }
        }
        return view('reports.wage-cost3', ['stores' => $stores, 'title' => 'Wage Cost',
            'storeName' => $storeName, 'start' => $start, 'end' => $end,
            'departments' => $departments,
//            'storeArray' => $storeArray,
            'employeesWageCosts' => $employeesWageCosts]);
    }

    public function check(Request $request)
    {
        if (Auth::user()->isSuperAdmin()) {
            $stores = Store::all();
        } else {
            $stores = Store::where('id', Auth::user()->getStore())->get();
        }
        $date = [];
        $report = [];
        $getStore = '';
        $employee = [];
        $countReport = [];
        if ($request->store && $request->store != '' && $request->fromDate && $request->fromDate != '') {
            $getStore = $request->store;
            $employee = Store::find($request->store)->employees()->get();
            $start = Carbon::createFromFormat('Y-m-d', $request->fromDate)->startOfWeek();
            $end = Carbon::createFromFormat('Y-m-d', $request->fromDate)->endOfWeek();
            $date = [$start->format('Y-m-d')];
            for ($i = 1; $i <= 6; $i++) {
                $date[] = $start->addDay()->format('Y-m-d');
            }
            $monday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[0]]
            ])->get();
            $tuesday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[1]]
            ])->get();
            $wednesday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[2]]
            ])->get();
            $thursday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[3]]
            ])->get();
            $friday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[4]]
            ])->get();
            $saturday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[5]]
            ])->get();
            $sunday = Roster::where([
                ['store_id', $request->store],
                ['date', $date[6]]
            ])->get();
            $limit = max(count($monday), count($tuesday), count($wednesday), count($thursday), count($friday), count($saturday), count($sunday));
            for ($i = 0; $i < $limit; $i++) {
                if (isset($monday[$i])) {
                    $data = Roster::find($monday[$i]->id)->employee()->first();
//                    return $dataMonday;
                    $report[$i]['monday']['Id'] = $monday[$i]->id;
                    $report[$i]['monday']['storeId'] = $monday[$i]->store_id;
                    $report[$i]['monday']['start'] = $monday[$i]->start;
                    $report[$i]['monday']['end'] = $monday[$i]->end;
                    $report[$i]['monday']['employeeId'] = $data->id;
                    $report[$i]['monday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
                if (isset($tuesday[$i])) {
                    $data = Roster::find($tuesday[$i]->id)->employee()->first();
//                    return $dataMonday;
                    $report[$i]['tuesday']['Id'] = $tuesday[$i]->id;
                    $report[$i]['tuesday']['storeId'] = $monday[$i]->store_id;
                    $report[$i]['tuesday']['start'] = $tuesday[$i]->start;
                    $report[$i]['tuesday']['end'] = $tuesday[$i]->end;
                    $report[$i]['tuesday']['employeeId'] = $data->id;
                    $report[$i]['tuesday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
                if (isset($wednesday[$i])) {
                    $data = Roster::find($wednesday[$i]->id)->employee()->first();
//                    return $dataMonday;
                    $report[$i]['wednesday']['Id'] = $wednesday[$i]->id;
                    $report[$i]['wednesday']['storeId'] = $monday[$i]->store_id;
                    $report[$i]['wednesday']['start'] = $wednesday[$i]->start;
                    $report[$i]['wednesday']['end'] = $wednesday[$i]->end;
                    $report[$i]['wednesday']['employeeId'] = $data->id;
                    $report[$i]['wednesday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
                if (isset($thursday[$i])) {
                    $data = Roster::find($thursday[$i]->id)->employee()->first();
//                    return $dataMonday;
                    $report[$i]['thursday']['Id'] = $thursday[$i]->id;
                    $report[$i]['thursday']['storeId'] = $monday[$i]->store_id;
                    $report[$i]['thursday']['start'] = $thursday[$i]->start;
                    $report[$i]['thursday']['end'] = $thursday[$i]->end;
                    $report[$i]['thursday']['employeeId'] = $data->id;
                    $report[$i]['thursday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
                if (isset($friday[$i])) {
                    $data = Roster::find($friday[$i]->id)->employee()->first();
//                    return $dataMonday;
                    $report[$i]['friday']['Id'] = $friday[$i]->id;
                    $report[$i]['friday']['storeId'] = $monday[$i]->store_id;
                    $report[$i]['friday']['start'] = $friday[$i]->start;
                    $report[$i]['friday']['end'] = $friday[$i]->end;
                    $report[$i]['friday']['employeeId'] = $data->id;
                    $report[$i]['friday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
                if (isset($saturday[$i])) {
                    $data = Roster::find($saturday[$i]->id)->employee()->first();
//                    return $dataMonday;
                    $report[$i]['saturday']['Id'] = $saturday[$i]->id;
                    $report[$i]['saturday']['storeId'] = $monday[$i]->store_id;
                    $report[$i]['saturday']['start'] = $saturday[$i]->start;
                    $report[$i]['saturday']['end'] = $saturday[$i]->end;
                    $report[$i]['saturday']['employeeId'] = $data->id;
                    $report[$i]['saturday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
                if (isset($sunday[$i])) {
                    $data = Roster::find($sunday[$i]->id)->employee()->first();
//                    return $dataMonday;
                    $report[$i]['sunday']['Id'] = $sunday[$i]->id;
                    $report[$i]['sunday']['storeId'] = $monday[$i]->store_id;
                    $report[$i]['sunday']['start'] = $sunday[$i]->start;
                    $report[$i]['sunday']['end'] = $sunday[$i]->end;
                    $report[$i]['sunday']['employeeId'] = $data->id;
                    $report[$i]['sunday']['employeeName'] = $data->firstname . ' ' . $data->lastname;

                }
            }
            foreach ($employee as $Key => $val) {
                $count = 0;
                foreach ($report as $k => $v) {
                    foreach ($v as $c) {
                        if ($c['employeeId'] == $val->id) {
                            $count += Helper::getDuration($c['start'], $c['end']);
                        }
                    }
                }
                $countReport[] = ['name' => $val->firstname . ' ' . $val->lastname, 'count' => $count];
            }

        }

        return view('reports.roster-check', ['stores' => $stores, 'day' => $date, 'report' => $report, 'getStore' => $getStore,
            'employee' => $employee, 'countReport' => $countReport]);
    }

    public function postcheck(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'end' => 'required|date_format:H:i',
            'start' => 'required|date_format:H:i',
            'employee_id' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()->all()], 400);
        }
        if (Helper::getDuration($request->start, $request->end) < 0) {
            return response()->json(['error' => ['Start time should not be less than the end time']], 400);
        }

        if ($request->id > 0) {
            $data = Roster::find($request->id);
            $data->update([
                'end' => $request->end,
                'start' => $request->start,
                'employee_id' => $request->employee_id
            ]);
            return 'ok';
        }
        $roster = new Roster();
        $roster->weekday = $request->weekday;
        $roster->day = $request->day;
        $roster->start = $request->start;
        $roster->end = $request->end;
        $roster->store_id = $request->store_id;
        $roster->employee_id = $request->employee_id;
        $roster->save();
        return 'ok';
    }

}

?>