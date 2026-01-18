<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Url;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;


class UrlController extends Controller
{

    public function index(Request $request)
    {

        if (auth()->user()->hasRole('SuperAdmin')) {

            return  redirect()->route('auth.index')->with('error', 'Super Admin can\'nt generate url!');
        }

        if ($request->isMethod('post')) {

            $request->validate([
                'url' => ['required', 'url'],
            ]);

            $url = new Url();
            $code = Str::random(6);
            $url->original_url = $request->url;
            $url->url = $code;
            $url->user_id = auth()->user()->id;
            $url->company_invitation_id = auth()->user()->company_invitation_id;
            $url->save();

            return  redirect()->route('auth.index')->with('success', 'Url Created Successfully!');
        }


        return view('admin.generate_url');
    }

    public function hitUrl($url)
    {
        $url = Url::where('url', $url)->firstOrFail();
        $url->increment('hits');

        return redirect($url->original_url);
    }
}
