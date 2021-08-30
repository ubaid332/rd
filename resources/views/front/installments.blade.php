@extends('front/layout')
@section('page_title','Installment Page')
@section('container')

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
   <div class="aa-catg-head-banner-area">
     <div class="container">
        <h1>Installment</h1>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->         

  <section>
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        
       </div>

     </div>

     <div class="row">
        <div class="col-md-8">
          <h2>Leasing Rules & Regulations</h2>
          <ul class="heade" style="line-height: 40px;font-size: 16px;">
            <img style="height: 15px;" src="https://lahorecentre.com/wp-content/uploads/2021/02/hand.svg">  Applying for installments is absolutely free.<br>
            <img style="height: 15px;" src="https://lahorecentre.com/wp-content/uploads/2021/02/hand.svg">  Guarantee of one friend or relative must be required.<br>
            <img style="height: 15px;" src="https://lahorecentre.com/wp-content/uploads/2021/02/hand.svg">  Lahore Centre has a right to reject any application without telling any reason.<br>
            <img style="height: 15px;" src="https://lahorecentre.com/wp-content/uploads/2021/02/hand.svg">  Verification in one working day and next day delivery.<br>
            <img style="height: 15px;" src="https://lahorecentre.com/wp-content/uploads/2021/02/hand.svg">  If the amount exceeds from Rs.100,000 a cheque from guaranter Bank Account could be asked.<br>
            <img style="height: 15px;" src="https://lahorecentre.com/wp-content/uploads/2021/02/hand.svg">  Lahore Centre will take postdated cheques from customer Bank Account of total amounts by the name of " Lahore Leasing".<br>
            <img style="height: 15px;" src="https://lahorecentre.com/wp-content/uploads/2021/02/hand.svg">  Lease can be planned from 3, to 12 months.<br>
            
            
            </ul>
        </div>

        <div class="col-md-4">
            <h2>Installment Calculator</h2>
            <h2 style="color:green; margin-top: 15px;" id="itemnamediviewer"><small style="color:black">Calculate Installment Plan for </small><br>Order # {{$order_id}}</h2>
            
           
                <br>
                <br>
                                        <!--<form method="post">-->
                <div class="row" style="margin-top:-30px;">
                        <div class="col-xs-7">
                                <label>Total Amount: </label>
                        </div>
                <div class="col-xs-5">
                    <input type="text" class="form-control" placeholder="Rs." value="{{$total_amount}}" id="totalAmount"  readonly="readOnly" style="border-color: darkgray;">
                            </div>
                            </div>

                            <div class="row" style="margin-top:-30px;">
                                <div class="col-xs-7">
                                        <label>Payable Amount (+15%): </label>
                                </div>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" placeholder="Rs." value="{{$total_amount+($total_amount*15/100)}}" id="totalAmountPayable"  readonly="readOnly" style="border-color: darkgray;">
                                    </div>
                                    </div>
                            
                        <div class="row">
                            <div class="col-xs-7">
                                <label>Down Payment: </label>
                            </div>
                            <div class="col-xs-5">
                                <input class="form-control" readonly onkeyup="ClearErrorPercentage()" type="text" value="{{(($total_amount+($total_amount*15/100))*25)/100}}" id="downPayment" placeholder="min. 25%">
								</div>
                                <div class="col-xs-4">
                                    <label style="font-size: 18px; margin-top: 5px;" id="downPaymentValue"></label>
                                </div>
                            </div>

                    
                                                                
                                                                <div class="row">
                                                                    <div class="col-xs-4"></div>
                                                                    <div class="col-xs-7">
                                                                        <label id="downPayment-error-valueee" style="color: orange;margin-top:-65px;"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-4"></div>
                                                                    <div class="col-xs-7">
                                                                        <label id="downPayment-error" style="color: red; margin-top: -38px; display: none;">Error: Down Pyment must be at least 25%</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top:-50px;">
                                                                    <div class="col-xs-4">
                                                                        <label>Installment Plan: </label>
                                                                    </div>
                                                                    <div class="col-xs-8" id="installmentplanselecter">
                                                                        <span aria-hidden="false" class="">
                                                                            <input type="radio" name="installmentPlan" value="3" onclick="calculatePlaninstalmentselecter()" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false">
                                                                            <span style="margin-left: 10px;">3 Monthly Installments</span><br></span>
                                                                            <span aria-hidden="false" class=""><input type="radio" name="installmentPlan" value="6" onclick="calculatePlaninstalmentselecter()" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false">
                                                                                <span style="margin-left: 10px;">6 Monthly Installments</span><br></span>
                                                                                <span aria-hidden="false" class=""><input type="radio" name="installmentPlan" value="12" onclick="calculatePlaninstalmentselecter()" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false">
                                                                                    <span style="margin-left: 10px;">12 Monthly Installments</span><br></span></div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-xs-4">
                                                                                                        <label style="margin-top: 3px !important">Montly Installment: </label>
                                                                                                    </div>
                                                                                                    <div class="col-xs-8">
                                                                                                        <label id="resultAmount" style="color: #CE2027; font-size: 18px;">Rs.0.00/- only</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-xs-4"></div>
                                                                                                    <div class="col-xs-8">
                                                                                                        <!-- onclick="calculateInstallemt()"  -->
                                                                                                        <!--<button type="button" class="btn" style="background-color: #CE2027 !important; color: white !important;" onclick="calculateInstallemtPackageBtn()" value="Calculate">Calculate</button>-->
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!--</form>-->
                                                                                            </div>

        
        
      </div>
   </div>
   <br><hr>
   <div class="container bg-danger" style="padding: 30px; margin-bottom:30px;">
       <div class="row">
           <div class="col-md-4">
            <div class="alert alert-success msg" style="display: none"></div>
            <form id="payment-installments-form">
                <div class="form-group">
                <label for="Date">Date</label>
                <input type="date" name="date" class="form-control">
                </div>

                <div class="form-group">
                <label for="Date">Detail</label>
                <input type="text" name="detail" class="form-control">
                </div>

                <div class="form-group">
                <label for="Date">Amount</label>
                <input type="text" name="amount" class="form-control">
                </div>
                <input type="hidden" name="order_id" value="{{ \Request::segment(2) }}" >
                <br>
                <input type="submit" class="btn btn-light" value="Save Record">
            </form>

           </div>
           <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr><th>Transaction ID</th><th>Date</th><th>Detail</th><th>Amount</th><th>Status</th></tr>
                </thead>
                <tbody id="installment_list">

                </tbody>
                

              </table>
           </div>
       </div>
   </div>
 </section>   
 <input type="hidden" id="qty" value="1"/>
  <form id="frmAddToCart">
    <input type="hidden" id="size_id" name="size_id"/>
    <input type="hidden" id="color_id" name="color_id"/>
    <input type="hidden" id="pqty" name="pqty"/>
    <input type="hidden" id="product_id" name="product_id"/>           
    @csrf
  </form>  

 
<input type="hidden" id="order_id" value="{{ \Request::segment(2) }}" >

@endsection