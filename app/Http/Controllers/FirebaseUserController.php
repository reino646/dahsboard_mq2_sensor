<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FirebaseUserController extends Controller
{
    protected $dbUrl;

    public function __construct()
    {
        $this->dbUrl = 'https://apps-1ca7f-default-rtdb.asia-southeast1.firebasedatabase.app/users';
    }

    public function index()
    {
        $response = Http::get($this->dbUrl . '.json');
        $users = $response->json();

        return view('manage-users', compact('users'));
    }

    public function update(Request $request, $uid)
    {
        $role = $request->input('role');
        $updateData = ['role' => $role];

        Http::patch($this->dbUrl . '/' . $uid . '.json', $updateData);

        return redirect()->back()->with('success', 'Role updated!');
    }

    public function delete($uid){
        $response = Http::delete($this->dbUrl . '/' . $uid . '.json');

        if ($response->successful()) {
            return redirect()->back()->with('success', 'User deleted!');
        } else {
            return redirect()->back()->with('error', 'Failed to delete user.');
        }
    }

}
