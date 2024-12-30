<?php

namespace App\Http\Controllers;

use App\Models\BuyRequest;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    function adminHome()
    {
        // Check if the user is logged in
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        $user = auth()->guard()->user();

        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }

        try {
            $users = User::where('role', '0')->get();
            $userActive = User::where('status', '1')->count();
            $primary = Property::where('statusListing', '1')->where('isPrimary', '1')->count();
            $secondary = Property::where('statusListing', '1')->where('isPrimary', '0')->count();
            $buyRequest = BuyRequest::where('isActive', '1')->count();

            $oneWeekAgo = Carbon::now()->subWeek();

            // Fetch all activities for the past week
            $buyRequestsActivity = BuyRequest::join('users', 'buy_requests.agentID', '=', 'users.id')->leftjoin('users as modifier', 'buy_requests.modified_by', '=', 'modifier.id')->where('isActive', '1')->where('buy_requests.created_at', '>=', $oneWeekAgo)->orWhere('buy_requests.updated_at', '>=', $oneWeekAgo)->orderBy('buy_requests.updated_at', 'desc')->orderBy('buy_requests.created_at', 'desc')->select('buy_requests.*', 'buy_requests.created_at as buy_request_created_at', 'buy_requests.updated_at as buy_request_updated_at', 'modifier.name as agent_name')->limit(5)->get();
            $propertyActivity = Property::join('users', 'listing.agentID', '=', 'users.id')->leftjoin('users as modifier', 'listing.modified_by', '=', 'modifier.id')->where('statusListing', '1')->where('listing.created_at', '>=', $oneWeekAgo)->orWhere('listing.updated_at', '>=', $oneWeekAgo)->orderBy('listing.updated_at', 'desc')->orderBy('listing.created_at', 'desc')->select('listing.*', 'listing.created_at as listing_created_at', 'listing.updated_at as listing_updated_at', 'modifier.name as agent_name')->limit(5)->get();
            $usersActivity = User::join('users as modifier', 'users.modified_by', '=', 'modifier.id') // join with the same table as 'modifier'
            ->where('users.status', '1')
            ->where('users.created_at', '>=', $oneWeekAgo)
            ->orWhere('users.updated_at', '>=', $oneWeekAgo)
            ->orderBy('users.updated_at', 'desc')
            ->orderBy('users.created_at', 'desc')
            ->select('users.*', 'modifier.name as modified_by_name') // select the name of the modified user
            ->limit(5)
            ->get();
            return view('admin.dashboard', compact('users', 'userActive', 'primary', 'secondary', 'buyRequest', 'buyRequestsActivity', 'propertyActivity', 'usersActivity'))->with('success', 'User berhasil masuk dashboard');
        } catch (Exception) {
            abort(403, 'Oops..Something went wrong in adminHome()!');
        }
    }
    function adminProfilView()
    {
        // Check if the user is logged in
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }
        $user = auth()->guard()->user();
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }
        try {
            $users = User::where('status', 1)->orderBy('role', 'asc')->orderBy('created_at', 'asc')->paginate(10);
            return view('admin.user.index', compact('users'));
        } catch (Exception) {
            abort(403, 'Oops..Something went wrong in adminProfilView()!');
        }
    }

    function viewAddUser()
    {
        // Check if the user is logged in
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }
        $user = auth()->guard()->user();
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }
        try {
            return view('admin.user.create');
        } catch (Exception) {
            abort(403, 'Oops..Something went wrong in viewAddUser()!');
        }
    }

    function addUser(Request $request)
    {
        try {
            $user = new User();

            $user->name = $request->fullname;
            $user->email = $request->email;
            $user->nohp = $request->nohp;
            $user->nowa = $request->noWA;
            $user->role = $request->role;
            $user->password = bcrypt($request->password);
            $user->modified_by = Auth::id();

            $user->save();

            return redirect()->route('admin-users.profil')->with('success', 'User berhasil ditambahkan');
        } catch (QueryException $e) {
            // Check for unique constraint violation error code
            if ($e->getCode() == 23000) {
                return redirect()->route('admin-users.profil')
                    ->with('error', 'Email sudah terdaftar. Silakan gunakan email lain.')
                    ->withInput();
            }
            // Handle other types of query exceptions
            return redirect()->route('admin-users.profil')
                ->with('error', 'Terjadi kesalahan pada server.')
                ->withInput();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (invalid dimensions, file type, or size)
            return redirect()->route('addUser.view')
                ->with('error', 'Pembuatan User Baru gagal dibuat.')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $eh) {
            abort(405, 'Oops..Something went wrong in addUser()!');
        }

    }

    function viewUpdateUser($id)
    {
        // Check if the user is logged in
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        if(Auth::user()->role != '0') {
            abort(403, 'Unauthorized access');
        }

        $user = User::findOrFail($id);

        try {
            return view('admin.user.update', compact('user'));
        } catch (exception $e) {
            abort(403, 'Oops..Something went wrong in viewUpdateUser()!');
        }

    }

    public function updateUser(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            // Simpan data user
            User::findOrFail($id)->update([
                'name' => $request->fullname,
                'email' => $request->email,
                'nohp' => $request->nohp,
                'nowa' => $request->noWA,
                'role' => $request->role,
                'password' => $request->password ? bcrypt($request->password) : $user->password,
                'modified_by' => Auth::id(),
            ]);

            return redirect()->route('admin-users.profil')->with('success', 'User berhasil diupdate');
        } catch (QueryException $e) {
            // Check for unique constraint violation error code
            if ($e->getCode() == 23000) {
                return redirect()->route('admin-users.profil')
                    ->with('error', 'Email sudah terdaftar. Silakan gunakan email lain.')
                    ->withInput();
            }
            // Handle other types of query exceptions
            return redirect()->route('admin-users.profil')
                ->with('error', 'Terjadi kesalahan pada server.')
                ->withInput();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (invalid dimensions, file type, or size)
            return redirect()->route('addUser.view')
                ->with('error', 'Modifikasi User Baru gagal dibuat.')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $th) {
            abort(403, 'Oops..Something went wrong in updateUser()!');
        }

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return redirect()->route('admin-users.profil')->with('error', 'User gagal dihapus');
        }

        try {
            $user->update(['status' => 0, 'modified_by' => Auth::id()]);

            return redirect()->route('admin-users.profil')->with('success', 'User berhasil dihapus');
        } catch (QueryException $e) {
            // Check for unique constraint violation error code
            if ($e->getCode() == 23000) {
                return redirect()->route('admin-users.profil')
                    ->with('error', 'Email sudah terdaftar. Silakan gunakan email lain.')
                    ->withInput();
            }
            // Handle other types of query exceptions
            return redirect()->route('admin-users.profil')
                ->with('error', 'Terjadi kesalahan pada server.')
                ->withInput();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (invalid dimensions, file type, or size)
            return redirect()->route('addUser.view')
                ->with('error', 'penghapusan User gagal.')
                ->withErrors($e->validator)
                ->withInput();
        } catch (exception $e) {
            abort(403, 'Oops..Something went wrong in destroy()!');
        }

    }

    function profilView($id)
    {
        $user = User::find($id);
        if(!Auth::check()){
            abort(403, 'Unauthorized access');
        }

        // Get the currently logged-in user
        $loggedInUser = Auth::user();

        // Check if the requested profile ID matches the logged-in user's ID
        if ($loggedInUser->id != $id) {
            abort(403, 'No need to peep on others!');
        }

        return view('user.login.profil', compact('user'));
    }

    function profilEditView($id)
    {
        $user = User::find($id);
        if(!Auth::check()){
            abort(403, 'Unauthorized access');
        }

        // Get the currently logged-in user
        $loggedInUser = Auth::user();

        // Check if the requested profile ID matches the logged-in user's ID
        if ($loggedInUser->id != $id) {
            abort(403, 'You dont have that permission!');
        }
        return view('user.login.editProfil', compact('user'));
    }

    function submitProfil(Request $request, $id)
    {
        $user = User::find($id);

        if(!Auth::check()){
            abort(403, 'Unauthorized access');
        }

        // Get the currently logged-in user
        $loggedInUser = Auth::user();

        // Check if the requested profile ID matches the logged-in user's ID
        if ($loggedInUser->id != $id) {
            abort(403, 'You dont have that permission!');
        }
        try {
            $user->name = $request->fullname;
            $user->email = $request->email;
            $user->nohp = $request->nohp;
            $user->nowa = $request->noWA;
            $user->password = $request->password ? bcrypt($request->password) : $user->password; //This will ensure that if no password is entered, the existing password remains unchanged.
            $user->updated_at = now();
            $user->modified_by = Auth::id();

            if ($request->hasFile('image')) {
                // Check if the user already has an image and delete it
                if ($user->image) {
                    Storage::disk('public')->delete($user->image);
                }

                // Store the new image
                $imagePath = $request->file('image')->store('user_images', 'public');
                Log::info('Image path: ' . $imagePath);

                // Update the user's image path
                $user->image = $imagePath;
            } else {
                Log::error('No image uploaded');
            }
            $user->save();
            return redirect()->route('user.profil', ['id' => $user->id]);
        }  catch (QueryException $e) {
            // Check for unique constraint violation error code
            if ($e->getCode() == 23000) {
                return redirect()->route('user.profil', ['id' => $user->id])
                    ->with('error', 'Email sudah terdaftar. Silakan gunakan email lain.')
                    ->withInput();
            }
            // Handle other types of query exceptions
            return redirect()->route('user.profil', ['id' => $user->id])
                ->with('error', 'Terjadi kesalahan pada server.')
                ->withInput();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (invalid dimensions, file type, or size)
            return redirect()->route('user.profil', ['id' => $user->id])
                ->with('error', 'Pembuatan User Baru gagal dibuat.')
                ->withErrors($e->validator)
                ->withInput();
        } catch (exception $e) {
            abort(403, 'Oops..Something went wrong in submitProfil()!');
        }
    }

    function userSearch(Request $request) {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $keyword = $request->input('search');

        if(empty($keyword)) {
            return redirect()->route('admin-users.profil');
        }

        // Map keyword to corresponding role values
        $roleValue = null;
        if (strtolower($keyword) === 'admin' ) {
            $roleValue = 0;
        } elseif (in_array(strtolower($keyword), ['user', 'agent'])) {
            $roleValue = 1;
        }

        $users = User::where('name', 'like', '%' . $keyword . '%')
        ->orwhere('nowa', 'like', '%' . $keyword . '%')
        ->orwhere('nohp', 'like', '%' . $keyword . '%')
        ->orwhere('email', 'like', '%' . $keyword . '%')
        ->when($roleValue !== null, function ($query) use ($roleValue) {
            $query->orWhere('role', $roleValue);
        })
        ->paginate(10);

        return view('admin.user.index', compact('users', 'keyword'));
    }
}
