<?php

namespace App\Http\Controllers;

use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $reports = Cache::remember('reports.week', 0, function () {
            return Report::orderBy('created_at', 'desc')->take(168)->get()->reverse();
        });

        $labels = '"' . $reports->map(function ($item) {
            return $item->created_at->toDayDateTimeString();
        })->implode('", "') . '"';

        return view('home', [
            'labels'    => $labels,
            'guilds'    => $this->buildGraphData($reports, 'guilds'),
            'channels'  => $this->buildGraphData($reports, 'channels'),
            'users'     => $this->buildGraphData($reports, 'users'),
            'status'    => $this->buildStatus()
        ]);
    }

    public function buildStatus()
    {
        $dbStatus = DB::table('shards')->get();
        $offline = $dbStatus->filter(function ($item) {
            return Carbon::parse($item->updated_at)->addMinutes(2)->isPast();
        });

        if ($offline->isEmpty()) {
            return [
                'css' => 'success',
                'txt' => 'All Shards Operational',
                'ref' => Carbon::parse($dbStatus->first()->updated_at)->subHours(2)->diffInSeconds()
            ];
        }

        if ($dbStatus->count() === $offline->count()) {
            return [
                'css' => 'danger',
                'txt' => 'All Shards are down and not responding',
                'ref' => Carbon::parse($dbStatus->first()->updated_at)->subHours(2)->diffInSeconds()
            ];
        }

        $ids = $offline->pluck('count')->implode(', ');

        return [
            'css' => 'warning',
            'txt' => "Shard ID ${ids} are not responding or are slow",
            'ref' => Carbon::parse($dbStatus->filter(function ($item) use ($offline) {
                return ! $offline->pluck('count')->contains($item->count);
            })->first()->updated_at)->subHours(2)->diffInSeconds()
        ];
    }

    protected function buildGraphData($reports, $name)
    {
        return [
            'name' => $name,
            'data' => $reports->implode($name, ', ')
        ];
    }
}
