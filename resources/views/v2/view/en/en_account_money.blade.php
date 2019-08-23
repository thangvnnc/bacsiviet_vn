
    <form name="NLpayBank" action="https://medixlink.com/en/naptien" method="post">
        {{csrf_field()}}
        <h2>Deposit information</h2>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <ul class="alert alert-danger">
                    <li>{{ $error }}</li>
                </ul>
            @endforeach
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table style="clear:both;width:100%;max-width:500px;padding-left:46px;"> 
            <tr>
                <td>
                     <ul>
                         <li>
                            <input type="radio" id="total_amount1" name="total_amount" value="50000" checked>
                            <label for="total_amount1">VND 50.000</label>
                         </li>
                         <li>
                            <input type="radio" id="total_amount2" name="total_amount" value="100000" {{($total_amount == 100000)? 'checked' : ''}}>
                            <label for="total_amount2">VND 100.000</label>
                         </li>
                         <li>
                            <input type="radio" id="total_amount3" name="total_amount" value="200000" {{($total_amount == 200000)? 'checked' : ''}}>
                            <label for="total_amount3">VND 200.000</label>
                         </li>
                     </ul>
                </td>
            </tr>
            <tr><td>Fullname: </td>
                <td>
                     <input type="text" style="width: 100%" id="fullname" name="buyer_fullname" class="field-check " value="{{Session::get('user')->fullname}}">
                </td>
            </tr>
            <tr><td>Email: </td>
                <td>
                     <input type="text" style="width: 100%" id="buyer_email" name="buyer_email" class="field-check " value="{{Session::get('user')->email}}">
                </td>
            </tr>
            <tr><td>Phone: </td>
                <td>
                     <input type="text" style="width: 100%" id="buyer_mobile" name="buyer_mobile" class="field-check " value="{{Session::get('user')->phone}}">
                </td>
            </tr>               
        </table>
        <br>
        <h2>Select a payment method</h2>
        <ul class="list-content">
            <li class="active">
                <label><input type="radio" value="NL" name="option_payment" selected="true">Payment by e-wallet with money</label>
                <div class="boxContent">
                    <p>
                    SAFETY AND PROTECTED online payment, using domestic and foreign bank cards or other convenient forms.
                    Being protected & licensed by the STATE BANK, the only e-wallet that has been the BEST favorite for 2 consecutive years, Ministry of Information and Communications awarded Sao Khue award
                    <br/> Transaction. Register for NganLuong.vn wallet for free<a href="https://www.nganluong.vn/?portal=nganluong&amp;page=user_register" target="_blank">here</a></p>
                </div>
            </li>
            <li>
                <label><input type="radio" value="ATM_ONLINE" name="option_payment">Online payment by domestic bank card</label>
                <div class="boxContent">
                    <p><i>
                    <span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Note </span>: You need to register for Internet-Banking or online payment service at the bank before proceeding.</i></p>
                                
                            <ul class="cardList clearfix">
                            <li class="bank-online-methods ">
                                <label for="vcb_ck_on">
                                    <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                    <input type="radio" value="BIDV"  name="bankcode" >
                                
                            </label></li>
                            <li class="bank-online-methods ">
                                <label for="vcb_ck_on">
                                    <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                    <input type="radio" value="VCB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="vnbc_ck_on">
                                    <i class="DAB" title="Ngân hàng Đông Á"></i>
                                    <input type="radio" value="DAB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="tcb_ck_on">
                                    <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                    <input type="radio" value="TCB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_mb_ck_on">
                                    <i class="MB" title="Ngân hàng Quân Đội"></i>
                                    <input type="radio" value="MB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_vib_ck_on">
                                    <i class="VIB" title="Ngân hàng Quốc tế"></i>
                                    <input type="radio" value="VIB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_vtb_ck_on">
                                    <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                    <input type="radio" value="ICB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_exb_ck_on">
                                    <i class="EXB" title="Ngân hàng Xuất Nhập Khẩu"></i>
                                    <input type="radio" value="EXB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_acb_ck_on">
                                    <i class="ACB" title="Ngân hàng Á Châu"></i>
                                    <input type="radio" value="ACB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_hdb_ck_on">
                                    <i class="HDB" title="Ngân hàng Phát triển Nhà TPHCM"></i>
                                    <input type="radio" value="HDB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_msb_ck_on">
                                    <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                    <input type="radio" value="MSB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_nvb_ck_on">
                                    <i class="NVB" title="Ngân hàng Nam Việt"></i>
                                    <input type="radio" value="NVB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_vab_ck_on">
                                    <i class="VAB" title="Ngân hàng Việt Á"></i>
                                    <input type="radio" value="VAB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_vpb_ck_on">
                                    <i class="VPB" title="Ngân Hàng Việt Nam Thịnh Vượng"></i>
                                    <input type="radio" value="VPB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="sml_atm_scb_ck_on">
                                    <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                    <input type="radio" value="SCB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="bnt_atm_pgb_ck_on">
                                    <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                    <input type="radio" value="PGB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="bnt_atm_gpb_ck_on">
                                    <i class="GPB" title="Ngân hàng TMCP Dầu khí Toàn Cầu"></i>
                                    <input type="radio" value="GPB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="bnt_atm_agb_ck_on">
                                    <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                    <input type="radio" value="AGB"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="bnt_atm_sgb_ck_on">
                                    <i class="SGB" title="Ngân hàng Sài Gòn Công Thương"></i>
                                    <input type="radio" value="SGB"  name="bankcode" >
                                
                            </label></li>   
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="BAB" title="Ngân hàng Bắc Á"></i>
                                    <input type="radio" value="BAB"  name="bankcode" >
                                
                            </label></li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="TPB" title="Tền phong bank"></i>
                                    <input type="radio" value="TPB"  name="bankcode" >
                                
                            </label></li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="NAB" title="Ngân hàng Nam Á"></i>
                                    <input type="radio" value="NAB"  name="bankcode" >
                                
                            </label></li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="SHB" title="Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)"></i>
                                    <input type="radio" value="SHB"  name="bankcode" >
                                
                            </label></li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="OJB" title="Ngân hàng TMCP Đại Dương (OceanBank)"></i>
                                    <input type="radio" value="OJB"  name="bankcode" >
                            </label></li>
                        </ul>
                </div>
            </li>
            <li>
                <label><input type="radio" value="IB_ONLINE" name="option_payment">Pay with Internet Banking</label>
                <div class="boxContent">
                    <p><i>
                        <span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Note </span>: You need to register for Internet-Banking or online payment service at the bank before proceeding.</i></p>
                    <ul class="cardList clearfix">
                        <li class="bank-online-methods ">
                            <label for="vcb_ck_on">
                                <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                <input type="radio" value="BIDV"  name="bankcode" >

                            </label></li>
                        <li class="bank-online-methods ">
                            <label for="vcb_ck_on">
                                <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                <input type="radio" value="VCB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="vnbc_ck_on">
                                <i class="DAB" title="Ngân hàng Đông Á"></i>
                                <input type="radio" value="DAB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="tcb_ck_on">
                                <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                <input type="radio" value="TCB"  name="bankcode" >

                            </label></li>
                    </ul>

                </div>
            </li>
            <li>
                <label><input type="radio" value="ATM_OFFLINE" name="option_payment">ATM payment offline</label>
                <div class="boxContent">
                    
                    <ul class="cardList clearfix">
                        <li class="bank-online-methods ">
                            <label for="vcb_ck_on">
                                <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                <input type="radio" value="BIDV"  name="bankcode" >

                            </label></li>
                            
                        <li class="bank-online-methods ">
                            <label for="vcb_ck_on">
                                <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                <input type="radio" value="VCB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="vnbc_ck_on">
                                <i class="DAB" title="Ngân hàng Đông Á"></i>
                                <input type="radio" value="DAB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="tcb_ck_on">
                                <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                <input type="radio" value="TCB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="sml_atm_mb_ck_on">
                                <i class="MB" title="Ngân hàng Quân Đội"></i>
                                <input type="radio" value="MB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="sml_atm_vtb_ck_on">
                                <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                <input type="radio" value="ICB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="sml_atm_acb_ck_on">
                                <i class="ACB" title="Ngân hàng Á Châu"></i>
                                <input type="radio" value="ACB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="sml_atm_msb_ck_on">
                                <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                <input type="radio" value="MSB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="sml_atm_scb_ck_on">
                                <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                <input type="radio" value="SCB"  name="bankcode" >

                            </label></li>
                        <li class="bank-online-methods ">
                            <label for="bnt_atm_pgb_ck_on">
                                <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                <input type="radio" value="PGB"  name="bankcode" >

                            </label></li>
                        
                         <li class="bank-online-methods ">
                            <label for="bnt_atm_agb_ck_on">
                                <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                <input type="radio" value="AGB"  name="bankcode" >

                            </label></li>
                        <li class="bank-online-methods ">
                            <label for="sml_atm_bab_ck_on">
                                <i class="SHB" title="Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)"></i>
                                <input type="radio" value="SHB"  name="bankcode" >

                            </label></li>
                    </ul>

                </div>
            </li>
            <li>
                <label><input type="radio" value="NH_OFFLINE" name="option_payment">Pay at the bank office</label>
                <div class="boxContent">
                    
                    <ul class="cardList clearfix">
                        <li class="bank-online-methods ">
                            <label for="vcb_ck_on">
                                <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                <input type="radio" value="BIDV"  name="bankcode" >

                            </label></li>
                        <li class="bank-online-methods ">
                            <label for="vcb_ck_on">
                                <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                <input type="radio" value="VCB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="vnbc_ck_on">
                                <i class="DAB" title="Ngân hàng Đông Á"></i>
                                <input type="radio" value="DAB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="tcb_ck_on">
                                <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                <input type="radio" value="TCB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="sml_atm_mb_ck_on">
                                <i class="MB" title="Ngân hàng Quân Đội"></i>
                                <input type="radio" value="MB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="sml_atm_vib_ck_on">
                                <i class="VIB" title="Ngân hàng Quốc tế"></i>
                                <input type="radio" value="VIB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="sml_atm_vtb_ck_on">
                                <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                <input type="radio" value="ICB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="sml_atm_acb_ck_on">
                                <i class="ACB" title="Ngân hàng Á Châu"></i>
                                <input type="radio" value="ACB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="sml_atm_msb_ck_on">
                                <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                <input type="radio" value="MSB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="sml_atm_scb_ck_on">
                                <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                <input type="radio" value="SCB"  name="bankcode" >

                            </label></li>
                        <li class="bank-online-methods ">
                            <label for="bnt_atm_pgb_ck_on">
                                <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                <input type="radio" value="PGB"  name="bankcode" >

                            </label></li>

                        <li class="bank-online-methods ">
                            <label for="bnt_atm_agb_ck_on">
                                <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                <input type="radio" value="AGB"  name="bankcode" >

                            </label></li>
                        <li class="bank-online-methods ">
                            <label for="sml_atm_bab_ck_on">
                                <i class="TPB" title="Tền phong bank"></i>
                                <input type="radio" value="TPB"  name="bankcode" >

                            </label></li>
                    </ul>
                </div>
            </li>
            <li>
                <label><input type="radio" value="VISA" name="option_payment" selected="true">Pay with Visa or MasterCard</label>
                <div class="boxContent">
                    <p><span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Note </span>: Visa or MasterCard.</p>
                    <ul class="cardList clearfix">
                            <li class="bank-online-methods ">
                                <label for="vcb_ck_on">
                                    Visa:
                                    <input type="radio" value="VISA"  name="bankcode" >
                                
                            </label></li>

                            <li class="bank-online-methods ">
                                <label for="vnbc_ck_on">
                                    Master:<input type="radio" value="MASTER"  name="bankcode" >
                            </label></li>
                    </ul>   
                </div>
            </li>
        </ul>
        
        <table style="clear:both;width:100%;max-width:500px;padding-left:46px;"> 
            <tr>
                <td>
                     <input class="thanhtoan" type="submit" name="nlpayment" value="Pay"/>
                </td>
            </tr>                   
        </table>
    </form> 
    <script src="https://www.nganluong.vn/webskins/javascripts/jquery_min.js" type="text/javascript"></script>      
    <script language="javascript">
        $('input[name="option_payment"]').bind('click', function() {
        $('.list-content li').removeClass('active');
        $(this).parent().parent('li').addClass('active');
        });
    </script>   