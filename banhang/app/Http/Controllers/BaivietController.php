<?php

namespace App\Http\Controllers;

use App\Models\baiviet;
use App\Models\sanpham;
use App\Models\sanpham_chitiet;
use App\Models\nhan_hieu;
use App\Models\loai_san_pham;
use App\Models\baiviet_binhluan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Extension\check;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
//chia sẻ dữ liệu nhiều view

class BaivietController extends Controller
{
    public $lsloaisanpham ;
    public $loaibaiviet;
    public $lsbaivietmoi;

    public function menu_bai_viet()
    {
        $lsloaisanpham = loai_san_pham::where('hien','=',1)->get();
        $loaibaiviet = baiviet::select('loai_bai_viet')->distinct('loai_bai_viet')->get();
        $lsbaivietmoi = baiviet::where('hien','=',1)->where('moi','=',1)->orderBy('created_at', 'DESC')->paginate(3);
        return view('baiviet.menubaiviet')->with(['lsloaisanpham'=>$lsloaisanpham,'loaibaiviet'=>$loaibaiviet,'lsbaivietmoi'=>$lsbaivietmoi]);
    }

    public function index()
    {
        $lsbaiviet = baiviet::where('hien','=',1)->paginate(6);
        $lsbaivietnb = baiviet::where('hien','=',1)->where('noi_bat','=',1)->orderBy('created_at', 'DESC')->limit(3)->get();
        return view('baiviet.dsbaiviet')->with(['lsbaiviet'=>$lsbaiviet,'lsbaivietnb'=>$lsbaivietnb]);
    }

    public function chi_tiet_bai_viet($id)
    {
        $baiviet = baiviet::join('nguoidungs','nguoidungs.id','=','baiviets.ma_nguoi_dung')
                            ->select('baiviets.*','nguoidungs.ten','nguoidungs.hinh_dai_dien')->find($id);
        $lsbinhluan =  baiviet_binhluan::join('nguoidungs','nguoidungs.id','=','baiviet_binhluans.ma_nguoi_dung')
                            ->select('nguoidungs.ten','nguoidungs.hinh_dai_dien','baiviet_binhluans.*')
                            ->where('baiviet_binhluans.ma_bai_viet','=',$id)
                            ->where('id_binh_luan_cha','=', null)->get();
        return view('baiviet.chitietbaiviet')->with(['baiviet'=>$baiviet,'lsbinhluan'=>$lsbinhluan]);
    }

