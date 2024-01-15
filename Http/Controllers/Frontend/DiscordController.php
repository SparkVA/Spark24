<?php

namespace Modules\Spark24\Http\Controllers\Frontend;

use App\Contracts\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

// https://discord.com/api/oauth2/authorize?client_id=994863946681028698&response_type=code&redirect_uri=http%3A%2F%2Fspk-phpvms-24.test%2Fspark24%2Fdiscord%2Foauth&scope=identify+email
/**
 * Class $CLASS$
 * @package
 */
class DiscordController extends Controller
{
    public string $access_token;
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function login(Request $request)
    {
        $client = new Client();
        $client_id = env('SPARK24_DISCORD_CLIENT_ID');
        $secret_id = env('SPARK24_DISCORD_SECRET_ID');
        $redirect_url = "http://spk-phpvms-24.test/spark24/discord/oauth";
        $res = $client->request('post', 'https://discord.com/api/oauth2/token', [
            'form_params' => [
                "client_id" => '994863946681028698',
                "client_secret" => 'Hd9LjwiFNYmNF-kVRtGCJ5_qC-hUEUbP',
                "grant_type" => "authorization_code",
                "code" => $request->get('code'),
                "redirect_uri" => $redirect_url
            ]])->getBody();
        $response = json_decode($res, true);

        //dd($response);
        $user = Http::withHeader('Authorization', 'Bearer '.$response['access_token'])->get('https://discord.com/api/users/@me')->json();
        //dd($user);
        return redirect()->back()->with('discord_id',$user['id']);

    }
    public function unlink() {
        Auth::user()->update(['discord_id' => ""]);
        return redirect()->back();
    }


}
