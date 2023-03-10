<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserPass;
use Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
class UsersCreateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersdata=User::where('user_type','>','0')->latest()->get();

      $pageConfigs = ['pageHeader' => true];
      $breadcrumbs = [
        ["link" => "/", "name" => "Home"],["name" => "Kullanıcı Listesi"]
      ];
      return view('pages.users-index',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs],compact('usersdata'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $pageConfigs = ['pageHeader' => true];
      $breadcrumbs = [
        ["link" => "/", "name" => "Home"],["link" => route('user_index'), "name" => "Kullanıcı Listesi"],["name" => "Kullanıcı Ekle"]
      ];
      return view('pages.users-create',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->validate([
        'user_type' => 'required',
      ],
        [
          'user_type.required' => 'Kullanıcı Tipi Boş Olamaz ',
        ]);
      $pass=Str::random(6);
      $userdata=$request->except('_token');
      $userdata['password']=Hash::make($pass);
      $user=User::create($userdata);
      Mail::to($user->email)->send(new UserPass($user,$pass));

      return Redirect()->back()->with('success', 'Kullanıcı Eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

      $pageConfigs = ['pageHeader' => true];
      $breadcrumbs = [
        ["link" => "/", "name" => "Home"],["name" => "Kullanıcı Excel Ekleme"]
      ];
      return view('pages.users-excel-create',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
      return view('pages.users-edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


      $userdata=$request->except('_token');
      User::find($id)->update($userdata);

      return Redirect()->route('user_index')->with('success', 'Kullanıcı Güncellemesi Başarılı');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
      $user->delete();
      return Redirect()->back()->with('Success', 'Kullanıcı Silindi');
    }


  public function import(Request $request)
  {
    $data = $request->validate([
      'excel_file' => 'required|mimes:xlsx'
    ],
      [
        'excel_file.required' => 'Lütfen Dosyayı Yükleyin ',
        'excel_file.mimes' => 'Dosya türü yalnızca xlsx olmalıdır',
      ]);

    $userexcel = $request->file('excel_file');
    Excel::import(new UsersImport, $userexcel);

    return Redirect('/users')->with('Success', 'Kullanıcı Başarıyla Eklendi');
  }
  public function download()
  {
    return response()->download(public_path('excel/users/aktarimornektwo.xlsx'));
  }
  public function updatepassword(User $user)
  {
    $pass=Str::random(6);
    $update=Hash::make($pass);
    $user->password=$update;
    $user->save();
    Mail::to($user->email)->send(new UserPass($user,$pass));
    return Redirect()->route('user_index')->with('success', 'Kullanıcı Mail Gönderimi Başarılı');

  }
    public function userinde()
    {
      $useroperation= new User();

      return response()->json($useroperation->get_user(), 200);

    }
  public function userupdateapi(Request $request, User $user)
  {
    $userop= new User();
    return response()->json($userop->user_update_api($request,$user), 200);
  }
}
