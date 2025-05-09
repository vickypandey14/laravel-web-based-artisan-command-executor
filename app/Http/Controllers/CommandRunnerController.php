<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use App\Models\CommandLog;
use Illuminate\Http\Request;

class CommandRunnerController extends Controller
{
    public function indexCommandRunner()
    {
        $logs = CommandLog::latest()->take(10)->get();

        $commonCommands = [
            'make:model ExampleModel -mcr',
            'make:controller ExampleController --resource',
            'make:middleware ExampleMiddleware',
            'make:seeder ExampleSeeder',
            'make:factory ExampleFactory',
            'make:migration create_example_table',
            'make:command CustomCommand',
            'migrate',
            'migrate:fresh --seed',
            'db:seed --class=ExampleSeeder',
            'route:list',
            'cache:clear',
            'config:cache',
            'view:clear',
            'optimize:clear',
            'storage:link',
            'queue:work',
            'make:policy ExamplePolicy --model=ExampleModel',
            'make:request ExampleRequest',
            'make:event ExampleEvent',
            'make:listener ExampleListener --event=ExampleEvent',
            'make:job ExampleJob',
        ];

        return view('command-runner.index', compact('logs', 'commonCommands'));
    }

    public function runCommandRunner(Request $request)
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

    public function clearHistory(Request $request)
    {
        \App\Models\CommandLog::truncate();
        return response()->json(['message' => 'History cleared successfully']);
    }
}
