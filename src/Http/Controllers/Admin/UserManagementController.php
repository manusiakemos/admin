<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class UserManagementController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'role:super-admin']);
    }

    public function api(Request $request)
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * hapus semua
     */
    public function bulkDelete(Request $request)
    {
        $data = collect($request->data);
        $save = UserManagement::whereIn("id", $data->pluck("id")->unique())->delete();
        return $save
            ? response()->json(['status' => true, 'text' => 'success', 'message' => 'User berhasil dihapus'])
            : response()->json(['status' => false, 'text' => 'error', 'message' => 'User gagal dihapus'], 500);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $data = UserManagement::query();
        /*if ($request->has("usermanagement_status") && $request->usermanagement_status != null) {
            $data = $data->where("_usermanagement.usermanagement_status","=", $request->usermanagement_status);
        }*/
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('action', function (UserManagement $data) {
                    return view("usermanagement.actions_usermanagement", ['data' => $data]);
                })
                ->addColumn('checked', function (UserManagement $data) {
                    return view("usermanagement.checked_usermanagement", ['data' => $data]);
                })
                ->rawColumns(['action', 'checked'])
                ->toJson();
        }

        return view('usermanagement.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usermanagement.create', ['modal_title' => 'Tambah Slider']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            "name" => [
                "required"
            ],
            "username" => [
                "required"
            ],
            "role" => [
                "required"
            ],
            "email" => ["sometimes"]
        ];
        if ($request->has("email") && $request->email) {
            array_push($rules["email"], "email");
        }
        $this->validate($request, $rules);

        $db = new UserManagement;
        $save = $this->handleRequest($request, $db);

        return $save
            ? response()->json(['status' => true, 'text' => 'success', 'message' => 'User berhasil ditambahkan'])
            : response()->json(['status' => false, 'text' => 'error', 'message' => 'User gagal ditambahkan'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserManagement $usermanagement
     * @return \Illuminate\Http\Response
     */
    public function show(UserManagement $usermanagement)
    {
        return view('usermanagement.show', ['data' => $usermanagement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserManagement $usermanagement
     * @return \Illuminate\Http\Response
     */
    public function edit(UserManagement $usermanagement)
    {
        return view('usermanagement.edit', ['data' => $usermanagement], ['modal_title' => 'Edit Slider']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\UserManagement $usermanagement
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, UserManagement $usermanagement)
    {

        $rules = [
            "name" => [
                "required"
            ],
            "username" => [
                "required"
            ],
            "role" => [
                "required"
            ],
        ];
        $this->validate($request, $rules);

        $db = $usermanagement;
        $save = $this->handleRequest($request, $db);

        return $save
            ? response()->json(['status' => true, 'text' => 'success', 'message' => 'User berhasil diupdate'])
            : response()->json(['status' => false, 'text' => 'error', 'message' => 'User gagal diupdate'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserManagement $usermanagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserManagement $usermanagement)
    {
        $save = $usermanagement->delete();

        return $save
            ? response()->json(['status' => true, 'text' => 'success', 'message' => 'User berhasil dihapus'])
            : response()->json(['status' => false, 'text' => 'error', 'message' => 'User gagal dihapus'], 500);
    }

    /**
     * @param $request
     * @param \App\Models\UserManagement $db
     * @return mixed
     */
    private function handleRequest(Request $request, $db)
    {
        if (!$db->id) {
            $db->password = bcrypt($request->username);
        }
        $db->name = $request->name;
        $db->email = $request->email;
        $db->username = $request->username;
        $db->role = $request->role;
        $db->api_token = Str::random(100);
        return $db->save();
    }
}
