<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Wilaya;
use Carbon\Carbon;
use Hash;
use App\Setting;
use App\Categorie;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use lepiaf\SerialPort\SerialPort;
use lepiaf\SerialPort\Parser\SeparatorParser;
use lepiaf\SerialPort\Configure\TTYConfigure;

class SettingController extends Controller
{
    public function index()
    {
        $serialPort = new SerialPort(new SeparatorParser(), new TTYConfigure());
        $portcom = 3;
        $connexion = 1;

        try {
            $serialPort->open("COM".$portcom);
        } catch (\Throwable $th) {
            if($th->getMessage() == "fopen(COM".$portcom."): failed to open stream: Permission denied"){
                $connexion = 1;
            }else{
                $connexion = 0;

            }
        }
        $settings = Setting::all();
        return view('settings.index',compact('settings','connexion'));
    }

    public function check(Request $request)
    {
        // exec('pm2 stop index');
        // exec('pm2 start reboot');
        // exec('pm2 start index');
        $serialPort = new SerialPort(new SeparatorParser(), new TTYConfigure());
        $portcom = 3;
        $connexion = 1;
        try {
            $serialPort->open("COM".$portcom);
        } catch (\Throwable $th) {
            if($th->getMessage() == "fopen(COM".$portcom."): failed to open stream: Permission denied"){

                return response()->json(['connexion' => 1]);    
            }else{
                return response()->json(['connexion' => 0]);    
            }
        }

    }

    public function open()
    {
        $serialPort = new SerialPort(new SeparatorParser(), new TTYConfigure());
        $portcom = 3;
        $connexion = 1;
        try {
            exec('pm2 stop all');
            $serialPort->open("COM".$portcom);
            $serialPort->write("70000");
            $serialPort->close();
            exec('pm2 restart index');

        } catch (\Throwable $th) {
            return redirect()->route('setting.index')->with('error', $th->getMessage());        
        }

        return redirect()->route('setting.index')->with('success', 'Success ');        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Setting::setSetting('titre',$request['titre']);
        Setting::setSetting('addresse',$request['addresse']);
        Setting::setSetting('telephone',$request['telephone']);
        // Setting::setSetting('logo',$request['logo']);
        if($request->file('logo')){
            $logo = $request->file('logo')->store('/logos');
            Setting::setSetting('logo',$logo);
        }    
    
        // Setting::setSetting('username',$request['username']);
        // Setting::setSetting('password',$request['password']);
        return redirect()->route('setting.index')->with('success', 'Success ');        
    }

    public function show($id_setting)

    {
        $setting = Setting::find($id_setting);
        return view('settings.view',compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$setting_id)
    {
        $setting = Setting::find($setting_id);  
        $setting->determination = $request['determination'];
        $setting->duree = $request['duree'];
        $setting->aspect = $request['aspect'];
        $setting->save();
        
        return redirect()->route('setting.index')->with('success', 'reservation ins??r?? avec succ??s ');   
    }

    public function destroy($id_setting)
    {
        $setting = Setting::find($id_setting);
        $setting->delete();
        return redirect()->route('setting.index')->with('success', 'le Setting a ??t?? supprim?? ');        
    }


    public function backup()
    {

        exec('php C:\wamp64\www\gymaccess\artisan backup:run --only-db');   
        return redirect()->route('setting.index')->with('success', 'Sauvgarde Termin??');   
    
    }


}