    //bình luận bài viết
    public function binh_luan_bai_viet($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'noidung' => 'required',
        ], $messages = [
            'noidung' => 'nội dung không được bỏ trống',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            if(!Auth::check()){
                return response()->json([
                'status'=>401,
                'errors'=>"vui lòng đăng nhập",
                ]);
            }
            else{
                $noidung  = $request->noidung;
                $id_binh_luan = $request->id_binh_luan;

                $binh_luan_bai_viet = baiviet_binhluan::create([
                    'ma_bai_viet'=>$id,
                    'ma_nguoi_dung' => Auth::user()->id,
                    'noi_dung'=> $noidung,
                    'id_binh_luan_cha'=>$id_binh_luan,
                    'hien'=>1,
                    'noi_bat'=>0,
                    'trang_thai'=>1,
                ]);
                return response()->json([
                    'status'=>200,
                    'mess'=>'Thêm bình luận thành công',
                ]);
            }
        }
    }
   

    /* public function load_binh_luan( Request $request){
       $id_bai_viet = $request->idbaiviet;
    // $perPage - là số lượng item sẽ lấy ra và hiển thị trên mỗi trang. Mặc định sẽ là 15 item trên mỗi trang.
    // $columns - là những cột sẽ lấy ra trong database. Mặc định sẽ lấy hết (SELETC *)
    // $pageName - là tên của query string sẽ chứa tham số page number. Mặc định $pageName = 'page'.
    // $page - là item bạn muốn lấy ra là trang số mấy, nếu page là null thì Laravel sẽ xử lý theo data của page query string. Mặc định $page = null.
        $lsbinhluancha =  baiviet_binhluan::join('nguoidungs','nguoidungs.id','=','baiviet_binhluans.ma_nguoi_dung')
                            ->select('nguoidungs.ten','nguoidungs.hinh_dai_dien','baiviet_binhluans.*')
                            ->where('baiviet_binhluans.ma_bai_viet','=',$id_bai_viet)
                            ->where('id_binh_luan_cha','=', null)->paginate($perPage = 3, $columns = ['*'], $pageName = 'lsbinhluancha',$page=1);
        //$lsbinhluancha->onEachSide(1)->links() : 1 2 .. 6 7 8 .. 25 26
        return  $lsbinhluancha->total();
        $lsbinhluancon = baiviet_binhluan::join('nguoidungs','nguoidungs.id','=','baiviet_binhluans.ma_nguoi_dung')
                            ->select('nguoidungs.ten','nguoidungs.hinh_dai_dien','baiviet_binhluans.*')
                            ->where('baiviet_binhluans.ma_bai_viet','=',$id_bai_viet)
                            ->where('id_binh_luan_cha','!=', null)->get();
        $output = '';
        foreach($lsbinhluancha as $key=>$value){
        $output.= ' <div class="coment-area">
                    <ul class="we-comet">
                        <li>
                            <div class="comet-avatar">
                                <img src="'.url('/').'/'.$value->hinh_dai_dien.'" alt="">
                            </div>
                            <div class="we-comment">
                                <div class="coment-head">
                                    <h5><span>'.$value->ten.'</span></h5>
                                    <span>1 year ago</span>
                                     <button class="we-reply" title="trả lời" name="we-reply'.$value->id.'" id="we-reply'.$value->id.'" onclick="form_tra_loi_binh_luan('.$value->id.')">
                                        <i class="fa fa-reply"></i>
                                    </button>
                                </div>
                                <p>'.$value->noi_dung.'</p>
                            </div>';
        foreach($lsbinhluancon as $key=>$value2){      
            if($value2->id_binh_luan_cha == $value->id){          
        $output.='           <ul>
                                <li>
                                    <div class="comet-avatar">
                                        <img src="'.url('/').'/'.$value2->hinh_dai_dien.'" alt=""> 
                                    </div>
                                    <div class="we-comment">
                                        <div class="coment-head">
                                            <h5><span>'.$value2->ten.'</span></h5>
                                            <span>1 month ago</span>
                                             <button class="we-reply" title="trả lời" name="we-reply'.$value->id.'" id="we-reply'.$value->id.'" onclick="form_tra_loi_binh_luan('.$value->id.')">
                                                <i class="fa fa-reply"></i>
                                          </button>
                                        </div>
                                        <p>'.$value2->noi_dung.'</p>
                                    </div>
                                </li>
                            </ul>';
            }
        }


        $output.='        </li>
                    </ul>';
        $output.='  <div class="post-comt-box rep-commment" id="rep-commment'.$value->id.'">
                        <div class="coment-area">
                            <ul class="we-comet">
                                <li>
                                
                                    
                                    <input type="hidden" name="idbaiviet" id="idbaiviet" value="'.$id_bai_viet.'">
                                    <div id="rep-binh-luan-bai-viet">
                                        <div class="we-comment-binhluan">
                                            <textarea placeholder="Viết bình luận..." id="noidungbinhluan'.$value->id.'" name="noidungbinhluan" class="noidungbinhluan"></textarea>
                                            <div class="add-smiles">
                                                <div class="guibinhluan">
                                                    <button class="btnbinhluan" id="btnbinhluan" name="btnbinhluan" onclick="rep_binh_luan_bai_viet('.$id_bai_viet.','.$value->id.')">
                                                        <i class="fa fa-paper-plane"></i>
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                              
                                </li>
                            </ul>
                        
                    </div>
                </div>
            </div>';
                
        } 
        $output.= ' <div class="product__pagination phan-trang text-center">
                             <a href="#">1</a>
                             <a href="#">2</a>
                             <a href="#">3</a>
                             <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                         </div>';
 
        return  $output;} */

    
        //bình luận bài viết 2
    public function load_binh_luan( Request $request){
        $id_bai_viet = $request->idbaiviet;
        $trang = $request->page;
        $lsbinhluancha =  baiviet_binhluan::join('nguoidungs','nguoidungs.id','=','baiviet_binhluans.ma_nguoi_dung')
                            ->select('nguoidungs.ten','nguoidungs.hinh_dai_dien','baiviet_binhluans.*')
                            ->where('baiviet_binhluans.ma_bai_viet','=',$id_bai_viet)
                            ->where('baiviet_binhluans.id_binh_luan_cha','=', null)
                            ->where('baiviet_binhluans.hien','=',1)
                            ->orderBy('id','DESC')
                            ->paginate($perPage = 10, $columns = ['*'], $pageName = 'lsbinhluancha',$page=$trang);

        $lastPage = $lsbinhluancha->lastPage();
        $lsbinhluancon = baiviet_binhluan::join('nguoidungs','nguoidungs.id','=','baiviet_binhluans.ma_nguoi_dung')
                            ->select('nguoidungs.ten','nguoidungs.hinh_dai_dien','baiviet_binhluans.*')
                            ->where('baiviet_binhluans.ma_bai_viet','=',$id_bai_viet)
                            ->where('baiviet_binhluans.id_binh_luan_cha','!=', null)->get();

        return  view('baiviet.binh-luan-bai-viet')->with(['lsbinhluancha'=>$lsbinhluancha,
                                                          'lsbinhluancon'=>$lsbinhluancon,
                                                          'id_bai_viet'=>$id_bai_viet,
                                                          'lastPage' => $lastPage,
                                                          'trang'=>$trang]);    
        
                 
    }
}
