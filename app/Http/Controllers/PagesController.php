<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Cart;
use App\Customer;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Slide;
use App\ProductType;
use Session;
use Hash;
use Auth;

class PagesController extends Controller
{

    public function getIndex()
    {
        $slide = Slide::all();
        $sp_moi = Product::where('new', 1)->paginate(4);
        $sp_khuyenmai = Product::where('promotion_price', '<>', 0)->paginate(8);
        return view('pages.trangchu', compact('slide', 'sp_moi', 'sp_khuyenmai'));
    }

    public function getChungLoai(Request $request)
    {
        $sanpham = Product::where('id_type', $request->id)->paginate(6);
        $loai_sp = ProductType::where('id', $request->id)->first();
        $loai = ProductType::all();
        return view('pages.chungloai', compact('sanpham', 'loai_sp', 'loai'));
    }

    public function getGioiThieu()
    {
        return view('pages.gioithieu');
    }

    public function getLienHe()
    {
        return view('pages.lienhe');
    }

    public function getChiTiet(Request $request)
    {
        $sanpham = Product::where('id', $request->id)->first();
        $sp_lienquan = Product::where([
            ['id_type', '=', $sanpham->id_type],
            ['id', '<>', $sanpham->id],
        ])->take(3)->get();
        return view('pages.chitiet', compact('sanpham', 'sp_lienquan'));
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product == NULL) {
            return redirect()->back();
        }
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function postAddToCart(Request $request)
    {
        $qty = $request->qty;
        $id = $request->id;
        $product = Product::find($id);
        if ($product == NULL) {
            return redirect()->back();
        }
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->AddWithQty($product, $id, $qty);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getDelItemCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        if ($cart->checkItem($id)) {
            $cart->removeItem($id);
        }
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function getDatHang()
    {
        return view('pages.dathang');
    }

    public function postDatHang(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'phone' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên',
                'email.required' => 'Bạn chưa nhập email',
                'address.required' => 'Bạn chưa nhập địa chỉ',
                'phone.required' => 'Bạn chưa nhập số điện thoại',
            ]);

        $cart = Session::get('cart');
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->gender = $request->gender;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone;
        if (isset($request->notes)) {
            $customer->note = $request->notes;
        } else {
            $customer->note = "";
        }
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $request->payment_method;
        if (isset($request->notes)) {
            $customer->note = $request->notes;
        } else {
            $customer->note = "";
        }
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price'] / $value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao', 'Đặt hàng thành công');
    }

    public function getDangKi()
    {
        return view('pages.dangki');
    }

    public function postDangKi(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'address' => 'required',
                'phone' => 'required',
                'password' => 'required|min:3|max:32',
                'repassword' => 'required|same:password'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên',
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Bạn chưa nhập đứng định dạng email',
                'email.unique' => 'Email đã tồn tại',
                'address.required' => 'Bạn chưa nhập địa chỉ',
                'phone.required' => 'Bạn chưa nhập số điện thoại',
                'password.required' => 'Bạn chưa nhập password',
                'password.min' => 'Password có độ dài từ 3 đến 32 kí tự',
                'password.max' => 'Password có độ dài từ 3 đến 32 kí tự',
                'repassword.required' => 'Bạn chưa xác nhận password',
                'repassword.same' => 'Mật khẩu không khớp'
            ]);
        $user = new User;
        $user->full_name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->with('thongbao', 'Đăng kí thành công');
    }

    public function getDangNhap()
    {
        return view('pages.dangnhap');
    }

    public function postDangNhap(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required|email',
                'password' => 'required|min:3|max:32',
            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Bạn chưa nhập đứng định dạng email',
                'password.required' => 'Bạn chưa nhập password',
                'password.min' => 'Password có độ dài từ 3 đến 32 kí tự',
                'password.max' => 'Password có độ dài từ 3 đến 32 kí tự',
            ]);
        $data = array('email' => $request->email, 'password' => $request->password);

        if (Auth::attempt($data)) {
            return redirect(route('trangchu'));
        } else {
            return redirect()->back()->with('thongbao', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }

    public function getDangXuat()
    {
        Auth::logout();
        return redirect(route('trangchu'));
    }

    public function getTimKiem(Request $request)
    {
        $sanpham = Product::where('name', 'like', '%' . $request->key . '%')->get();
        $loai = ProductType::all();
        return view('pages.timkiem', compact('sanpham', 'loai'));
    }
}
