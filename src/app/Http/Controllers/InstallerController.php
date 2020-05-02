<?php 
namespace DGvai\Larataller\LaraController;

use DGvai\Larataller\Helpers\Environment;
use DGvai\Larataller\Helpers\Requirements;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use DB;

class InstallerController extends Controller 
{
    public $phpVersionInfo = [];
    public $phpExtensions = [];
    public $apacheMods = [];
    public $support = false;
    public $symlink = null;

    public function __construct(Requirements $requirements)
    {
        $this->phpVersionInfo = $requirements->checkPHPversion(config('larataller.php.min'));
        $this->phpExtensions = $requirements->checkPHPExts(config('larataller.php.exts'));
        $this->apacheMods = $requirements->checkApacheMod(config('larataller.apache.mods'));
        $this->support = $requirements->validateSupport($this->phpVersionInfo, $this->phpExtensions, $this->apacheMods);
        $this->symlink = $requirements->checkSymLink();
    }

    public function begin()
    {
        return view('larataller::begin',[
            'phpVersionInfo' =>  $this->phpVersionInfo,
            'phpExtensions' => $this->phpExtensions,
            'apacheMods' => $this->apacheMods,
            'supported' => $this->support,
            'symlink' => $this->symlink,
        ]);
    }

    public function appdata()
    {
        return view('larataller::appdata');
    }

    public function database()
    {
        return view('larataller::database');
    }

    public function migration()
    {
        Artisan::call('migrate');
        return redirect()->route('installer.extra');
    }

    public function uploaddb()
    {
        DB::unprepared(file_get_contents(public_path('install/'.config('larataller.sql'))));
        return redirect()->route('installer.extra');
    }

    public function extra()
    {
        $extras = config('larataller.extra');
        return view('larataller::extra',['extras' => $extras]);
    }

    public function saveAppdata(Request $request)
    {
        $save = Environment::save($request->except('_token'));
        if($save)
        {
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            return redirect()->route('installer.database');
        }
    }

    public function saveDatabase(Request $request)
    {
        $save = Environment::save($request->except('_token'));
        if($save)
        {
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            return config('larataller.migration') 
                ?  redirect()->route('installer.migration')
                :  redirect()->route('installer.uploaddb');
        }
    }

    public function saveExtra(Request $request)
    {
        $save = Environment::save($request->except('_token'));
        if($save)
        {
            Environment::append('LARATALLER_INSTALLED','true');
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            return redirect()->route(config('larataller.redirect'));
        }
    }
}