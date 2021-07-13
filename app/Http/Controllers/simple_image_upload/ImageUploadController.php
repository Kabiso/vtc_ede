<?php
 
namespace App\Http\Controllers\simple_image_upload;
//use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Redirect,Response,File;
use App\Photo ;
use App\Order ;
class ImageUploadController extends Controller
{
    //
    public function index($id)
    {
//      return view('simple_image_upload.index');
 return View::make('simple_image_upload.index')->with('order', $order);
 //     return View::make('orders.show')->with('order', $order);
    }
 
    public function store(Request $request)
    {
       request()->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
       if ($files = $request->file('profile_image')) {
       // Define upload path
           $destinationPath = public_path('/profile_images/'); // upload path
 // Upload Orginal Image           
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
       // $profileImage = $request->input("uploadoid") . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
          // $ordid = $request->input('uploadoid');
           $insert['image'] = "$profileImage";
        // Save In Database
 $imagemodel= new Photo();
 $imagemodel->photo_name="$profileImage";
 $imagemodel->orderid=  $request->input("uploadoid");
  $imagemodel->save();
  $order = Order::find($request->input("uploadoid"));
  $order->checkcom= '1';
  $order->save();

        }
        return back()->with('success', 'Image Upload successfully');
      //  return View::make('orders.show')->with('order', $order);
     //   return redirect('/orders')->with('success', 'Image Upload successfully');
    }
}