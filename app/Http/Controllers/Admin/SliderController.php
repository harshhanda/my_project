<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
   

    public function add(Request $request){

        if($request->input()){

            if((int) $request->id >0){
                                        
                $rules=[
                'id'=>'numeric|required',						
                ];

            }
             
            if((int) $request->post('id')==0){
                  
              $rules['image']='required|image|mimes:jpeg,png,jpg,gif';
            }
                
            $validator = \Validator::make($request->all(), $rules);
            
            if ($validator->fails()){
              $message = "";
              $messages_l = json_decode(json_encode($validator->messages()), true);
              foreach ($messages_l as $msg) {
                $message= $msg[0];
                break;
              }
              
              return response(array('message'=>$message),403);
              
            }else{
            
              if((int) $request->id >0){
                
                $slider=Slider::find($request->id);

              }else{
                
                $slider=new Slider();
              
              }
        
              $image=$request->old_image;
             
              
              if($request->hasFile('image')){
                $imageData = $request->file('image');
                $image = strtotime(date('Y-m-d H:i:s')).'.'.$imageData->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/sliders');
                $imageData->move($destinationPath, $image);
              } 
        
              $slider->image=$image;
              
              $slider->save();
              
              if((int) $request->id >0){
                
                return response(array('message'=>'Slider updated successfully.','reset'=>false),200);
              }else{
                
                return response(array('message'=>'Slider added successfully.','reset'=>true,'script'=>false),200);
              
              }
              
            }
            
            return response(array('message'=>'Data not found.'),403);
        }
          
          $result=[];

        return view('admin.slider.add',compact('result'));
          
    }





    public function list(){

        $result = Slider::orderBy('id','desc')->get();
        return view('admin.slider.list',compact('result'));
    }



    public function changeStatus(Request $request){
        $user = Slider::find($request->id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message'=>'Status change successfully.']);
    }


    public function update($id){

        $result = Slider::find($id);
      
        return view('admin/slider/add',compact('result'));
      }
    
    


    public function delete($id){
        
        Slider::find($id)->delete();
        return redirect()->back()->with('5fernsadminsuccess','Slider deleted successfully.'); 
    }
    
    
    
    














































}
