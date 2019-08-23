<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\HomeController;
use App\Helpers\NL_CheckOutV3;

define('URL_API', 'https://www.nganluong.vn/checkout.api.nganluong.post.php');    // Đường dẫn gọi api
define('RECEIVER', 'bacsivietok@gmail.com');                                        // Email tài khoản ngân lượng
define('MERCHANT_ID', '55678');                                                        // Mã merchant kết nối
define('MERCHANT_PASS', 'd444b643bad3bdee56d0c155ed657aa1');                            // Mật khẩu kết nôi

class NganLuongController extends HomeController
{
    /**
     * @link /nap-tien
     *
     */
    public function payment(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect('/dang-nhap?next=/tai-khoan');
        }
        $nlcheckout = new NL_CheckOutV3(MERCHANT_ID, MERCHANT_PASS, RECEIVER, URL_API);
        $total_amount = ($request->total_amount) ? $request->total_amount : 50000;

        if (@$_POST['nlpayment']) {
            $this->validate($request, [
                'total_amount' => 'required|numeric|in:50000,100000,200000',
                'option_payment' => 'required',
                'buyer_fullname' => 'required|string|max:255',
                'buyer_email' => 'required|string|email|max:255',
                'buyer_mobile' => 'required|string|max:255',
            ], [
                'total_amount.in' => "Giá trị tiền nạp không đúng!",
                'option_payment.required' => "Bạn chưa chọn phương thức thanh toán!",
                'buyer_fullname.required' => "Họ tên không được trống!",
                'buyer_email.required' => "E-mail không được trống!",
                'buyer_email.email' => "Bạn phải nhập đúng e-mail!",
                'buyer_mobile.required' => "Số điện thoại không được trống!",
            ]);

            $total_amount = $_POST['total_amount'];
            $array_items[0] = array(
                'item_name1' => 'Product name',
                'item_quantity1' => 1,
                'item_amount1' => $total_amount,
                'item_url1' => 'http://nganluong.vn/'
            );

            $array_items = array();
            $payment_method = $_POST['option_payment'];
            $bank_code = @$_POST['bankcode'];
            $order_code = "bsv_" . time();

            $payment_type = '';
            $discount_amount = 0;
            $order_description = '';
            $tax_amount = 0;
            $fee_shipping = 0;
            $return_url = route('ketqua_naptien');
            $cancel_url = route('huy_naptien', ['orderid' => urlencode($order_code)]);

            $buyer_fullname = $_POST['buyer_fullname'];
            $buyer_email = $_POST['buyer_email'];
            $buyer_mobile = $_POST['buyer_mobile'];
            $buyer_address = 'bacsiviet.vn';

            if ($payment_method != '' && $buyer_email != "" && $buyer_mobile != "" && $buyer_fullname != "" && filter_var($buyer_email, FILTER_VALIDATE_EMAIL)) {
                if ($payment_method == "VISA") {
                    $nl_result = $nlcheckout->VisaCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount,
                        $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile,
                        $buyer_address, $array_items, $bank_code);
                } elseif ($payment_method == "NL") {
                    $nl_result = $nlcheckout->NLCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount,
                        $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile,
                        $buyer_address, $array_items);
                } elseif ($payment_method == "ATM_ONLINE" && $bank_code != '') {
                    $nl_result = $nlcheckout->BankCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount,
                        $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile,
                        $buyer_address, $array_items);
                } elseif ($payment_method == "NH_OFFLINE") {
                    $nl_result = $nlcheckout->officeBankCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
                } elseif ($payment_method == "ATM_OFFLINE") {
                    $nl_result = $nlcheckout->BankOfflineCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);

                } elseif ($payment_method == "IB_ONLINE") {
                    $nl_result = $nlcheckout->IBCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
                } elseif ($payment_method == "CREDIT_CARD_PREPAID") {

                    $nl_result = $nlcheckout->PrepaidVisaCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items, $bank_code);
                }

                //var_dump($nl_result); die;
                if ($nl_result->error_code == '00') {
                    //Cập nhât order với token  $nl_result->token để sử dụng check hoàn thành sau này
                    return redirect($nl_result->checkout_url);
                } else {
                    // echo $nl_result->error_message;
                }
            } else {
                // echo "<h3> Bạn chưa nhập đủ thông tin khách hàng </h3>";
            }
        }
        return view('taikhoan.nap-tien', [
            'nlcheckout' => $nlcheckout,
            'total_amount' => $total_amount,
        ]);
    }

    /**
     * @link /nap-tien/{orderid}
     * @param String orderid
     */
    public function cancel(Request $request, $orderid)
    {
        return view('taikhoan.order-cancel', [
            'orderid' => $orderid,
        ]);
    }

    /**
     * @link /nap-tien/ket-qua
     * @param String orderid
     */
    public function success(Request $request)
    {
        $result = "Kết quả thanh toán";
        if (empty($request->token)) {
            return redirect()->route('naptien');
        }

        $nlcheckout = new NL_CheckOutV3(MERCHANT_ID, MERCHANT_PASS, RECEIVER, URL_API);
        $nl_result = $nlcheckout->GetTransactionDetail($request->token);
        if ($nl_result) {
            $nl_errorcode = (string)$nl_result->error_code;
            $nl_transaction_status = (string)$nl_result->transaction_status;
            if ($nl_errorcode == '00') {
                if ($nl_transaction_status == '00') {
                    // trạng thái thanh toán thành công
                    $user_id = $request->session()->get('user')->user_id;
                    $user = \App\Users::where('user_id', $user_id)->first();
                    $user->paid = 1;
                    $user->balance += intval($nl_result->total_amount);

                    $status = \App\Model\UserOrder::firstOrCreate([
                        'user_id' => $user_id,
                        'code' => strval($nl_result->order_code),
                        'money' => intval($nl_result->total_amount),
                        'token' => strval($nl_result->token),
                    ]);
                    if ($user->save() && $status) {
                        $result = "Thanh toán thành công!";
                    }
                }
            } else {
                $result = $nlcheckout->GetErrorMessage($nl_errorcode);
                return redirect()->route('naptien')->withErrors($result);
            }
        }
        return view('taikhoan.order-success', [
            'result' => $result,
        ]);
    }

    // Thắng add 20181107 start

    /**
     * Kiểm tra ví tiền đủ để gọi hay không
     */
    public function kiemtravitien(Request $request)
    {
        $email = $request->get('email');
        if ($email == null) {
            header('Content-Type: application/json; charset=utf-8');
            return json_encode(array('isSuccess' => false, 'msg' => 'Không tìm thấy thông tin tài khoản!'), JSON_UNESCAPED_UNICODE);
        }
        $patient = \App\Patient::where('email', $email)->first();
        if ($patient == null) {
            $user = \App\Users::where('email', $email)->first();
            if ($user == null) {
                return json_encode(array('isSuccess' => false, 'msg' => 'Không tìm thấy thông tin tài khoản!'), JSON_UNESCAPED_UNICODE);
            }
            $user->createPatient();
            $patient = \App\Patient::where('email', $email)->first();
        }

        return json_encode(
            array(
                'isSuccess'         => true,
                'can_chat'          => $patient->can_chat,
                'can_call_audio'    => $patient->can_call_audio,
                'can_call_video'    => $patient->can_call_video
            )
        );
    }

    /**
     * Thêm tiền vào ví
     */
    public function naptienvaovi(Request $request)
    {
        $quantity = $request->get('quantity');
        $email = $request->get('email');
        $qty = 0;
        if ($quantity == null || $email == null) {
            header('Content-Type: application/json; charset=utf-8');
            return json_encode(array('isSuccess' => false, 'balance' => 0, 'msg' => 'Chưa Nhập Đầy Đủ Thông Tin!'), JSON_UNESCAPED_UNICODE);
        }
        try {
            $qty = intval($quantity);
            if ($qty <= 0) {
                return json_encode(array('isSuccess' => false,'balance' => 0, 'msg' => 'Sai định dạng dữ liệu!'), JSON_UNESCAPED_UNICODE);
            }
        } catch (Exception $exception) {
            return json_encode(array('isSuccess' => false,'balance' => 0, 'msg' => 'Sai định dạng dữ liệu!'), JSON_UNESCAPED_UNICODE);
        }

        $patient = \App\Patient::where('email', $email)->first();
        if ($patient == null) {
            $user = \App\Users::where('email', $email)->first();
            if ($user == null) {
                return json_encode(array('isSuccess' => false, 'balance' => 0, 'msg' => 'Không tìm thấy thông tin tài khoản!'), JSON_UNESCAPED_UNICODE);
            }
            $user->createPatient();
            $patient = \App\Patient::where('email', $email)->first();
        }
        $patient->balance += $qty;
        $patient->updated_at = new \DateTime();
        if ($patient->save()) {
            $patient->createRecharge($qty);
			$unit = \App\Config::where('id', 2)->first();
			$unit = (!empty($unit)) ? intval($unit->content) : 1000;
			if($patient->balance > $unit) {
				$patient->can_chat = 1;
				$patient->can_call_audio = 1;
				$patient->can_call_video = 1;
				$patient->save();
				$user = \App\Users::where('email', $email)->first();
				$user->paid = 1;
				$user->save();
			}
        };

        return json_encode(array('isSuccess' => true, 'balance' => $patient->balance, 'msg' => 'Đã nạp tiền thành công!'));
    }

    public function lichsunaptien(Request $request){
        $email = $request->get('email');
        if ($email == null) {
            header('Content-Type: application/json; charset=utf-8');
            return json_encode(array('isSuccess' => false, 'msg' => 'Không tìm thấy thông tin tài khoản!'), JSON_UNESCAPED_UNICODE);
        }
        $patient = \App\Patient::where('email', $email)->first();
        if ($patient == null) {
            $user = \App\Users::where('email', $email)->first();
            if ($user == null) {
                return json_encode(array('isSuccess' => false, 'msg' => 'Không tìm thấy thông tin tài khoản!'), JSON_UNESCAPED_UNICODE);
            }
            $user->createPatient();
            $patient = \App\Patient::where('email', $email)->first();
        }
        $recharges = $patient->recharges();
        return $recharges;
    }

    public function testapi(Request $request)
    {
        return json_encode(array('isSuccess' => false, 'msg' => 'Không tìm thấy thông tin tài khoản!'), JSON_UNESCAPED_UNICODE);
    }
    // Thắng add 20181107 end
}
