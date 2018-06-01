@extends('layouts.admin')

@section('sidenav')
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li >
                <a href="{{ route('home') }}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            <li >
                <a href="{{ route('expense') }}">
                    <i class="material-icons">show_chart</i>
                    <span>Expenses</span>
                </a>
            </li>
            <li >
                <a href="{{ route('trips') }}">
                    <i class="material-icons">directions_bus</i>
                    <span>Trips</span>
                </a>
            </li>
            <li >
                <a href="{{ route('dtr') }}">
                    <i class="material-icons">access_time</i>
                    <span>Daily Time Record</span>
                </a>
            </li>
            <li >
                <a href="{{ route('od') }}">
                    <i class="material-icons">arrow_upward</i>
                    <span>Outbound Deliveries</span>
                </a>
            </li>
            <li >
                <a href="{{ route('ca') }}">
                    <i class="material-icons">monetization_on</i>
                    <span>Cash Advance</span>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('purchases') }}">
                    <i class="material-icons">bookmark_border</i>
                    <span>Purchases</span>
                </a>
            </li>

            <li >
                <a href="{{ route('sales') }}">
                    <i class="material-icons">shopping_cart</i>
                    <span>Sales</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

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
                             <h2 class="modal_title">Add User</h2>
                        </div>
                        <div class="body">
                             <form class="form-horizontal " id="purchase_form">
                                  <input type="hidden" name="id" id="id" value="">
                                  <input type="hidden" name="last" id="last" value="">
                                  <input type="hidden" name="pr" id="pr" value="">
                                  <input type="hidden" name="suki" id="suki" value="">

                                  <input type="hidden" name="button_action" id="button_action" value="">
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
                                                      <input type="number" id="sacks"  onkeyup="sacks1(this)" name="sacks" class="form-control"   required>
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
                                            <label for="name">Remarks</label>
                                       </div>
                                       <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                 <div class="form-line">
                                                      <input type="text" id="remarks" name="remarks" class="form-control"   required>
                                                 </div>
                                            </div>
                                       </div>
                                  </div>



                                  <div class="row clearfix">
                                       <div class="modal-footer">
                                            <button type="submit" id="add_sales" class="btn btn-link waves-effect">SAVE CHANGES</button>
                                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                       </div>
                                  </div>
                             </form>
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
                                  <table id="purchasetable" class="table table-bordered table-striped table-hover  ">
                                       <thead>
                                            <tr>
                                                 <th width="100">ID</th>
                                                 <th width="100">Commodity</th>
                                                 <th width="100">No. of Sacks</th>
                                                 <th width="100">Cash Advance</th>
                                                 <th width="100">Balance</th>
                                                 <th width="100">Partial Payment</th>
                                                 <th width="100">No. of Kilos</th>
                                                 <th width="100">Price</th>
                                                 <th width="100">Deducted</th>
                                            </tr>
                                       </thead>
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

    $(document).ready(function () {

    $('#partial').on('keyup keydown', function (e) {
      if (e.which == 8) {

        if($('#balance').val()!=""){
             var a = 0;
             var b = parseInt($('#balance').val());
             var d = parseInt($('#ca').val());
             var c = 0;
             var e =0;
                if($('#partial').val()!=""){
                     a = parseInt($('#partial').val());



                    if($('#total').val()!=""){
                         e = parseInt($('#total').val());
                    }
                    x = a+e;
                   $('#amount').val(x)
                }


                 c = d-a;
                  if(c <= d){
                $('#balance').val(c);

                if($('#total').val()!=""){
                     e = parseInt($('#total').val());
                }

                x = a+e;

                if($('#total').val()=="" && $('#partial').val()=="")
                {
                     $('#amount').val('')
                }
                else{
                    $('#amount').val(x)
                }



           }


        }
        else if ($('#balance').val()==""){
              var d = parseInt($('#ca').val());
              $('#balance').val(d);



        }
      }

         }); //<----");" AND ANOTHA ONE *DJ KHALED'S VOICE*


     });

     function sacks1(value) {

               var a = 0;
               var b = parseInt($('#price').val());
               var d = 0;
               var c = 0;
               if($('#price').val()!=""){
                   a = parseInt($('#sacks').val());
                   d = a*50;

               if($('#sacks').val()==""){
                 $('#total').val("");
           }
               else{
                    c = d*b;
                    $('#total').val(c);
               }

             if($('#kilo').val()!=""){

                  var e = parseInt($('#kilo').val());
                  var x = b*e;
                  var z = x+c;

                  $('#total').val(z);

          }
}
   }

   function kilos1(value) {

             var a = 0;
             var b = parseInt($('#price').val());
             var c = 0;
               if($('#price').val()!=""){
                  a = parseInt($('#kilo').val());


               if($('#kilo').val()==""){
                    //a = 0;
                    $('#total').val("");

           }
               else{
                   c = a*b;
               $('#total').val(c);
          }




              if($('#sacks').val()!=""){

                   var e = parseInt($('#sacks').val());
                   var x = b*(e*50);
                   var z = x+c;

                   $('#total').val(z);

           }

      }

}

    function partial1(value) {


       if($('#balance').val()!=""){
            var a = 0;
            var b = parseInt($('#balance').val());
            var d = parseInt($('#ca').val());
            var c = 0;

               if($('#partial').val()!=""){
                    a = parseInt($('#partial').val());
                    var e =0;
                    if($('#total').val()!=""){
                        e = parseInt($('#total').val());
                   }
                   x = a+e;
                  $('#amount').val(x)
               }

                c = b-a;
               $('#balance').val(c);
               var e =0;
               if($('#total').val()!=""){
                   e = parseInt($('#total').val());
              }
              x = a+e;
             $('#amount').val(x)



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
               $("#commodity").val('').trigger('change');
               $("#customer").val('').trigger('change');
               $('#purchase_modal').modal('show');
        });

        $('#commodity').select2({
            dropdownParent: $('#purchase_modal'),
             placeholder: 'Select an item'
        });
        $('#customer').select2({
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
                  $('#last').val(data.suki_type)
                 if($('#partial').val()!=""){
                      var a = 0;
                      var b = parseInt($('#balance').val());
                      var d = parseInt($('#ca').val());
                      var c = 0;
                      a = parseInt($('#partial').val());
                      c = b-a;
                      $('#balance').val(c);

                }

                if($('#price').val()!=""){
                     var a = parseInt($('#last').val());
                     var b = parseInt($('#suki').val());
                     var c = parseInt($('#pr').val());
                     var d = 0;
                     var e = 0;
                     if(a==1){
                          $('#price').val(b);


                          if ($('#sacks').val()!="" || $('#kilo').val()!=""){
                              var x = 0;

                              if ($('#kilo').val()!=""){
                                   var x = parseInt($('#kilo').val());
                              }
                             if ($('#sacks').val() == "" ){
                                  d = 0;
                             }
                             else{
                               d =  parseInt($('#sacks').val());
                          }
                               e = b * (d*50);
                               var z = e + (b*x);
                               //alert(e);
                               $('#total').val(z);
                          }
                     }
                     else{
                          $('#price').val(c);

                          if ($('#sacks').val()!="" || $('#kilo').val()!=""){
                               var x = 0;

                               if ($('#kilo').val()!=""){
                                    var x = parseInt($('#kilo').val());
                               }
                               if ($('#sacks').val() == "" ){
                                    d = 0;
                               }
                               else{
                                d =  parseInt($('#sacks').val());
                           }
                                e = c * (d*50);
                                var z = e + (c*x);
                                //alert(e);
                                $('#total').val(z);
                           }
                     }

               }
            console.log(data.amount);
               }
          });

        });

        $('#commodity').on('select2:select', function (e) {

             var id = $(e.currentTarget).val()
             $.ajax({
             url: "{{ route('find_comm') }}",
             data: { id : id },
             dataType:'json',
             success: function(data) {
                  $('#pr').val(data.price);
                  $('#suki').val(data.suki_price);
                  var a = parseInt($('#last').val());
                  if(a==1){
                       $('#price').val(data.suki_price);
                       var d = 0;
                       var e = 0;
                       var b = parseInt($('#suki').val());
                       var c = parseInt($('#pr').val());
                       if ($('#sacks').val()!="" || $('#kilo').val()!=""){
                            var x = 0;

                            if ($('#kilo').val()!=""){
                                 var x = parseInt($('#kilo').val());
                            }
                           if ($('#sacks').val() == "" ){
                                d = 0;
                           }
                           else{
                             d =  parseInt($('#sacks').val());
                        }
                             e = b * (d*50);
                             var z = e + (b*x);
                             //alert(e);
                             $('#total').val(z);
                        }
                  }
                  else{

                     $('#price').val(data.price);
                     var d = 0;
                     var e = 0;
                     var b = parseInt($('#suki').val());
                     var c = parseInt($('#pr').val());
                     if ($('#sacks').val()!="" || $('#kilo').val()!=""){
                          var x = 0;

                          if ($('#kilo').val()!=""){
                               var x = parseInt($('#kilo').val());
                          }
                          if ($('#sacks').val() == "" ){
                               d = 0;
                          }
                          else{
                           d =  parseInt($('#sacks').val());
                      }
                           e = c * (d*50);
                           var z = e + (c*x);
                           //alert(e);
                           $('#total').val(z);
                      }

                  }

            console.log(data.suki_price);
              }
          });

        });






           });
    </script>
@endsection
