<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    private $locationMapping = [
        1 => 'Asemrowo',
        2 => 'Benowo',
        3 => 'Bubutan',
        4 => 'Bulak',
        5 => 'Dukuh Pakis',
        6 => 'Gayungan',
        7 => 'Genteng',
        8 => 'Gubeng',
        9 => 'Gunung Anyar',
        10 => 'Jambangan',
        11 => 'Karang Pilang',
        12 => 'Kenjeran',
        13 => 'Krembangan',
        14 => 'Lakarsantri',
        15 => 'Mulyorejo',
        16 => 'Pabean Cantian',
        17 => 'Pakal',
        18 => 'Rungkut',
        19 => 'Sambikerep',
        20 => 'Sawahan',
        21 => 'Semampir',
        22 => 'Simokerto',
        23 => 'Sukolilo',
        24 => 'Sukomanunggal',
        25 => 'Tambaksari',
        26 => 'Tandes',
        27 => 'Tegalsari',
        28 => 'Tenggilis Mejoyo',
        29 => 'Wiyung',
        30 => 'Wonocolo',
        31 => 'Wonokromo',
    ];
    // ---------------------------------//
    //            HOME PAGE             //
    // ---------------------------------//
    function index()
    {
        // Fetch popular properties
        $primary = Property::where('isPrimary', 1)->where('statusListing', 1)
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $secondary = Property::where('isPrimary', 0)->where('statusListing', 1)
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Fetch the count of properties by orientation
        $baratCount = Property::where('statusListing', 1)->where('orientasiID', 1)->count();
        $selatanCount = Property::where('statusListing', 1)->where('orientasiID', 2)->count();
        $timurCount = Property::where('statusListing', 1)->where('orientasiID', 3)->count();
        $utaraCount = Property::where('statusListing', 1)->where('orientasiID', 4)->count();

        // Return the view with the properties and counts
        return view('user.home', [
            'primary' => $primary,
            'secondary' => $secondary,
            'baratCount' => $baratCount,
            'selatanCount' => $selatanCount,
            'timurCount' => $timurCount,
            'utaraCount' => $utaraCount,
        ]);
    }
    /**
     * Handles property search based on user input and category.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */

    // ---------------------------------//
    //         ALL SEARCH PROPERTY      //
    // ---------------------------------//

    // [Home] Search
    function homeSearch(Request $request)
    {
        // Validate the input request
        $request->validate([
            'search' => 'nullable|string|max:255',
            'category' => 'required|string|in:Dijual,Disewa', // Ensure category is valid
        ]);

        $keyword = $request->input('search'); // Get the search keyword
        $category = $request->input('category'); // Get the selected category (Dijual or Disewa)

        // Determine the query based on category
        if ($category === 'Dijual') {
            // Fetch Dijual properties
            $jual = Property::query()->where('statusListing', 1)->where('transaksiID', 1)->where('isPrimary', 0);

            // Filter based on the search keyword
            $jual = $jual
                ->when($keyword, function ($query, $keyword) {
                    $mappedLocations = array_keys(
                        array_filter($this->locationMapping, function ($location) use ($keyword) {
                            return stripos($location, $keyword) !== false;
                        }),
                    );
                    $query->where(function ($subQuery) use ($keyword, $mappedLocations) {
                        $subQuery
                            ->where('title', 'LIKE', "%{$keyword}%")
                            ->orWhereIn('lokasiID', $mappedLocations)
                            ->orWhere('orientasiID', 'LIKE', "%{$keyword}%");
                    });
                })
                ->paginate(9);

            // Map lokasiID to human-readable names
            foreach ($jual as $data) {
                $data->lokasiName = $this->locationMapping[$data->lokasiID] ?? 'Unknown';
            }

            // Redirect to the Dijual page with the results
            return view('user.property.dijual', compact('jual', 'keyword'));
        }

        if ($category === 'Disewa') {
            // Fetch Disewa properties
            $sewa = Property::query()->where('statusListing', 1)->where('transaksiID', 0)->where('isPrimary', 0);

            // Filter based on the search keyword
            $sewa = $sewa
                ->when($keyword, function ($query, $keyword) {
                    $mappedLocations = array_keys(
                        array_filter($this->locationMapping, function ($location) use ($keyword) {
                            return stripos($location, $keyword) !== false;
                        }),
                    );
                    $query->where(function ($subQuery) use ($keyword, $mappedLocations) {
                        $subQuery
                            ->where('title', 'LIKE', "%{$keyword}%")
                            ->orWhereIn('lokasiID', $mappedLocations)
                            ->orWhere('orientasiID', 'LIKE', "%{$keyword}%");
                    });
                })
                ->paginate(9);

            // Map lokasiID to human-readable names
            foreach ($sewa as $data) {
                $data->lokasiName = $this->locationMapping[$data->lokasiID] ?? 'Unknown';
            }

            // Redirect to the Disewa page with the results
            return view('user.property.disewa', compact('sewa', 'keyword'));
        }
    }

    // Admin [Secondary] Search
    function secondarySearch(Request $request)
    {
        if(!Auth::check()){
            abort(403, 'Unauthorized access');
        }

        // Validate the request input
        $request->validate([
            'Pencarian' => 'nullable|string|max:255',
        ]);

        // Retrieve the search keyword from the request
        $keyword = $request->input('Pencarian');

        // Fetch secondary properties based on the keyword
        $secondary = Property::query()
            ->where('statusListing', 1)
            ->where('isPrimary', 0)
            ->when($keyword, function ($query, $keyword) {
                // Map lokasiID to its corresponding name
                $mappedLocations = array_keys(
                    array_filter($this->locationMapping, function ($location) use ($keyword) {
                        return stripos($location, $keyword) !== false;
                    })
                );
                $query->where(function ($subQuery) use ($keyword, $mappedLocations) {
                    $subQuery
                        ->where('title', 'LIKE', "%{$keyword}%")
                        ->orWhereIn('lokasiID', $mappedLocations)
                        ->orWhere('orientasiID', 'LIKE', "%{$keyword}%");
                });
            })
            ->paginate(10);

        // Replace lokasiID with human-readable names in the results
        foreach ($secondary as $data) {
            $data->lokasiName = $this->locationMapping[$data->lokasiID] ?? 'Unknown';
        }

        // Return the view with the secondary properties and search keyword
        return view('admin.property.secondary.index', compact('secondary', 'keyword'));
    }

    // ---------------------------------//
    //         ALL VIEWS PROPERTY       //
    // ---------------------------------//

    // -------- START ADMIN PAGE ------- //

    // Admin [List Konfirmasi] View
    function propertyVerifView()
    {
        $user = auth()->guard()->user();
        if(!$user) {
            abort(403, 'Please Login First!');
        }
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }
        try {
            $primaryVerif = Property::join('users', 'listing.agentID', '=', 'users.id')->where('statusListing', '2')->where('isPrimary', '1')->orderBy('listing.updated_at', 'desc')->orderBy('listing.created_at', 'desc')->paginate(5, ['*'], 'primary_page'); // Get all properties where agentID is $id and statusListing is accepted
            $secondaryVerif = Property::join('users', 'listing.agentID', '=', 'users.id')->where('statusListing', '2')->where('isPrimary', '0')->orderBy('listing.updated_at', 'desc')->orderBy('listing.created_at', 'desc')->paginate(5, ['*'], 'secondary_page'); // Get all properties where agentID is $id and statusListing is accepted

            return view('admin.property.listing-verif.index', ['primaryVerif' => $primaryVerif], ['secondaryVerif' => $secondaryVerif]);
        } catch (Exception) {
            abort(403, 'Oops..Something went wrong!');
        }
    }

    // Admin [Primary] View
    function propertyPrimaryView()
    {
        $user = auth()->guard()->user();

        if(!$user) {
            abort(403, 'Please Login First!');
        }

        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }



        try {
            $primary = Property::join('users', 'listing.agentID', '=', 'users.id')->where('isPrimary', '1')->where('statusListing', '1')->orderBy('listing.updated_at', 'desc')->orderBy('listing.created_at', 'desc')->paginate(10); // Get all properties where agentID is $id and statusListing is accepted

            return view('admin.property.primary.index', ['primary' => $primary]);
        } catch (exception) {
            abort(403, 'Oops..Something went wrong!');
        }
    }

    // Admin [Primary] View Create
    function viewAddProperty()
    {
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }
        $user = auth()->guard()->user();
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }

        return view('admin.property.primary.create');
    }

    // Admin [Primary] View Update
    function viewUpdateProperty($propertyID)
    {
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        $user = auth()->guard()->user();
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }

        $users = User::where('status', '1')->get();

        $property = Property::findOrFail($propertyID);

        if (!$property) {
            return redirect()->route('updateProperty.view')->with('error', 'property gagal diupdate');
        }
        try {
            return view('admin.property.primary.update', ['property' => $property, 'users' => $users]);
        } catch (\Throwable $th) {
            abort(403, 'Oops..Something went wrong in viewUpdateProperty()!');
        }


    }

    // Admin [Secondary] View
    function propertySecondaryView()
    {
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }
        $user = auth()->guard()->user();
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }
        try {
            $secondary = Property::where('isPrimary', '0')->orderby('statusListing', 'desc')->orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->paginate(10); // Get all properties where agentID is $id and statusListing is accepted

            return view('admin.property.secondary.index', ['secondary' => $secondary]);
        } catch (Exception $th) {
            abort(403, 'Oops..Something went wrong in propertySecondaryView()!');
        }
    }

    // Admin [Secondary] View Create
    function viewAddSecondary()
    {
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }
        $user = auth()->guard()->user();
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }

        $users = User::where('status', '1')->get();
        return view('admin.property.secondary.create', ['users' => $users]);
    }

    // Admin [Secondary] View Update
    function viewUpdateSecondary($propertyID)
    {
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        $user = auth()->guard()->user();
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }

        $users = User::where('status', '1')->get();

        $property = Property::findOrFail($propertyID);

        if (!$property) {
            return redirect()->route('updateSecondary.view')->with('error', 'property gagal diupdate');
        }

        try {
            return view('admin.property.secondary.update', ['property' => $property], ['users' => $users]);
        } catch (\Throwable $th) {
            abort(403, 'Oops..Something went wrong in viewUpdateSecondary()!');
        }
    }

    // -------- END ADMIN PAGE ------- //

    // -------- START USER PAGE ------- //

    // User [Secondary] Create Primary View
    function addPrimary()
    {
        return view('user.login.primary.add_primary');
    }

    // User [Secondary] Update Primary View
    function viewUpdatePropertyPrimary($propertyID, $id) {

        // Find the property by its ID
        $property = Property::findOrFail($propertyID);

        // Check if the user is logged in
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        // Get the currently logged-in user ID
        $loggedInUser = Auth::user()->id;

        // Check if the logged-in user is the agent that owns this property
        if ($property->agentID != $loggedInUser) {
            abort(403, 'You don\'t have permission to update this property!');
        }

        // Check if the property exists
        if (!$property) {
            return redirect()->route('updateSecondaryUser.view')->with('error', 'Property failed to update');
        }

        try {
            // Return the view with the property data
            return view('user.login.primary.update', ['property' => $property]);
        } catch (\Throwable $th) {
            abort(403, 'Oops.. Something went wrong in viewUpdatePropertyPrimary()!');
        }

    }


    // User [Secondary] Create View
    function addSecondary()
    {
        return view('user.login.secondary.add');
    }
    // User [Secondary] Update View
    function viewUpdatePropertySecondary($propertyID) {

        $property = Property::findOrFail($propertyID);

        // Check if the user is logged in
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        // Get the currently logged-in user ID
        $loggedInUser = Auth::user()->id;

        // Check if the logged-in user is the agent that owns this property
        if ($property->agentID != $loggedInUser) {
            abort(403, 'You don\'t have permission to update this property!');
        }
        if (!$property) {
            return redirect()->route('updateSecondaryUser.view')->with('error', 'property gagal diupdate');
        }

        try {
            return view('user.login.secondary.update', ['property' => $property]);
        } catch (\Throwable $th) {
            abort(403, 'Oops..Something went wrong in viewUpdatePropertySecondary()!');
        }

    }

    // User [Secondary] Status List Confirmation View
    function listKonfirmasi($id)  {

        $user = User::find($id);
        $konfirmasi = Property::where('agentID', $id)->where('statusListing', '2')->orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->limit(9)->get(); // Get all properties where agentID is $id and statusListing is accepted

        $tolak = Property::where('agentID', $id)->where('statusListing', '0')->orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->limit(9)->get();

        return view('user.property.list-konfirmasi', ['user' => $user, 'konfirmasi' => $konfirmasi, 'tolak' => $tolak]);
    }

    // -------- END USER PAGE ------- //

    // ---------------------------------//
    // ALL CREATE SUBMITS PROPERTY      //
    // ---------------------------------//

    // -------- START USER PAGE ------- //

    // User Add Primary
    public function submitPrimary(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'image_main' => 'required|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_second' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_third' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'hargaJual' => 'required|numeric|min:150000000',
                'hargaJualMax' => 'nullable|numeric|min:155000000',
            ]);
            // Create a new Property instance
            $properti = new Property();

            $properti->agentID = $request->agentID;
            $properti->title = $request->title;
            $properti->hargaJual = $request->hargaJual;
            $properti->hargaJualMax = $request->hargaJualMax;
            $properti->deskripsi = $request->deskripsi;
            $properti->orientasiID = $request->orientasiID;
            $properti->ownershipListingID = $request->ownershipListingID;
            $properti->isPrimary = $request->isPrimary;
            $properti->statusListing = $request->statusListing;
            $properti->modified_by = Auth::user()->id;

            // Handle image uploads dynamically
            $imageFields = ['image_main', 'image_second', 'image_third'];

            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    // Get the image file
                    $image = $request->file($field);

                    // Generate a unique name for the image
                    $imageName = time() . '_' . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();

                    // Move the image to the public/images folder
                    $image->move(public_path('assets/images'), $imageName);

                    // Save the path in the database (this is just an example, adjust as needed)
                    $properti->$field = 'images/' . $imageName;
                }else {
                    Log::error("No image uploaded for {$field}");
                }
            }
            // Save the property record in the database
            $properti->save();

            // Redirect to the home page
            return redirect()->route('addPrimary.view')->with('success', 'Primary berhasil dibuat.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (invalid dimensions, file type, or size)
            return redirect()->route('addPrimary.view')
                ->with('error', 'Primary gagal dibuat. Periksa dimensi gambar (min 300x300, max 2000x2000), ukuran file (maksimal 500MB) dan tipe file (jpeg,png,jpg)..')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $th) {
            // Handle unexpected errors
            Log::error('Error creating primary property: ' . $th->getMessage());
            return redirect()->route('addPrimary.view')
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }


    }

    // User Add Secondary
    public function submitSecondary(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'image_main' => 'required|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_second' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_third' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
            ]);
            // Create a new Property instance
            $properti = new Property();

            $properti->title = $request->title;
            $properti->agentID = $request->agentID;
            $properti->transaksiID = $request->transaksiID;
            $properti->ownershipID = $request->ownershipID;
            $properti->listingType = $request->listingType;
            $properti->sertifikatType = $request->sertifikatType;
            $properti->kondisiType = $request->kondisiType;
            $properti->komisi = $request->komisi;
            $properti->vendorName = $request->vendorName;
            $properti->vendorPhone = $request->VendorPhone;
            $properti->alamat = $request->alamat;
            $properti->lantai = $request->lantai;
            $properti->lokasiID = $request->lokasiID;
            $properti->orientasiID = $request->orientasiID;
            $properti->posisiID = $request->posisiID;
            $properti->hargaJual = $request->hargaJual;
            $properti->luasTanah = $request->luasTanah;
            $properti->luasBangunan = $request->luasBangunan;
            $properti->dimPanjang = $request->dimPanjang;
            $properti->dimLebar = $request->dimLebar;
            $properti->ktUtama = $request->ktUtama;
            $properti->ktLain = $request->ktLain;
            $properti->kmUtama = $request->kmUtama;
            $properti->kmLain = $request->kmLain;
            $properti->carport = $request->carport;
            $properti->deskripsi = $request->deskripsi;
            $properti->kondisiPerabotanID = $request->kondisiPerabotanID;
            $properti->listrikID = $request->listrikID;
            $properti->ownershipListingID = $request->ownershipListingID;
            $properti->isPrimary = $request->isPrimary;
            $properti->link_drive = $request->link_drive;
            $properti->statusListing = $request->statusListing;
            $properti->modified_by = $request->modified_by;

            // Handle image uploads dynamically
            $imageFields = ['image_main', 'image_second', 'image_third'];

            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    // Get the image file
                    $image = $request->file($field);

                    // Generate a unique name for the image
                    $imageName = time() . '_' . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();

                    // Move the image to the public/images folder
                    $image->move(public_path('assets/images'), $imageName);

                    // Save the path in the database (this is just an example, adjust as needed)
                    $properti->$field = 'images/' . $imageName;
                }else {
                    Log::error("No image uploaded for {$field}");
                }
            }

            // Save the property record in the database
            $properti->save();

            // Redirect to the home page
            return redirect()->route('add.view')->with('success', 'Secondary berhasil dibuat.');;
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (invalid dimensions, file type, or size)
            return redirect()->route('add.view')
                ->with('error', 'Secondary gagal dibuat. Periksa dimensi gambar (min 300x300, max 2000x2000), ukuran file (maksimal 500MB) dan tipe file (jpeg,png,jpg)..')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $th) {
            // Handle unexpected errors
            Log::error('Error creating secondary property: ' . $th->getMessage());
            return redirect()->route('add.view')
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }

    }

    // -------- END USER PAGE ------- //

    // -------- START ADMIN PAGE ------- //

    // Admin Add Primary
    public function addListPrimary(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'image_main' => 'required|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_second' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_third' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'hargaJual' => 'nullable|numeric|min:150000000',
                'hargaJualMax' => 'nullable|numeric|min:155000000',
            ]);
            // Create a new Property instance
            $properti = new Property();

            $properti->agentID = $request->agentID;
            $properti->title = $request->title;
            $properti->hargaJual = $request->hargaJual;
            $properti->hargaJualMax = $request->hargaJualMax;
            $properti->deskripsi = $request->deskripsi;
            $properti->orientasiID = $request->orientasiID;
            $properti->ownershipListingID = $request->ownershipListingID;
            $properti->isPrimary = $request->isPrimary;
            $properti->statusListing = $request->statusListing;
            $properti->updated_at = now();
            $properti->modified_by = Auth::user()->id;

            // Handle image uploads dynamically
            $imageFields = ['image_main', 'image_second', 'image_third'];

            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    // Get the image file
                    $image = $request->file($field);

                    // Generate a unique name for the image
                    $imageName = time() . '_' . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();

                    // Move the image to the public/images folder
                    $image->move(public_path('assets/images'), $imageName);

                    // Save the path in the database (this is just an example, adjust as needed)
                    $properti->$field = 'images/' . $imageName;
                }else {
                    Log::error("No image uploaded for {$field}");
                }
            }

            // Save the property record in the database
            $properti->save();

            // Redirect to the home page
            return redirect()->route('propertyVerif.view')->with('success', 'Primary berhasil dibuat.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (invalid dimensions, file type, or size)
            return redirect()->route('addProperty.view')
                ->with('error', 'Primary gagal dibuat. Periksa dimensi gambar (min 300x300, max 2000x2000), ukuran file (maksimal 500MB) dan tipe file (jpeg,png,jpg).')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $th) {
            // Handle unexpected errors
            Log::error('Error creating primary property: ' . $th->getMessage());
            return redirect()->route('addProperty.view')
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }

    }

    // Admin Add Secondary
    public function addListSecondary(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'image_main' => 'required|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_second' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_third' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
            ]);

            // Create a new Property instance
            $properti = new Property();
            $properti->title = $request->title;
            $properti->agentID = $request->agentID;
            $properti->transaksiID = $request->transaksiID;
            $properti->ownershipID = $request->ownershipID;
            $properti->listingType = $request->listingType;
            $properti->sertifikatType = $request->sertifikatType;
            $properti->kondisiType = $request->kondisiType;
            $properti->komisi = $request->komisi;
            $properti->vendorName = $request->vendorName;
            $properti->vendorPhone = $request->VendorPhone;
            $properti->alamat = $request->alamat;
            $properti->lantai = $request->lantai;
            $properti->lokasiID = $request->lokasiID;
            $properti->orientasiID = $request->orientasiID;
            $properti->posisiID = $request->posisiID;
            $properti->hargaJual = $request->hargaJual;
            $properti->luasTanah = $request->luasTanah;
            $properti->luasBangunan = $request->luasBangunan;
            $properti->dimPanjang = $request->dimPanjang;
            $properti->dimLebar = $request->dimLebar;
            $properti->ktUtama = $request->ktUtama;
            $properti->ktLain = $request->ktLain;
            $properti->kmUtama = $request->kmUtama;
            $properti->kmLain = $request->kmLain;
            $properti->carport = $request->carport;
            $properti->deskripsi = $request->deskripsi;
            $properti->kondisiPerabotanID = $request->kondisiPerabotanID;
            $properti->listrikID = $request->listrikID;
            $properti->ownershipListingID = $request->ownershipListingID;
            $properti->isPrimary = $request->isPrimary;
            $properti->link_drive = $request->link_drive;
            $properti->statusListing = $request->statusListing;
            $properti->modified_by = Auth::user()->id;

            // Handle image uploads dynamically
            $imageFields = ['image_main', 'image_second', 'image_third'];

            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    // Get the image file
                    $image = $request->file($field);

                    // Generate a unique name for the image
                    $imageName = time() . '_' . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();

                    // Move the image to the public/images folder
                    $image->move(public_path('assets/images'), $imageName);

                    // Save the path in the database (this is just an example, adjust as needed)
                    $properti->$field = 'images/' . $imageName;
                }else {
                    Log::error("No image uploaded for {$field}");
                }
            }

            // Save the property record in the database
            $properti->save();

            // Redirect to the home page
            return redirect()->route('propertyVerif.view')->with('success', 'property berhasil dibuat.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (invalid dimensions, file type, or size)
            return redirect()->route('addSecondary.view')
                ->with('error', 'Secondary gagal dibuat. Periksa dimensi gambar (min 300x300, max 2000x2000), ukuran file (maksimal 500MB) dan tipe file (jpeg,png,jpg).')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $th) {
            // Handle unexpected errors
            Log::error('Error creating secondary property: ' . $th->getMessage());
            return redirect()->route('addSecondary.view')
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    // -------- END ADMIN PAGE --------- //

    // ---------------------------------//
    //   ALL UPDATE SUBMITS PROPERTY    //
    // ---------------------------------//

    // -------- END ADMIN PAGE --------- //

    // Admin [UPDATE] PRIMARY
    function updatePrimary($propertyID, Request $request)
    {
        $property = Property::findOrFail($propertyID);

        if (!$property) {
            return redirect()->route('updateProperty.view')->with('error', 'property gagal diupdate');
        }

        try {
            // Validate the incoming request
            $request->validate([
                'image_main' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_second' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_third' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'hargaJual' => 'nullable|numeric|min:150000000',
                'hargaJualMax' => 'nullable|numeric|min:155000000',
            ]);
            // Handle image uploads dynamically
            $imageFields = ['image_main', 'image_second', 'image_third'];

            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    // Get the image file
                    $image = $request->file($field);

                    // Generate a unique name for the image
                    $imageName = time() . '_' . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();

                    // Move the image to the public/images folder
                    $image->move(public_path('assets/images'), $imageName);

                    // Save the path in the database (this is just an example, adjust as needed)
                    $properti->$field = 'images/' . $imageName;
                }else {
                    Log::error("No image uploaded for {$field}");
                }
            }

            $property->update([
                'title' => $request->title,
                'orientasiID' => $request->orientasiID,
                'hargaJual' => $request->hargaJual,
                'hargaJualMax' => $request->hargaJualMax,
                'deskripsi' => $request->deskripsi,
                'image_main' => isset($property->image_main) ? $property->image_main : null,
                'image_second' => isset($property->image_second) ? $property->image_second : null,
                'image_third' => isset($property->image_third) ? $property->image_third : null,
                'agentID' => $request->agentID,
                'statusListing' => $request->statusListing,
                'updated_at' => now(),
                'modified_by' => Auth::id()
            ]);

            return redirect()->route('propertyPrimary.view')->with('success', 'Property listing no. ' . $propertyID . ' berhasil diupdate');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (invalid dimensions, file type, or size)
            return redirect()->route('updateProperty.view', $propertyID)
                ->with('error', 'Primary gagal dibuat. Periksa dimensi gambar (min 300x300, max 2000x2000), ukuran file (maksimal 500MB) dan tipe file (jpeg,png,jpg)..')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $th) {
            // Handle unexpected errors
            Log::error('Error creating primary property: ' . $th->getMessage());
            return redirect()->route('updateProperty.view', $propertyID)
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    // Admin [UPDATE] SECONDARY
    function updateSecondary($propertyID, Request $request)
    {
        $property = Property::findOrFail($propertyID);

        if (!$property) {
            return redirect()->route('updateSecondary.view')->with('error', 'property gagal diupdate');
        }

        try {
            // Validate the incoming request
            $request->validate([
                'image_main' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_second' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_third' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
            ]);
            // Handle image uploads dynamically
            $imageFields = ['image_main', 'image_second', 'image_third'];

            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    // Get the image file
                    $image = $request->file($field);

                    // Generate a unique name for the image
                    $imageName = time() . '_' . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();

                    // Move the image to the public/images folder
                    $image->move(public_path('assets/images'), $imageName);

                    // Save the path in the database (this is just an example, adjust as needed)
                    $properti->$field = 'images/' . $imageName;
                }else {
                    Log::error("No image uploaded for {$field}");
                }
            }

            $property->update([
                'title' => $request->title,
                'transaksiID' => $request->transaksiID,
                'listingType' => $request->listingType,
                'sertifikatType' => $request->sertifikatType,
                'kondisiType' => $request->kondisiType,
                'komisi' => $request->komisi,
                'vendorName' => $request->vendorName,
                'vendorPhone' => $request->VendorPhone,
                'alamat' => $request->alamat,
                'lantai' => $request->lantai,
                'lokasiID' => $request->lokasiID,
                'orientasiID' => $request->orientasiID,
                'posisiID' => $request->posisiID,
                'hargaJual' => $request->hargaJual,
                'luasTanah' => $request->luasTanah,
                'luasBangunan' => $request->luasBangunan,
                'dimPanjang' => $request->dimPanjang,
                'dimLebar' => $request->dimLebar,
                'ktUtama' => $request->ktUtama,
                'ktLain' => $request->ktLain,
                'kmUtama' => $request->kmUtama,
                'kmLain' => $request->kmLain,
                'kondisiPerabotanID' => $request->kondisiPerabotanID,
                'carport' => $request->carport,
                'listrikID' => $request->listrikID,
                'deskripsi' => $request->deskripsi,
                'image_main' => isset($property->image_main) ? $property->image_main : null,
                'image_second' => isset($property->image_second) ? $property->image_second : null,
                'image_third' => isset($property->image_third) ? $property->image_third : null,
                'agentID' => $request->agentID,
                'statusListing' => $request->statusListing,
                'updated_at' => now(),
                'modified_by' => Auth::id()
            ]);

            return redirect()->route('propertySecondary.view')->with('success', 'Property berhasil diupdate');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (invalid dimensions, file type, or size)
            return redirect()->route('updateSecondary.view', $propertyID)
                ->with('error', 'Secondary gagal dibuat. Periksa dimensi gambar (min 300x300, max 2000x2000), ukuran file (maksimal 500MB) dan tipe file (jpeg,png,jpg)..')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $th) {
            // Handle unexpected errors
            Log::error('Error creating secondary property: ' . $th->getMessage());
            return redirect()->route('updateSecondary.view', $propertyID)
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    // -------- END ADMIN PAGE --------- //

    // -------- Start USER PAGE --------- //

    // User [Update] Primary
    function updatePrimaryUser($propertyID, Request $request)
    {
        $property = Property::findOrFail($propertyID);

        if (!$property) {
            return redirect()->route('updateProperty.view')->with('error', 'property gagal diupdate');
        }

        try {

            // Validate the incoming request
            $request->validate([
                'image_main' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_second' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_third' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'hargaJual' => 'nullable|numeric|min:150000000',
                'hargaJualMax' => 'nullable|numeric|min:155000000',
            ]);
            // Handle image uploads dynamically
            $imageFields = ['image_main', 'image_second', 'image_third'];

            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    // Get the image file
                    $image = $request->file($field);

                    // Generate a unique name for the image
                    $imageName = time() . '_' . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();

                    // Move the image to the public/images folder
                    $image->move(public_path('assets/images'), $imageName);

                    // Save the path in the database (this is just an example, adjust as needed)
                    $properti->$field = 'images/' . $imageName;
                }else {
                    Log::error("No image uploaded for {$field}");
                }
            }

            $property->update([
                'title' => $request->title,
                'orientasiID' => $request->orientasiID,
                'hargaJual' => $request->hargaJual,
                'hargaJualMax' => $request->hargaJualMax,
                'deskripsi' => $request->deskripsi,
                'image_main' => isset($property->image_main) ? $property->image_main : null,
                'image_second' => isset($property->image_second) ? $property->image_second : null,
                'image_third' => isset($property->image_third) ? $property->image_third : null,
                'statusListing' => $request->statusListing,
                'updated_at' => now(),
                'modified_by' => Auth::id()
            ]);

            return redirect()->route('property.detail', $propertyID)->with('success', 'Property berhasil diupdate');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (invalid dimensions, file type, or size)
            return redirect()->route('updatePrimaryUser.view', $propertyID)
                ->with('error', 'Primary gagal dibuat. Periksa dimensi gambar (min 300x300, max 2000x2000), ukuran file (maksimal 500MB) dan tipe file (jpeg,png,jpg)..')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $th) {
            // Handle unexpected errors
            Log::error('Error creating primary property: ' . $th->getMessage());
            return redirect()->route('updatePrimaryUser.view', $propertyID)
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }
    // User [Update] Secondary
    function updateSecondaryUser($propertyID, Request $request) {

        $property = Property::findOrFail($propertyID);

        if (!$property) {
            return redirect()->route('updateSecondary.view')->with('error', 'property gagal diupdate');
        }
        try {

            // Validate the incoming request
            $request->validate([
                'image_main' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_second' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
                'image_third' => 'nullable|image|mimes:jpeg,png,jpg|max:512000|dimensions:min_width=300,min_height=300,max_width=3000,max_height=3000',
            ]);
            // Handle image uploads dynamically
            $imageFields = ['image_main', 'image_second', 'image_third'];

            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    // Get the image file
                    $image = $request->file($field);

                    // Generate a unique name for the image
                    $imageName = time() . '_' . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();

                    // Move the image to the public/images folder
                    $image->move(public_path('assets/images'), $imageName);

                    // Save the path in the database (this is just an example, adjust as needed)
                    $properti->$field = 'images/' . $imageName;
                }else {
                    Log::error("No image uploaded for {$field}");
                }
            }

            $property->update([
                'title' => $request->title,
                'transaksiID' => $request->transaksiID,
                'listingType' => $request->listingType,
                'sertifikatType' => $request->sertifikatType,
                'kondisiType' => $request->kondisiType,
                'komisi' => $request->komisi,
                'vendorName' => $request->vendorName,
                'vendorPhone' => $request->VendorPhone,
                'alamat' => $request->alamat,
                'lantai' => $request->lantai,
                'lokasiID' => $request->lokasiID,
                'orientasiID' => $request->orientasiID,
                'posisiID' => $request->posisiID,
                'hargaJual' => $request->hargaJual,
                'luasTanah' => $request->luasTanah,
                'luasBangunan' => $request->luasBangunan,
                'dimPanjang' => $request->dimPanjang,
                'dimLebar' => $request->dimLebar,
                'ktUtama' => $request->ktUtama,
                'ktLain' => $request->ktLain,
                'kmUtama' => $request->kmUtama,
                'kmLain' => $request->kmLain,
                'kondisiPerabotanID' => $request->kondisiPerabotanID,
                'carport' => $request->carport,
                'listrikID' => $request->listrikID,
                'deskripsi' => $request->deskripsi,
                'image_main' => isset($property->image_main) ? $property->image_main : null,
                'image_second' => isset($property->image_second) ? $property->image_second : null,
                'image_third' => isset($property->image_third) ? $property->image_third : null,
                'statusListing' => $request->statusListing,
                'updated_at' => now(),
                'modified_by' => Auth::id()
            ]);

            return redirect()->route('property.detail', $propertyID)->with('success', 'Property berhasil diupdate');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (invalid dimensions, file type, or size)
            return redirect()->route('updateSecondaryUser.view', $propertyID)
                ->with('error', 'Secondary gagal dibuat. Periksa dimensi gambar (min 300x300, max 2000x2000), ukuran file (maksimal 500MB) dan tipe file (jpeg,png,jpg)..')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $th) {
            // Handle unexpected errors
            Log::error('Error creating secondary property: ' . $th->getMessage());
            return redirect()->route('updateSecondaryUser.view', $propertyID)
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    // -------- END USER PAGE --------- //


    // OTHERS
    function acceptPrimary($id)
    {
        $property = Property::findOrFail($id);

        if (!$property) {
            return redirect()->route('propertyVerif.view')->with('error', 'Property gagal di verifikasi');
        }

        $property->update(['statusListing' => 1, 'updated_at' => now(), 'modified_by' => Auth::id()]);

        return redirect()
            ->route('propertyVerif.view')
            ->with('success', 'Property Primary Listing ID no ' . $id . ' berhasil di verifikasi');
    }
    function acceptSecondary($id)
    {
        $property = Property::findOrFail($id);

        if (!$property) {
            return redirect()->route('propertyVerif.view')->with('error', 'Property gagal di verifikasi');
        }

        $property->update(['statusListing' => 1, 'updated_at' => now(), 'modified_by' => Auth::id()]);

        return redirect()
            ->route('propertyVerif.view')
            ->with('success', 'Property Secondary Listing ID no ' . $id . ' berhasil di verifikasi');
    }
    function rejectPrimary($id, Request $request)
    {
        $property = Property::findOrFail($id);

        if (!$property) {
            return redirect()->route('propertyVerif.view')->with('error', 'Property gagal untuk di tolak');
        }

        // @dd($id,$request->alasan);

        $property->update([
            'alasan' => $request->alasan,
            'statusListing' => 0,
            'updated_at' => now(),
            'modified_by' => Auth::id()
        ]);

        return redirect()
            ->route('propertyVerif.view')
            ->with('success', 'Property Listing ID no ' . $id . ' berhasil di tolak');
    }
    function rejectProperty($id, Request $request)
    {
        $property = Property::findOrFail($id);

        if (!$property) {
            return redirect()->route('propertyVerif.view')->with('error', 'Property gagal untuk di tolak');
        }

        // @dd($id,$request->alasan);

        $property->update([
            'alasan' => $request->alasan,
            'statusListing' => 0,
            'updated_at' => now(),
            'modified_by' => Auth::id()
        ]);

        return redirect()
            ->route('propertyVerif.view')
            ->with('success', 'Property Listing ID no ' . $id . ' berhasil di tolak');
    }

    function deleteListPrimary($id)
    {
        $property = Property::findOrFail($id);

        if (!$property) {
            return redirect()->route('propertyPrimary.view')->with('error', 'Property gagal untuk di hapus');
        }

        $property->update(['statusListing' => 0 , 'updated_at' => now(), 'modified_by' => Auth::id()]);

        return redirect()
            ->route('propertyPrimary.view')
            ->with('success', 'Property Listing ID no ' . $id . ' berhasil di hapus');
    }
    function deleteListSecondary($id)
    {
        $property = Property::findOrFail($id);

        if (!$property) {
            return redirect()->route('propertySecondary.view')->with('error', 'Property gagal untuk di hapus');
        }

        $property->update(['statusListing' => 0 , 'updated_at' => now(), 'modified_by' => Auth::id()]);

        return redirect()
            ->route('propertySecondary.view')
            ->with('success', 'Property Listing ID no ' . $id . ' berhasil di hapus');
    }
}
