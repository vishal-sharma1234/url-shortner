<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Url;
use App\Models\User;
use App\Models\UserInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;


class UserController extends Controller
{

    public function index(Request $request)
    {

        // dd(auth()->user());

        return view('admin.dashboard');
    }

    public function companies(Request $request)
    {

        if ($request->ajax()) {
            return DataTables::of(Company::query())
                ->addIndexColumn()
                ->editColumn('users', function ($data) {
                    return $data->users->count();
                })
                ->editColumn('hits', function ($data) {
                    return $data->urls->sum('hits');
                })
                ->editColumn('total_genrated_url', function ($data) {
                    return $data->urls->count();
                })
                ->rawColumns(['users', 'total_genrated_url', 'hits'])
                ->make(true);
        }
    }

    public function urls(Request $request)
    {


        if ($request->ajax()) {

            $user = auth()->user();
            $query = Url::where('user_id', $user->id);

            if ($user->hasRole('SuperAdmin') || $user->hasRole('Admin')) {

                if ($user->company_invitation_id) {

                    $query = Url::where('company_invitation_id', $user->company_invitation_id);
                } else {
                    $query = Url::query();
                }
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('user_id', function ($data) {
                    return "($data->user_id) " . $data->user->name;
                })
                ->editColumn('url', function ($data) {
                    return url('s/' . $data->url);
                })
                ->editColumn('company_invitation_id', function ($data) {
                    return  $data->client->name;
                })
                ->editColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->format('d M y');
                })
                ->rawColumns(['user_id', 'company_invitation_id', 'created_at'])
                ->make(true);
        }
    }

    public function members(Request $request)
    {
        if ($request->ajax()) {


            $user = auth()->user();
            $query = User::role(['Member', 'Admin'])->where('company_invitation_id', $user->company_invitation_id);



            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('total_genrated_url', function ($data) {
                    return $data->urls->count();
                })
                ->editColumn('role', function ($data) {
                    return $data->getRoleNames()->first();
                })
                ->editColumn('hits', function ($data) {
                    return $data->urls->sum('hits');
                })
                ->rawColumns(['users', 'total_genrated_url', 'hits'])
                ->make(true);
        }
    }
    public function inviteUser(Request $request)
    {

        if ($request->isMethod('post')) {

            $request->validate([
                'name' => 'required',
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Company::class],
                'role' => 'required',
            ]);


            $clientUser = User::where('email', $request->email)->first();

            if ($clientUser->hasRole('SuperAdmin')) {

                return redirect()->back()->with('error', 'Can not invite super admin!');
            }


            if ($clientUser) {

                if ($clientUser->company_invitation_id) {

                    return redirect()->route('auth.index')->with('error', 'Already invited!');
                }

                $client = new UserInvitation();

                $client->name = $request->name;

                $client->email = $request->email;

                $client->user_id = $clientUser->id;

                $client->role = $request->role;

                $client->invited_by = auth()->id();

                $client->token = Str::uuid();

                $client->company_invitation_id = auth()->user()->company_invitation_id;

                $client->save();

                $clientUser->company_invitation_id = auth()->user()->company_invitation_id;

                $clientUser->save();

                $clientUser->assignRole($request->role);

                return redirect()->route('auth.index')->with('success', 'Invited successfully!');
            } else {

                return redirect()->back()->with('error', 'Undefined email!');
            }
        }

        $roles = Role::where('name', '!=', 'SuperAdmin')->get();

        return view('admin.invite_user', compact('roles'));
    }
}
