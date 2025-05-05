<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use App\Models\CommandLog;
use Illuminate\Http\Request;

class CommandRunnerController extends Controller
{
    public function index()
    {
        $logs = CommandLog::latest()->take(10)->get();

        $commonCommands = [
            'make:model ExampleModel -mcr',
            'make:controller ExampleController --resource',
            'make:middleware ExampleMiddleware',
            'make:seeder ExampleSeeder',
            'make:factory ExampleFactory',
        ];

        return view('command-runner.index', compact('logs', 'commonCommands'));
    }

    public function run(Request $request)
    {
        $request->validate([
            'command' => 'required|string'
        ]);

        try {
            Artisan::call($request->command);
            $output = Artisan::output();

            CommandLog::create([
                'command' => $request->command,
                'output' => $output,
            ]);

        } catch (\Exception $e) {
            $output = 'Error: ' . $e->getMessage();
        }

        return redirect()->route('command-runner.index')->with('output', $output);
    }
}
