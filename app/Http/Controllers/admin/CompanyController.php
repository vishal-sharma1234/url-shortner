<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyInvitation;
use App\Models\Url;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class CompanyController extends Controller
{

    public function index(Request $request)
    {

        if (!auth()->user()->hasRole('SuperAdmin')) {

            return redirect()->back()->with('error', 'Can not invite super admin!');            
        }

        if ($request->isMethod('post')) {

            $request->validate([
                'name' => 'required',
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Company::class],
            ]);


            $clientUser = User::where('email', $request->email)->first();

            if ($clientUser) {

                if ($clientUser->company_invitation_id) {

                    return redirect()->route('auth.index')->with('error', 'Already invited!');
                }

                $client = new CompanyInvitation();

                $client->name = $request->name;

                $client->email = $request->email;

                $client->user_id = $clientUser->id;

                $client->invited_by = auth()->id();

                $client->save();


                $clientUser->company_invitation_id = $client->id;

                $clientUser->save();


                $clientUser->assignRole('Admin');

                return  redirect()->route('auth.index')->with('success', 'Invited successfully!');
                // redirect()->back()->with('success', 'Invited successfully!');

            } else {

                return redirect()->back()->with('error', 'Undefined email!');
            }
        }

        return view('admin.invite_company');
    }
}
