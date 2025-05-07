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
            'make:model ExampleModel -mcr',                          // Model with migration, controller, resource
            'make:controller ExampleController --resource',          // Resource Controller
            'make:middleware ExampleMiddleware',                     // Middleware
            'make:seeder ExampleSeeder',                             // Seeder
            'make:factory ExampleFactory',                           // Factory
            'make:migration create_example_table',                   // Custom migration
            'make:command CustomCommand',                            // Custom Artisan command
            'migrate',                                               // Run migrations
            'migrate:fresh --seed',                                  // Drop all tables, migrate, and seed
            'db:seed --class=ExampleSeeder',                         // Seed specific seeder
            'route:list',                                            // Show all routes
            'cache:clear',                                           // Clear application cache
            'config:cache',                                          // Rebuild config cache
            'view:clear',                                            // Clear compiled views
            'optimize:clear',                                        // Clear various caches
            'storage:link',                                          // Create symbolic link for storage
            'queue:work',                                            // Start queue worker
            'make:policy ExamplePolicy --model=ExampleModel',        // Create policy for a model
            'make:request ExampleRequest',                           // Form request class
            'make:event ExampleEvent',                               // Event class
            'make:listener ExampleListener --event=ExampleEvent',    // Listener for an event
            'make:job ExampleJob',                                   // Queue job
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
