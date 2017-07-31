<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $reports = Cache::remember('reports.week', 10, function () {
            return Report::orderBy('created_at', 'desc')->take(24)->get()->reverse();
        });

        $labels = '"' . $reports->map(function ($item) {
            return $item->created_at->hour . ':00';
        })->implode('", "') . '"';

        return view('home', [
            'labels'    => $labels,
            'guilds'    => $this->buildGraphData($reports, 'guilds'),
            'channels'  => $this->buildGraphData($reports, 'channels'),
            'users'     => $this->buildGraphData($reports, 'users')
        ]);
    }

    protected function buildGraphData($reports, $name)
    {
        return [
            'name' => $name,
            'data' => $reports->implode($name, ', ')
        ];
    }
}
