<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Madnest\Madzipper\Facades\Madzipper;
use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingsController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('Defaults')) {
            abort(403);
        }

        return view('settings.index');
    }

    function defaults(Request $request){
        $settings = Settings::all();

        return view('settings.defaults', compact('settings'));
    }

    function saveSettings(Request $request){
        $data = $request->all();

        foreach ($data as $k => $d){
            Settings::where('code', $k)->update(['description' => $d]);
        }

        return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Default settings successfully updated!"];
    }

    function backupBD(){
		$user = env('DB_USERNAME');
    	$password = env('DB_PASSWORD');
    	$host = env('DB_HOST');
    	$db = env('DB_DATABASE');
    	$sqldumppath = env('MYSQLDUMP_PATH');

    	$filename = "backup " .Carbon::now()->format('Y-m-d'). ".sql";
        $storagepath = Storage::disk('db')->path('');
		$command = $sqldumppath. ' -u' .$user. ' -h' .$host. ' ' .$db. ' > "' .$storagepath.$filename. '" 2>&1';

  		exec($command, $output, $result);
  		return response()->download(public_path('backupdb/'.$filename));
    }

    public function backupFiles(){
    	$filename = "Backup Files " .Carbon::now()->format('Y-m-d'). ".zip";
    	$files = Storage::disk('local')->path('');

        Madzipper::make(public_path($filename))->add($files)->close();
        return response()->download(public_path($filename))->deleteFileAfterSend(true);
	}
}
