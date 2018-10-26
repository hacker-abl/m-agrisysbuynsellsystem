@extends(isAdmin() ? 'layouts.admin' : 'layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Purchases Dashboard</h2>
        </div>
    </div>

    <div class="modal fade" id="purchase_modal" tabindex="-1" role="dialog">
         <div class="modal-dialog" role="document">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="card">
                        <div class="header">
                             <h2 class="modal_title">Add Purchases</h2>
                             <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button id="print_purchase" type="button" class="btn bg-grey btn-xs waves-effect m-r-20" ><i class="material-icons">print</i></button>
                            </li>
                            <li class="dropdown">
                                <form method="POST" id="printForm" name="printForm" target="_blank" action="{{ route('print_purchase') }}">
                                <input type="hidden" name="button_action" id="button_action" value="">
                                <input type="hidden" id="ticket_clone" name="ticket_clone">
                                <input type="hidden" id="customer_clone" name="customer_clone">
                                <input type="hidden" id="commodity_clone" name="commodity_clone">
                                <input type="hidden" id="sacks_clone" name="sacks_clone">
                                <input type="hidden" id="ca_clone" name="ca_clone">
                                <input type="hidden" id="balance_clone" name="balance_clone">
                                <input type="hidden" id="partial_clone" name="partial_clone">
                                <input type="hidden" id="kilos_clone" name="kilos_clone">
                                <input type="hidden" id="price_clone" name="price_clone">
                                <input type="hidden" id="total_clone" name="total_clone">
                                <input type="hidden" id="amount_clone" name="amount_clone">
                                <input type="hidden" id="remarks_clone" name="remarks_clone">
                                <button class="btn btn-sm btn-icon print-icon" type="submit" name="print_form" id="print_form" title="PRINT ONLY"><i class="glyphicon glyphicon-print"></i></button>
                                </form>
                            </li>
                        </ul>
                        </div>
                        <div class="body">
                             <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" id ="homeclick" href="#home">Customer Purchases</a></li>
                                <li><a data-toggle="tab" id="homeclick1" href="#home1">Walk-in Purchases</a></li>
                             </ul>
                             <div class="clearfix"></div>
                             <br>

                              <div class="tab-content">
                             <div id="home" class="tab-pane fade in active">
                             <form class="form-horizontal " id="purchase_form">
                                   <input type="hidden" name="stat1" id="stat1" value="old">
                                  <input type="hidden" name="id" id="id" value="">
                                  <input type="hidden" name="balance1" id="balance1" value="">
                                  <input type="hidden" name="last" id="last" value="">
                                  <input type="hidden" name="pr" id="pr" value="">
                                  <input type="hidden" name="suki" id="suki" value="">
                                  <input type="hidden" name="customerID" id="customerID" value="">
                                  <input type="hidden" name="commodityID" id="commodityID" value="">
                                  <input type="hidden" name="caID" id="caID" value="">
                                  <input type="hidden" name="button_action1" id="button_action1" value="">
                                  <div class="row clearfix">
                                       <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Transaction Number</label>
                                       </div>
                                       <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                 <div class="form-line">
                                                      <input type="text" id="ticket" name="ticket" readonly="readonly" value="" class="form-control" required>
                                                 </div>
                                            </div>
                                       </div>
                                  </div>

                                  <div class="row clearfix">
                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="type">Customer</label>
                                  </div>
                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                             <select type="text" id="customer" name="customer" class="form-control" placeholder="Select company" required style="width:100%;">
                                                  @foreach($customer as $a)
                                                  <option value="{{ $a->id }}">{{ $a->lname }}, {{ $a->fname }} {{ $a->mname }}</option>
                                                  @endforeach
                                             </select>
                                        </div>
                                  </div>
                                 </div>

                                  <div class="row clearfix">
                                       <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="type">Commodity</label>
                                       </div>
                                       <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                 <select type="text" id="commodity" name="commodity" class="form-control" placeholder="Select item" required style="width:100%;">
                                                      @foreach($commodity as $a)
                                                      <option value="{{ $a->id }}">{{ $a->name }}</option>
                                                      @endforeach
                                                 </select>
                                            </div>
                                       </div>
                                  </div>

                                  <div class="row clearfix">
                                       <div class="col-md-4">
                                       <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 form-control-label">

                                       </div>
                                       <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                 <label for="name">Sacks</label>
                                                 <div class="form-line">
                                                      <input type="number" id="sacks"  name="sacks" class="form-control"   required>
                                                 </div>
                                            </div>
                                       </div>
                                  </div>
                                        <div class="col-md-4">
                                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 form-control-label">

                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                 <div class="form-group">
                                                      <label for="name">Kilograms</label>
                                                      <div class="form-line">
                                                           <input type="number" id="kilo" name="kilo" onkeyup="kilos1(this)" class="form-control"   required>
                                                      </div>
                                                 </div>
                                            </div>
                                         </div>
                                         <div class="col-md-4">
                                         <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">

                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                             <div class="form-group">
                                                  <label for="name">Price</label>
                                                  <div class="form-line">
                                                       <input type="text" id="price" name="price" readonly="readonly" value="" class="form-control" required>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                       </div>


                                  <div class="row clearfix">
                                       <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Cash Advance</label>
                                       </div>
                                       <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                 <div class="form-line">
                                                      <input type="text" id="ca" name="ca" readonly="readonly" value="" class="form-control" required>
                                                 </div>
                                            </div>
                                       </div>
                                  </div>

                                  <div class="row clearfix">
                                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                           <label for="name">Partial Payment</label>
                                      </div>
                                      <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                           <div class="form-group">
                                                <div class="form-line">
                                                     <input type="number" id="partial" name="partial" onkeyup="partial1(this)" class="form-control"   required>
                                                </div>
                                           </div>
                                      </div>
                                 </div>

                                  <div class="row clearfix">
                                       <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Balance</label>
                                       </div>
                                       <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                 <div class="form-line">
                                                      <input type="text" id="balance" name="balance" readonly="readonly" value="" class="form-control" required>
                                                 </div>
                                            </div>
                                       </div>
                                  </div>





                                  <div class="row clearfix">
                                       <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Total</label>
                                       </div>
                                       <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                 <div class="form-line">
                                                      <input type="text" id="total" name="total" readonly="readonly" value="" class="form-control" required>
                                                 </div>
                                            </div>
                                       </div>
                                  </div>

                                  <div class="row clearfix">
                                       <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Amount to Pay</label>
                                       </div>
                                       <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                 <div class="form-line">
                                                      <input type="text" id="amount" name="amount" readonly="readonly" value="" class="form-control" required>
                                                 </div>
                                            </div>
                                       </div>
                                  </div>

                                  <div class="row clearfix">
                                       <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="type">Remarks</label>
                                       </div>
                                       <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                 <select type="text" id="remarks" name="remarks" class="form-control" placeholder="Select item" required style="width:100%;">

                                                      <option value="Good">Good</option>
                                                      <option value="Immature">Immature</option>
                                                 </select>
                                            </div>
                                       </div>
                                  </div>




                                  <div class="row clearfix">
                                       <div class="modal-footer">
                                            <button type="submit" id="add_purchase" class="btn btn-link waves-effect">SAVE CHANGES</button>
                                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                       </div>
                                  </div>
                             </form>
                        </div>
                           <div id="home1" class="tab-pane fade in ">
                                <form class="form-horizontal " id="purchase_form1">
                                
                                     <input type="hidden" name="stat" id="stat" value="new">
                                     <input type="hidden" name="id1" id="id1" value="">
                                     <input type="hidden" name="balance2" id="balance2" value="">
                                     <input type="hidden" name="last1" id="last1" value="">
                                     <input type="hidden" name="pr1" id="pr1" value="">
                                     <input type="hidden" name="suki1" id="suki1" value="">
                                      <input type="hidden" name="ca1" id="ca1" value="">
                                      <input type="hidden" name="partial1" id="partial1" value="">
                                      <input type="hidden" name="balance1" id="balance1" value="">
                                       <input type="hidden" name="total1" id="total1" value="">
                                        <input type="hidden" name="pricenopad" id="pricenopad" value="">

                                        <input type="hidden" name="customerid" id="customerid" value="">

                                     <input type="hidden" name="button_action" id="button_action" value="">
                                     <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                               <label for="name">Transaction Number</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                               <div class="form-group">
                                                    <div class="form-line">
                                                         <input type="text" id="ticket1" name="ticket1" readonly="readonly" value="" class="form-control" required>
                                                    </div>
                                               </div>
                                          </div>
                                     </div>

                                     <div class="row clearfix">
                                          <div class="col-md-4">
                                          <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 form-control-label">

                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                               <div class="form-group">
                                                    <label for="name">First Name</label>
                                                    <div class="form-line">
                                                         <input type="text" id="fname"   name="fname" class="form-control"   required>
                                                    </div>
                                               </div>
                                          </div>
                                     </div>
                                           <div class="col-md-4">
                                               <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 form-control-label">

                                               </div>
                                               <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                         <label for="name">Middle Name</label>
                                                         <div class="form-line">
                                                              <input type="text" id="mname" name="mname"  class="form-control"   required>
                                                         </div>
                                                    </div>
                                               </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">

                                           </div>
                                           <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                     <label for="name">Last Name</label>
                                                     <div class="form-line">
                                                          <input type="text" id="lname" name="lname"  value="" class="form-control" required>
                                                     </div>
                                                </div>
                                           </div>
                                      </div>
                                          </div>

                                          <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                 <label for="lname">Address</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                 <div class="form-group">
                                                    <div class="form-line">
                                                         <input type="text" id="address" name="address" class="form-control" placeholder="Enter customer's address"  >
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="lname">Contacts</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" id="contacts" name="contacts" class="form-control" placeholder="Enter customer's contact number">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="lname">Cash Advance</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" id="bal" name="bal" class="form-control" placeholder="Enter customer's cash advance">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                               <label for="type">Commodity</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                               <div class="form-group">
                                                    <select type="text" id="commodity1" name="commodity1" class="form-control" placeholder="Select item" required style="width:100%;">
                                                         @foreach($commodity as $a)
                                                         <option value="{{ $a->id }}">{{ $a->name }} Price: {{ $a->price }}({{ $a->suki_price }})</option>
                                                         @endforeach
                                                    </select>
                                               </div>
                                          </div>
                                     </div>

                                     <div class="row clearfix">
                                          <div class="col-md-4">
                                          <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 form-control-label">

                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                               <div class="form-group">
                                                    <label for="name">Sacks</label>
                                                    <div class="form-line">
                                                         <input type="number" id="sacks1"   name="sacks1" class="form-control"   required>
                                                    </div>
                                               </div>
                                          </div>
                                     </div>
                                           <div class="col-md-4">
                                               <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 form-control-label">

                                               </div>
                                               <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                         <label for="name">Kilograms</label>
                                                         <div class="form-line">
                                                              <input type="number" id="kilo1" name="kilo1" onkeyup="kilos2(this)" class="form-control"   required>
                                                         </div>
                                                    </div>
                                               </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">

                                           </div>
                                           <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                     <label for="name">Price</label>
                                                     <div class="form-line">
                                                          <input type="text" id="price1" name="price1" readonly="readonly" value="" class="form-control" required>
                                                     </div>
                                                </div>
                                           </div>
                                      </div>
                                          </div>



                                     <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                               <label for="name">Total</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                               <div class="form-group">
                                                    <div class="form-line">
                                                         <input type="text" id="amount1" name="amount1" readonly="readonly" value="" class="form-control" required>
                                                    </div>
                                               </div>
                                          </div>
                                     </div>

                                     <div class="row clearfix">
                                          <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                               <label for="type">Remarks</label>
                                          </div>
                                          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                               <div class="form-group">
                                                    <select type="text" id="remarks1" name="remarks1" class="form-control" placeholder="Select item" required style="width:100%;">

                                                         <option value="Good">Good</option>
                                                         <option value="Immature">Immature</option>
                                                    </select>
                                               </div>
                                          </div>
                                     </div>




                                     <div class="row clearfix">
                                          <div class="modal-footer">
                                               <button type="submit" id="add_purchase1" class="btn btn-link waves-effect">SAVE CHANGES</button>
                                               <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                          </div>
                                     </div>
                                </form>
                           </div>
                      </div>
                        </div>
                   </div>
              </div>
         </div>
    </div>
    <div class="modal fade" id="release_purchase_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Are You Sure?</h2>
                    </div>
                    <div class="body">                      
                            <div class="row clearfix">
                                <div class="modal-footer">
                                    <button type="button" id="release_purchase_normal" class="btn btn-success waves-effect">CONTINUE</button>
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                </div>
                            </div>
          
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row clearfix">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                   <div class="header">
                        <h2>List of Purchases as of {{ date('Y-m-d ') }}</h2>
                             <ul class="header-dropdown m-r--5">
                                  <li class="dropdown">
                                       <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_purchase_modal"><i class="material-icons">library_add</i></button>
                                  </li>
                             </ul>
                        </div>
                        <div class="body">
                             <div class="table-responsive">
                              <p id="date_filter">
                                <h5>Date Range Filter</h5>
                                <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="purchase_datepicker_from" />
                                <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="purchase_datepicker_to" />
                            </p>
                            <br>
                                  <table id="purchasetable" class="table table-bordered table-striped table-hover  ">
                                       <thead>
                                            <tr>
                                                 <th width="100" style="text-align:center;">ID</th>

                                                 <th width="100" style="text-align:center;">Customer</th>
                                                 <th width="100" style="text-align:center;">mname</th>
                                                 <th width="100" style="text-align:center;">lname</th>
                                                 <th width="100" style="text-align:center;">Commodity</th>
                                                 <th width="100" style="text-align:center;">No. of Sacks</th>
                                                 <th width="100" style="text-align:center;">Cash Advance</th>
                                                 <th width="100" style="text-align:center;">Balance</th>
                                                 <th width="100" style="text-align:center;">Partial Payment</th>
                                                 <th width="100" style="text-align:center;" >No. of Kilos</th>
                                                 <th width="100" style="text-align:center;">Price</th>
                                                 <th width="100" style="text-align:center;">Total</th>
                                                 <th width="100" style="text-align:center;">Deducted</th>
                                                 <th width="100" style="text-align:center;">Date</th>
                                                 <th width="100" style="text-align:center;">Status</th>
                                                 <th width="100" style="text-align:center;">Released By</th>
                                                 <th width="100" style="text-align:center;">Remarks</th>
                                                 <th width="150" style="text-align:center;">Releasing</th>
                                            </tr>
                                       </thead>

                                       <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                  </table>
                             </div>
                        </div>
                   </div>
              </div>
         </div>
    </div>
@endsection

@section('script')
    <script>
    var purchasestable;
    var purchase_date_from;
    var purchase_date_to;
    var id;
    $(document).ready(function () {
        document.title = "M-Agri - Purchases";
        //Delete Purchases
        $(document).on('click', '.delete_purchase', function(){
            var id = $(this).attr('id');
            swal({
                title: "Are you sure?",
                text: "Delete this record?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    url:"{{ route('delete_purchases') }}",
                    method: "get",
                    data:{id:id},
                    success:function(data){
                        refresh_purchases_table();
                    }
                })
                swal("Deleted!", "The record has been deleted.", "success");
            });
        });

        $(document).on('click', '.edit_purchase', function(){
            var id = $(this).attr('id');
            $('.modal_title').text('Update Purchases');
                $.ajax({
                    url:"{{ route('update_purchases') }}",
                    method: 'get',
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        $('#button_action1').val('update');
                        $('#id').val(id);
                        $('#customer').select2('enable',false);

                        $("#customer").val(data.customer_id).trigger('change');
                        $('#customerID').val(data.customer_id);
                        $('#commodityID').val(data.commodity_id);
                        $('#caID').val(data.ca_id);
                        $('#ticket').val(data.trans_no);
                        $("#commodity").val(data.commodity_id).trigger('change');
                        $('#sacks').val(data.sacks);
                        $('#kilo').val(data.kilo);
                        $('#price').val(data.price);
                        $('#total').val(data.total);
                        $('#amount').val(data.amtpay);
                        $("#remarks").val(data.remarks).trigger('change');
                        var a = data.customer_id;
                        $.ajax({
                            url: "{{ route('find_amt') }}",
                            data: { id : a },
                            dataType:'json',
                            success: function(data) {
                                $('#ca').val(data.balance)
                                $('#balance').val(data.balance)
                                $('#balance1').val(data.balance)
                                $('#last').val(data.suki_type)
                            }
                        });
                        $('#purchase_modal').modal('show');
                    }
                })
            });

            $("#homeclick").on('click', function() {
                $('#stat').val("old");
                $('#stat1').val("old");
            });

            $("#homeclick1").on('click', function() {
                $('#stat').val("new");
                $('#stat1').val("new");
            });

            $('#last').val(1);
            $('#balance').val("0");
            $('#ca1').val("0");
            $('#partial').val("0");
            $.extend( $.fn.dataTable.defaults, {
                "language": {
                    processing: 'Loading.. Please wait'
                }
            });

            function number_format(number, decimals, dec_point, thousands_sep) {
                // Strip all characters but numerical ones.
                number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function (n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            purchasestable = $('#purchasetable').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
       
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\₱,]/g, '')*1 :
                            typeof i === 'number' ?
                            i : 0;
                    };
       
                    // Total over this page
                    pageTotal1 = api
                        .column( 4, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
       
                    // Update footer
                    $( api.column( 4 ).footer() ).html(
                        'Total: <br>₱' + number_format(pageTotal1,2)
                    );

                    // Total over this page
                    pageTotal2 = api
                        .column( 5, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
       
                    // Update footer
                    $( api.column( 5 ).footer() ).html(
                        'Total: <br>₱' + number_format(pageTotal2,2)
                    );

                    // Total over this page
                    pageTotal3 = api
                        .column( 6, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
       
                    // Update footer
                    $( api.column( 6 ).footer() ).html(
                        'Total: <br>₱' + number_format(pageTotal3,2)
                    );

                    // Total over this page
                    pageTotal4 = api
                        .column( 8, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
       
                    // Update footer
                    $( api.column( 8 ).footer() ).html(
                        'Total: <br>₱' + number_format(pageTotal4,2)
                    );

                    // Total over this page
                    pageTotal5 = api
                        .column( 9, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
       
                    // Update footer
                    $( api.column( 9 ).footer() ).html(
                        'Total: <br>₱' + number_format(pageTotal5,2)
                    );

                    // Total over this page
                    pageTotal6 = api
                        .column( 10, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
       
                    // Update footer
                    $( api.column( 10 ).footer() ).html(
                        'Total: <br>₱' + number_format(pageTotal6,2)
                    );
                },
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                    },
                    customize: function ( win ) {
                        var last = null;
                        var current = null;
                        var bod = [];
         
                        var css = '@page { size: landscape; }',
                            head = win.document.head || win.document.getElementsByTagName('head')[0],
                            style = win.document.createElement('style');
         
                        style.type = 'text/css';
                        style.media = 'print';
         
                        if (style.styleSheet){
                          style.styleSheet.cssText = css;
                        }
                        else{
                          style.appendChild(win.document.createTextNode(css));
                        }
         
                        head.appendChild(style);

                        $(win.document.body)
                            .css( 'font-size', '10pt' );
       
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    },
                    footer: true
                }],
              
                scrollX: true,
                order:[],
                columnDefs: [{
    			  	"targets": "_all", // your case first column
     				"className": "text-center",
 				},
				],
                ajax:{
                    url: "{{ route('refresh_purchases') }}",
                    // dataType: 'text',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        date_from: purchase_date_from,
                        date_to: purchase_date_to,
                    },
                },
                columns: [
                    {data: 'trans_no'},
                    {data:'wholename', name: 'customer.fname'  },
                    {data:'mname', name: 'customer.mname',visible:false  },
                    {data:'lname', name: 'customer.lname',visible:false  },
                    {data: 'commname', name: 'commodity.name'},
                    {data: 'sacks'},
                    {data: 'balance', name: 'balance.balance'},
                    {data: 'balance_id'},
                    {data: 'partial'},
                    {data: 'kilo'},
                    {data: 'price'},
                    {data: 'total'},
                    {data: 'amtpay'},
                    {data:'created_at'},
                    {data:'status'},
                    {data:'released_by'},
                    {data: 'remarks'},
                    {data: "action", orderable:false,searchable:false}
                ]
            });

            //Start of Date Range Filter
            $("#purchase_datepicker_from").datepicker({
                showOn: "button",
                buttonImage: 'assets/images/calendar2.png',
                buttonImageOnly: false,
                "onSelect": function(date) {
                    minDateFilter = new Date(date).getTime();
                    var df= new Date(date);
                    purchase_date_from= df.getFullYear() + "-" + (df.getMonth() + 1) + "-" + df.getDate();
                    $('#purchasetable').dataTable().fnDestroy();
                    purchasestable = $('#purchasetable').DataTable({
                        "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;
            
                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\₱,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
        
                            // Total over this page
                            pageTotal1 = api
                                .column( 4, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
            
                            // Update footer
                            $( api.column( 4 ).footer() ).html(
                                'Total: <br>₱' + number_format(pageTotal1,2)
                            );

                            // Total over this page
                            pageTotal2 = api
                                .column( 5, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
            
                            // Update footer
                            $( api.column( 5 ).footer() ).html(
                                'Total: <br>₱' + number_format(pageTotal2,2)
                            );

                            // Total over this page
                            pageTotal3 = api
                                .column( 6, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
            
                            // Update footer
                            $( api.column( 6 ).footer() ).html(
                                'Total: <br>₱' + number_format(pageTotal3,2)
                            );

                            // Total over this page
                            pageTotal4 = api
                                .column( 8, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
            
                            // Update footer
                            $( api.column( 8 ).footer() ).html(
                                'Total: <br>₱' + number_format(pageTotal4,2)
                            );

                            // Total over this page
                            pageTotal5 = api
                                .column( 9, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                
                            // Update footer
                            $( api.column( 9 ).footer() ).html(
                                'Total: <br>₱' + number_format(pageTotal5,2)
                            );

                            // Total over this page
                            pageTotal6 = api
                                .column( 10, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
            
                            // Update footer
                            $( api.column( 10 ).footer() ).html(
                                'Total: <br>₱' + number_format(pageTotal6,2)
                            );
                        },
                        dom: 'Bfrtip',
                        buttons: [{
                            extend: 'print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                            },
                            customize: function ( win ) {
                                var last = null;
                                var current = null;
                                var bod = [];
                
                                var css = '@page { size: landscape; }',
                                    head = win.document.head || win.document.getElementsByTagName('head')[0],
                                    style = win.document.createElement('style');
                
                                style.type = 'text/css';
                                style.media = 'print';
                
                                if (style.styleSheet){
                                style.styleSheet.cssText = css;
                                }
                                else{
                                style.appendChild(win.document.createTextNode(css));
                                }
                
                                head.appendChild(style);

                                $(win.document.body)
                                    .css( 'font-size', '10pt' );
            
                                $(win.document.body).find( 'table' )
                                    .addClass( 'compact' )
                                    .css( 'font-size', 'inherit' );
                            },
                            footer: true
                        }],
                        scrollX: true,
                        processing: true,
          
                        order:[],
                        columnDefs: [{
                            "targets": "_all", // your case first column
                            "className": "text-center",
                        }],
                        ajax:{
                            url: "{{ route('refresh_purchases') }}",
                            // dataType: 'text',
                            type: 'post',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                date_from: purchase_date_from,
                                date_to: purchase_date_to,
                            },
                        },
                        columns: [
                            {data: 'trans_no'},
                            {data:'wholename', name: 'customer.fname' },
                            {data:'mname', name: 'customer.mname',visible:false  },
                            {data:'lname', name: 'customer.lname',visible:false  },
                            {data: 'commname', name: 'commodity.name'},
                            {data: 'sacks'},
                            {data: 'balance', name: 'balance.balance'},
                            {data: 'balance_id'},
                            {data: 'partial'},
                            {data: 'kilo'},
                            {data: 'price'},
                            {data: 'total'},
                            {data: 'amtpay'},
                            {data:'created_at'},
                            {data:'status'},
                            {data:'released_by'},
                            {data: 'remarks'},
                            {data: "action", orderable:false,searchable:false}
                        ]
                    });
                }
            }).keyup(function() {
                minDateFilter = new Date(this.value).getTime();
            });

            $("#purchase_datepicker_to").datepicker({
                showOn: "button",
                buttonImage: 'assets/images/calendar2.png',
                buttonImageOnly: false,
                "onSelect": function(date) {
                    maxDateFilter = new Date(date).getTime();
                    //oTable.fnDraw();
                    var dt= new Date(date);
                    purchase_date_to =dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate();
                    $('#purchasetable').dataTable().fnDestroy();
                    purchasestable = $('#purchasetable').DataTable({
                        "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;
                
                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\₱,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
        
                            // Total over this page
                            pageTotal1 = api
                                .column( 4, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
        
                            // Update footer
                            $( api.column( 4 ).footer() ).html(
                                'Total: <br>₱' + number_format(pageTotal1,2)
                            );

                            // Total over this page
                            pageTotal2 = api
                                .column( 5, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
        
                            // Update footer
                            $( api.column( 5 ).footer() ).html(
                                'Total: <br>₱' + number_format(pageTotal2,2)
                            );

                            // Total over this page
                            pageTotal3 = api
                                .column( 6, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
        
                            // Update footer
                            $( api.column( 6 ).footer() ).html(
                                'Total: <br>₱' + number_format(pageTotal3,2)
                            );

                            // Total over this page
                            pageTotal4 = api
                                .column( 8, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
        
                            // Update footer
                            $( api.column( 8 ).footer() ).html(
                                'Total: <br>₱' + number_format(pageTotal4,2)
                            );

                            // Total over this page
                            pageTotal5 = api
                                .column( 9, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
        
                            // Update footer
                            $( api.column( 9 ).footer() ).html(
                                'Total: <br>₱' + number_format(pageTotal5,2)
                            );

                            // Total over this page
                            pageTotal6 = api
                                .column( 10, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
        
                            // Update footer
                            $( api.column( 10 ).footer() ).html(
                                'Total: <br>₱' + number_format(pageTotal6,2)
                            );
                        },
                        dom: 'Bfrtip',
                        buttons: [{
                            extend: 'print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                            },
                            customize: function ( win ) {
                                var last = null;
                                var current = null;
                                var bod = [];
                
                                var css = '@page { size: landscape; }',
                                    head = win.document.head || win.document.getElementsByTagName('head')[0],
                                    style = win.document.createElement('style');
                
                                style.type = 'text/css';
                                style.media = 'print';
            
                                if (style.styleSheet){
                                style.styleSheet.cssText = css;
                                }
                                else{
                                style.appendChild(win.document.createTextNode(css));
                                }
            
                                head.appendChild(style);

                                $(win.document.body)
                                    .css( 'font-size', '10pt' );
            
                                $(win.document.body).find( 'table' )
                                    .addClass( 'compact' )
                                    .css( 'font-size', 'inherit' );
                            },
                            footer: true
                        }],
                        scrollX: true,
                        processing: true,
               
                        order:[],
                        columnDefs: [{
                            "targets": "_all", // your case first column
                            "className": "text-center",
                        }],
                        ajax:{
                            url: "{{ route('refresh_purchases') }}",
                            // dataType: 'text',
                            type: 'post',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                            data: {
                                date_from: purchase_date_from,
                                date_to: purchase_date_to,
                            },
                        },
                        columns: [
                            {data: 'trans_no'},
                            {data:'wholename', name: 'customer.fname' },
                            {data:'mname', name: 'customer.mname',visible:false  },
                            {data:'lname', name: 'customer.lname',visible:false  },
                            {data: 'commname', name: 'commodity.name'},
                            {data: 'sacks'},
                            {data: 'balance', name:'balance.balance'},
                            {data: 'balance_id'},
                            {data: 'partial'},
                            {data: 'kilo'},
                            {data: 'price'},
                            {data: 'total'},
                            {data: 'amtpay'},
                            {data:'created_at'},
                            {data:'status'},
                            {data:'released_by'},
                            {data: 'remarks'},
                            {data: "action", orderable:false,searchable:false}
                        ]
                    });

                }
            }).keyup(function() {
                maxDateFilter = new Date(this.value).getTime();
                //oTable.fnDraw();
            });
            //End of Date Range Filter

            function refresh_purchase_table(){
                purchasestable.ajax.reload(); //reload datatable ajax
            }

            $(document).on('click', '#add_purchase', function(event){
                $('.modal_title').text('Add Purchase');
                $('#button_action').val('add');
               
                event.preventDefault();
                var input = $(this);
                var button =this;
                button.disabled = true;
                input.html('SAVING...');
                $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('add_purchases') }}",
                    method: 'POST',
                    dataType:'text',
                    data: $('#purchase_form').serialize(),
                    success:function(data){
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                        $("#customer").val('').trigger('change');
                        $("#commodity").val('').trigger('change');
                        swal("Success!", "Record has been added to database", "success")
                        $('#purchase_modal').modal('hide');
                        refresh_purchase_table();
                        $("#sacks").val("");
                        $("#kilo").val("");
                        $("#price").val("");
                        $("#sacks1").val("");
                        $("#kilo1").val("");
                        $("#price1").val("");
                        $("#fname").val("");
                        $("#mname").val("");
                        $("#lname").val("");
                        $("#amount1").val("");
                        $("#total").val("");
                        $("#amount").val("");
                        $("#ca").val("");
                        $("#balance").val("");

                        $("#partial").val("0");
                        $("#commodity").val('').trigger('change');
                        $("#commodity1").val('').trigger('change');
                        $("#customer").val('').trigger('change');
                        //refresh_delivery_table();
                    },
                    error: function(data){
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                        swal("Oh no!", "Something went wrong, try again.", "error")
                    }
                })
            });
            $(document).on('click', '.release_purchase', function(event){
                event.preventDefault();
                id = $(this).attr("id");
                console.log(id);
                $.ajax({
                    url:"{{ route('check_balance3') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        if(data == 0){
                            swal("Insufficient Balance!", "Contact Boss", "warning")
                            return;
                        }
                        else{
                            $('#release_purchase_modal').modal('show');
                        }
                    }
                })
            });

            $(document).on('click', '#release_purchase_normal', function(){
                $.ajax({
                    url:"{{ route('release_purchase') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        swal("Cash Released!", "Remaining Balance: ₱"+data.toFixed(2), "success")
                        $('#release_purchase_modal').modal('hide');
                        $('#curCashOnHand').html(data.toFixed(2));

                        refresh_purchase_table();
                    }
                })
            });


            $("#print_purchase").click(function(event) {
                event.preventDefault();
                if($('#stat1').val()=="old"){
                    $("#add_purchase").trigger("click");
                }else if($('#stat').val()=="new"){
                    $("#add_purchase1").trigger("click");
                }
                $("#print_form").trigger("click");
            });

            $("#print_form").click(function(event) {
                if($('#stat1').val()=="old"){
                    $("#ticket_clone").val($("#ticket").val());
                    $("#customer_clone").val($("#customer option:selected").text());
                    $("#commodity_clone").val($("#commodity option:selected").text());
                    $("#sacks_clone").val($("#sacks").val());
                    $("#ca_clone").val($("#ca").val());
                    $("#balance_clone").val($("#balance").val());
                    $("#partial_clone").val($("#partial").val());
                    $("#kilos_clone").val($("#kilo").val());
                    $("#price_clone").val($("#price").val());
                    $("#total_clone").val($("#total").val());
                    $("#amount_clone").val($("#amount").val());
                    $("#remarks_clone").val($("#remarks").val());
                }else if($('#stat').val()=="new"){
                    $("#ticket_clone").val($("#ticket1").val());
                    $("#customer_clone").val($("#fname").val()+" "+$("#mname").val()+" "+$("#lname").val());
                    $("#commodity_clone").val($("#commodity1 option:selected").text());
                    $("#sacks_clone").val($("#sacks1").val());
                    $("#ca_clone").val("0");
                    $("#balance_clone").val("0");
                    $("#partial_clone").val("0");
                    $("#kilos_clone").val($("#kilo1").val());
                    $("#price_clone").val($("#price1").val());
                    $("#total_clone").val($("#amount1").val());
                    $("#amount_clone").val($("#amount1").val());
                    $("#remarks_clone").val($("#remarks1").val());
                }
            });

            $(document).on('click', '#add_purchase1', function(event){
                var input = $(this);
                var button =this;
                button.disabled = true;
                input.html('SAVING...'); 
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('add_purchases') }}",
                    method: 'POST',
                    dataType:'text',
                    data: $('#purchase_form1').serialize(),
                    success:function(data){
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                        $("#sacks1").val("");
                        $("#kilo1").val("");
                        $("#price1").val("");
                        $("#contact").val("");
                        $("#address").val("");
                        $("#bal").val("");
                        $("#fname").val("");
                        $("#mname").val("");
                        $("#lname").val("");
                        $("#amount1").val("");
                        $("#commodity1").val('').trigger('change');
                        swal("Success!", "Record has been added to database", "success")
                        $('#purchase_modal').modal('hide');
                        refresh_purchase_table();
                        //refresh_delivery_table();
                    },
                    error: function(data){
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                        swal("Oh no!", "Something went wrong, try again.", "error")
                    }
                })
            });
            
            $('#partial').on('keyup keydown', function (e) {
                if (e.which == 8) {

                    if($('#balance').val()!=""){
                        var a = 0;
                        var b = parseFloat($('#balance').val());
                        var d = parseFloat($('#ca').val());
                        var c = 0;
                        var e =0;
         		        if($('#partial').val()!=""){
         			        a = parseFloat($('#partial').val());

         			        if($('#total').val()!=""){
         				        e = parseFloat($('#total').val());
         			        }
                             x = a+e;
                             var temp3 =  parseFloat(x).toFixed(2);
         			        $('#amount').val(temp3)
         		        }
                        c = d-a;

                        if(c <= d){
         		            $('#balance').val(c);

         		            if($('#total').val()!=""){
         			             e = parseFloat($('#total').val());
         		            }
         		            x = e-a;
                             var temp3 =  parseFloat(x).toFixed(2);
         		            if($('#total').val()=="" && $('#partial').val()==""){
                                $('#amount').val('');
                                $('#total').val('');
         		            }
         		            else{
         			            $('#amount').val(temp3);
         		            }
         	            }
                    }
                    else if ($('#balance').val()==""){
                        var d = parseFloat($('#ca').val());
                        $('#balance').val(d);
                    }
                }
         	});
        });

        function sacks1(value) {
            var a = 0;
            var b = parseFloat($('#price').val());
            var d = 0;
            var c = 0;
            var e = 0;
            var r = 0;
            var x = 0;
            var t = 0;
            var z = 0;
            if($('#price').val()!=""){
                a = 0;
                d = a*50;
                if($('#sacks').val()==""){
                    $('#total').val("");
                    if($('#partial').val()!="" || $('#total').val()!=""){
                        if($('#partial').val()!=""){
                            r = parseFloat($('#partial').val());
                        }
                        if($('#total').val()!=""){
                            t = parseFloat($('#total').val());
                        }
                        var temp2 = t+r;
                      var temp3 =  parseFloat(temp2).toFixed(2);
                        $('#amount').val(temp3);
                        console.log(temp2);
                    }
                    else{
                        $('#amount').val("");
                    }
                }
                else{
                    c = d*b;
                    var temp = c + r;
                    var temporary =  parseFloat(c).toFixed(2);
                    $('#total').val(temporary);
                    var temp3 =  parseFloat(temp).toFixed(2);
                    $('#amount').val(temp3);
                    if($('#partial').val()!=""){
                        r = parseFloat($('#partial').val());
                        temp = c + r;
                        var temp3 =  parseFloat(temp).toFixed(2);
                        $('#amount').val(temp3);
                    }
                    if($('#total').val()!=""){
                        t = parseFloat($('#total').val());
                        temp = c + r;
                        var temp3 =  parseFloat(temp).toFixed(2);
                        $('#amount').val(temp3);
                    }

                    if($('#kilo').val()== ""){
                        temp = c + r;
                        var temp3 =  parseFloat(temp).toFixed(2);
                        $('#amount').val(temp3);
                    }
                }
                if($('#kilo').val()!=""){
                    e = parseFloat($('#kilo').val());
                    x = b*e;
                    z = x+c;
                    var temp1 = z + r;
                    var temporary =  parseFloat(z).toFixed(2);
                    $('#total').val(temporary);
                    var temp3 =  parseFloat(temp1).toFixed(2);
                    $('#amount').val(temp3);
                }
            }
        }

        function kilos1(value) {
            var a = 0;
            var b = parseFloat($('#price').val());
            var c = 0;
            var d = 0 ;
            var i = 0;
            var e = 0;
            var x = 0;
            var z = 0;
            var r = 0;
            var t = 0;
            if($('#price').val()!=""){
                a = parseFloat($('#kilo').val());
                if($('#kilo').val()==""){
                    $('#total').val("");
                    if($('#partial').val()!="" || $('#total').val()!=""){
                        if($('#partial').val()!=""){
                            r = parseFloat($('#partial').val());
                        }
                        if($('#total').val()!=""){
                            t = parseFloat($('#total').val());
                        }
                        var temp2 = t+r;
                        var temp3 =  parseFloat(temp2).toFixed(2);
                        $('#amount').val(temp3);
                    }
                    else{
                         $('#amount').val("");
                    }
                }
                else{
                    c = a*b;
                    var temp = c + r;
                    var temporary =  parseFloat(c).toFixed(2);
                    $('#total').val(temporary);
                    var temp3 =  parseFloat(temp).toFixed(2);
                    $('#amount').val(temp3);
                    if($('#partial').val()!=""){
                        r = parseFloat($('#partial').val());
                        temp = c + r;
                        var temp3 =  parseFloat(temp).toFixed(2);
                        $('#amount').val(temp3);
                    }
                    if($('#total').val()!=""){
                        t = parseFloat($('#total').val());
                        temp = c + r;
                        var temp3 =  parseFloat(temp).toFixed(2);
                        $('#amount').val(temp3);
                    }
                    if($('#sacks').val()==""){
                        temp = c + r;
                        var temp3 =  parseFloat(temp).toFixed(2);
                        $('#amount').val(temp3);
                    }
                }
                if($('#sacks').val()!=""){
                    e = 0;
                    x = b*(e*50);
                    z = x+c ;
                    i = x+c+r ;
                    var temp3 =  parseFloat(i).toFixed(2);
                    var temporary =  parseFloat(z).toFixed(2);
                    $('#total').val(temporary);
                    $('#amount').val(temp3);
                }
            }
        }

        function partial1(value) {
            if(value.which != 8 && isNaN(String.fromCharCode(value.which))){
                if($('#balance').val()!=""){
                    var a = 0;
                    var b = parseFloat($('#balance').val());
                    var d = parseFloat($('#ca').val());
                    var c = 0;
                    var e =0;
                    if($('#partial').val()!=""){
                        a = parseFloat($('#partial').val());

                        if($('#total').val()!=""){
                            e = parseFloat($('#total').val());
                        }
                        x = a+e;
                        var temp3 =  parseFloat(x).toFixed(2);
                        $('#amount').val(temp3)
                    }
                    c = d-a;
                    $('#balance').val(c);
               
                    if($('#total').val()!=""){
                        e = parseFloat($('#total').val());
                    }
                    x = e-a;
                    var temp3 =  parseFloat(x).toFixed(2);
                    $('#amount').val(temp3)
                }
            }
        }

        function sacks2(value) {
            var a = 0;
            var b = parseFloat($('#price1').val());
            var d = 0;
            var c = 0;
            var e = 0;
            var r = 0;
            var x = 0;
            var t = 0;
            var z = 0;
            if($('#price1').val()!=""){
                a = 0;
                d = a*50;
                if($('#sacks1').val()==""){
                    $('#total1').val("");
                    if($('#partial1').val()!="" || $('#total1').val()!=""){
                        if($('#partial1').val()!=""){
                            r = parseFloat($('#partial1').val());
                        }
                        if($('#total1').val()!=""){
                            t = parseFloat($('#total1').val());
                        }
                        var temp2 = t+r;
                        var temp3 =  parseFloat(temp2).toFixed(2);
                        $('#amount1').val(temp3);
                        console.log(temp2);
                    }
                    else{
                        $('#amount1').val("");
                    }
                }
                else{
                    c = d*b;
                    var temp = c + r;
                    $('#total1').val(c);
                    $('#amount1').val(temp);
                    //console.log(c+r);
                    if($('#partial1').val()!=""){
                        r = parseFloat($('#partial1').val());
                        temp = c + r;
                        var temp3 =  parseFloat(temp).toFixed(2);
                        $('#amount1').val(temp3);
                    }
                    if($('#total1').val()!=""){
                        t = parseFloat($('#total1').val());
                        temp = c + r;
                        var temp3 =  parseFloat(temp).toFixed(2);
                        $('#amount1').val(temp3);
                    }

                    if($('#kilo1').val()== ""){
                        temp = c + r;
                        var temp3 =  parseFloat(temp).toFixed(2);
                        $('#amount1').val(temp3);
                    }
                }
                if($('#kilo1').val()!=""){
                    e = parseFloat($('#kilo1').val());
                    x = b*e;
                    z = x+c;
                    var temp1 = z + r;
                    var tempo =  parseFloat(z).toFixed(2);
                    $('#total1').val(tempo);
                    var temp3 =  parseFloat(temp1).toFixed(2);
                    $('#amount1').val(temp3);
                }
            }
        }

        function kilos2(value) {
            var a = 0;
            var b = parseFloat($('#price1').val());
            var c = 0;
            var d = 0 ;
            var i = 0;
            var e = 0;
            var x = 0;
            var z = 0;
            var r = 0;
            var t = 0;
            if($('#price1').val()!=""){
                a = parseFloat($('#kilo1').val());
                if($('#kilo1').val()==""){
                    $('#total1').val("");
                    if($('#partial1').val()!="" || $('#total1').val()!=""){
                        if($('#partial1').val()!=""){
                            r = parseFloat($('#partial1').val());
                        }
                        if($('#total1').val()!=""){
                            t = parseFloat($('#total1').val());
                        }
                        var temp2 = t+r;
                        var temp3 =  parseFloat(temp2).toFixed(2);
                        $('#amount1').val(temp3);
                    }
                    else{
                        $('#amount1').val("");
                    }
                }
                else{
                    c = a*b;
                    var temp = c + r;
                    var tempo =  parseFloat(c).toFixed(2);
                    $('#total1').val(tempo);
                    var temp3 =  parseFloat(temp).toFixed(2);
                    $('#amount1').val(temp3);
                    if($('#partial1').val()!=""){
                        r = parseFloat($('#partial1').val());
                        temp = c + r;
                        var temp3 =  parseFloat(temp).toFixed(2);
                        $('#amount1').val(temp3);
                    }
                    if($('#total1').val()!=""){
                        t = parseFloat($('#total1').val());
                        temp = c + r;
                        var temp3 =  parseFloat(temp).toFixed(2);
                        $('#amount1').val(temp3);
                    }
                    if($('#sacks1').val()=="")
                    {
                        temp = c + r;
                        var temp3 =  parseFloat(temp).toFixed(2);
                        $('#amount1').val(temp3);
                    }
                }
                if($('#sacks1').val()!=""){
                    e =0;
                    x = b*(e*50);
                    z = x+c ;
                    i = x+c+r ;
                    var tempo =  parseFloat(z).toFixed(2);
                    $('#total1').val(tempo);
                    var temp3 =  parseFloat(i).toFixed(2);
                    $('#amount1').val(temp3);
                }
            }
        }

        function partial2(value) {
            if(value.which != 8 && isNaN(String.fromCharCode(value.which))){
                if($('#balance1').val()!=""){
                    var a = 0;
                    var b = parseFloat($('#balance1').val());
                    var d = 0;
                    var c = 0;
                    var e =0;
                    if($('#partial').val()!=""){
                        a = parseFloat($('#partial1').val());
                        if($('#total1').val()!=""){
                            e = parseFloat($('#total1').val());
                        }
                        x = a+e;
                        var temp3 =  parseFloat(x).toFixed(2);
                        $('#amount1').val(temp3)
                    }

                    c = d-a;
                    $('#balance1').val(c);
                    if($('#total1').val()!=""){
                        e = parseFloat($('#total1').val());
                    }
                    x = a+e;
                    var temp3 =  parseFloat(x).toFixed(2);
                    $('#amount1').val(temp3)
                }
            }
        }

        $(document).on("click","#link",function(){
            $("#bod").toggleClass('overlay-open');
        });

        $(document).ready(function() {

      
            $.extend( $.fn.dataTable.defaults, {
                "language": {
                    processing: 'Loading.. Please wait'
                }
            });

            $(document).on('click','.open_purchase_modal', function(){
                $('.modal_title').text('Add Purchase');
                $('#button_action').val('add');
                $('#button_action1').val('add');
                $('#customer').select2('enable');
                $("#customer").val('').trigger('change');
                $("#commodity").val('').trigger('change');
                       
                $('#purchase_modal').modal('hide');
                    
                $("#sacks").val("");
                $("#kilo").val("");
                $("#price").val("");
                $("#sacks1").val("");
                $("#kilo1").val("");
                $("#price1").val("");
                $("#fname").val("");
                $("#mname").val("");
                $("#lname").val("");
                $("#amount1").val("");
                $("#total").val("");
                $("#amount").val("");
                $("#ca").val("");
                $("#balance").val("");

                $("#partial").val("0");
                $("#commodity").val('').trigger('change');
                $("#commodity1").val('').trigger('change');
                $("#customer").val('').trigger('change');
                $.ajax({
                    url:"{{ route('refresh_trans') }}",
                    method: 'get',
                    data: { temp: 'temp' },
                    dataType:'json',
                    success:function(data){
                        var t=0;
                        if(data[0].temp!=null){
                                t = data[0].temp;
                        }
                        var a = parseFloat(t);
                        var b = a + 1;
                        $('#id1').val(b);
                        var c = new Date();
                        var twoDigitMonth = ((c.getMonth().length+1) === 1)? (c.getMonth()+1) : '0' + (c.getMonth()+1);
                        var currentDate = c.getFullYear()+ twoDigitMonth + c.getDate();
                        $('#ticket').val(currentDate+b);
                        $('#ticket1').val(currentDate+b);
                        console.log( $('#ticket').val());

                        $("#commodity").val('').trigger('change');
                        $("#commodity1").val('').trigger('change');
                        $("#customer").val('').trigger('change');
                        $('#purchase_modal').modal('show');
                    }
                })

                $.ajax({
                    url:"{{ route('findCustomer') }}",
                    method: 'get',
                    data: { temp: 'temp' },
                    dataType:'json',
                    success:function(data){
                        var t=0;
                        if(data[0].temp!=null){
                            t = data[0].temp;
                        }
                        var a = parseFloat(t);
                        var b = a + 1;
                        $('#customerid').val(b);
                        console.log( b);
                    }
                })
            });
 
            $('#commodity').select2({
                dropdownParent: $('#purchase_modal'),
                placeholder: 'Select an item'
            });

            $('#commodity1').select2({
                dropdownParent: $('#purchase_modal'),
                placeholder: 'Select an item'
            });

            $('#customer').select2({
                dropdownParent: $('#purchase_modal'),
                placeholder: 'Select a company'
            });

            $('#remarks').select2({
                dropdownParent: $('#purchase_modal'),
                placeholder: 'Select a company'
            });

            $('#remarks1').select2({
                dropdownParent: $('#purchase_modal'),
                placeholder: 'Select a company'
            });

            $('#customer').on('select2:select', function (e) {
                var id = $(e.currentTarget).val()
                $.ajax({
                url: "{{ route('find_amt') }}",
                data: { id : id },
                dataType:'json',
                success: function(data) {
                    $('#ca').val(data.balance)
                    $('#balance').val(data.balance)
                    $('#balance1').val(data.balance)
                    $('#last').val(data.suki_type)
                    if($('#partial').val()!=""){
                        var a = 0;
                        var b = parseFloat($('#balance').val());
                        var d = parseFloat($('#ca').val());
                        var c = 0;
                        a = parseFloat($('#partial').val());
                        c = b-a;
                        $('#balance').val(c);
                    }

                    if($('#price').val()!=""){
                        var a = parseFloat($('#last').val());
                        var b = parseFloat($('#suki').val());
                        var c = parseFloat($('#pr').val());
                        var d = 0;
                        var e = 0;
                        var t = 0;
                        if(a==1){
                            $('#price').val(b);
                            if ($('#sacks').val()!="" || $('#kilo').val()!=""){
                                var x = 0;

                                if ($('#kilo').val()!=""){
                                    var x = parseFloat($('#kilo').val());
                                }
                                if ($('#sacks').val() == "" ){
                                    d = 0;
                                }
                                else{
                                    d =  parseFloat($('#sacks').val());
                                }

                                if ($('#partial').val() != "" ){
                                    t= parseFloat($('#partial').val());
                                }
                                e = b * (d*50);
                                var y = e + (b*x);
                                var z = e + (b*x)+t;
                                //alert(e);
                                var tempo =  parseFloat(y).toFixed(2);
                                $('#total').val(tempo);
                                var temp3 =  parseFloat(z).toFixed(2);
                                $('#amount').val(temp3);
                            }
                        }
                        else{
                            $('#price').val(c);

                            if ($('#sacks').val()!="" || $('#kilo').val()!=""){
                                var x = 0;

                                if ($('#kilo').val()!=""){
                                    var x = parseFloat($('#kilo').val());
                                }
                                if ($('#sacks').val() == "" ){
                                    d = 0;
                                }
                                else{
                                    d =  parseFloat($('#sacks').val());
                                }

                                if ($('#partial').val() != "" ){
                                    t =  parseFloat($('#partial').val());
                                }
                                e = c * (d*50);
                                var y = e + (c*x);
                                var z = e + (c*x)+t;
                                //alert(e);
                                var tempo =  parseFloat(y).toFixed(2);
                                $('#total').val(tempo);
                                var temp3 =  parseFloat(z).toFixed(2);
                                $('#amount').val(temp3);
                            }
                        }
                    }
                    console.log(data.amount);
                }
            });
        });

        $('#commodity').on('select2:select', function (e) {
            if($('#button_action1').val()=="update"){
                $('#commodityID').val($(e.currentTarget).val());
            }
            var id = $(e.currentTarget).val()
            $.ajax({
                url: "{{ route('find_comm') }}",
                data: { id : id },
                dataType:'json',
                success: function(data) {
                    $('#pr').val(data.price);
                    $('#suki').val(data.suki_price);
                    var a = parseFloat($('#last').val());
                    if(a==1){
                        $('#price').val(data.suki_price);
                        var d = 0;
                        var e = 0;
                        var b = parseFloat($('#suki').val());
                        var c = parseFloat($('#pr').val());
                        var t = 0;
                        if ($('#sacks').val()!="" || $('#kilo').val()!=""){
                            var x = 0;

                            if ($('#kilo').val()!=""){
                                var x = parseFloat($('#kilo').val());
                            }
                            if ($('#sacks').val() == "" ){
                                d = 0;
                            }
                            else{
                                d =  parseFloat($('#sacks').val());
                            }

                            if ($('#partial').val() != "" ){
                                t= parseFloat($('#partial').val());
                            }
                            e = b * d;
                            var y = e + (b*x);
                            var z = e + (b*x)+t;
                            //alert(e);
                            var tempo =  parseFloat(y).toFixed(2);
                            $('#total').val(tempo);
                            var temp3 =  parseFloat(z).toFixed(2);
                            $('#amount').val(temp3);
                        }
                    }
                    else{
                        $('#price').val(data.price);
                        var d = 0;
                        var e = 0;
                        var b = parseFloat($('#suki').val());
                        var c = parseFloat($('#pr').val());
                        var t = 0;
                        if ($('#sacks').val()!="" || $('#kilo').val()!=""){
                            var x = 0;

                            if ($('#kilo').val()!=""){
                                var x = parseFloat($('#kilo').val());
                            }
                            if ($('#sacks').val() == "" ){
                                d = 0;
                            }
                            else{
                                d =  parseFloat($('#sacks').val());
                            }

                            if ($('#partial').val() != "" ){
                                t= parseFloat($('#partial').val());
                            }
                            e = c * (d);
                            var y = e + (c*x);
                                var z = e + (c*x)+t;
                            //alert(e);
                            var tempo =  parseFloat(y).toFixed(2);
                            $('#total').val(tempo);
                            var temp3 =  parseFloat(z).toFixed(2);
                            $('#amount').val(temp3);
                        }
                    }
                    console.log(data.suki_price);
                }
            });
        });

        $('#commodity1').on('select2:select', function (e) {
            var id = $(e.currentTarget).val()
            $.ajax({
                url: "{{ route('find_comm') }}",
                data: { id : id },
                dataType:'json',
                success: function(data) {
                    $('#pr1').val(data.price);
                    $('#suki1').val(data.suki_price);

                    var a = parseFloat($('#last1').val());
                    if(a==1){
                        $('#price1').val(data.suki_price);
                        var d = 0;
                        var e = 0;
                        var b = parseFloat($('#suki').val());
                        var c = parseFloat($('#pr').val());
                        var t = 0;
                        if ($('#sacks1').val()!="" || $('#kilo1').val()!=""){
                            var x = 0;

                            if ($('#kilo1').val()!=""){
                                var x = parseFloat($('#kilo').val());
                            }
                            if ($('#sacks1').val() == "" ){
                               d = 0;
                            }
                            else{
                                d =  parseFloat($('#sacks1').val());
                            }

                            if ($('#partial1').val() != "" ){
                                t= parseFloat($('#partial1').val());
                            }
                            e = b * (d);
                            var y = e + (b*x);
                            var z = e + (b*x)+t;
                            //alert(e);
                            var tempo =  parseFloat(y).toFixed(2);
                            $('#total1').val(tempo);
                            var temp3 =  parseFloat(z).toFixed(2);
                            $('#amount1').val(temp3);
                        }
                    }
                    else{
                        $('#price1').val(data.price);
                        var d = 0;
                        var e = 0;
                        var b = parseFloat($('#suki1').val());
                        var c = parseFloat($('#pr1').val());
                        var t = 0;
                        if ($('#sacks1').val()!="" || $('#kilo1').val()!=""){
                            var x = 0;

                            if ($('#kilo1').val()!=""){
                                var x = parseFloat($('#kilo1').val());
                            }
                            if ($('#sacks1').val() == "" ){
                                d = 0;
                            }
                            else{
                                d =  parseFloat($('#sacks1').val());
                            }

                            if ($('#partial1').val() != "" ){
                                t= parseFloat($('#partial1').val());
                            }
                            e = c * (d);
                            var y = e + (c*x);
                            var z = e + (c*x)+t;
                            //alert(e);
                            var tempo =  parseFloat(y).toFixed(2);
                            $('#total1').val(tempo);
                            var temp3 =  parseFloat(z).toFixed(2);
                            $('#amount1').val(temp3);
                        }
                    }
                    console.log(data.suki_price);
                }
            });
        });
    });
    </script>
@endsection
