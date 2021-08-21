@extends('admin/layout')
@section('container')
@section('page_title','All Orders')
@section('order_select','active')

@if(session('msg'))
<div class="alert alert-success" role="alert">
{{session('msg')}}
</div>
@endif

<h2>Installment Records of Order # {{ Request::segment(3) }}</h2>

<div class="row mt-2">
	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-30">
		<table class="table table-borderless table-striped table-earning">
            <thead>
                <tr><th>Transaction ID</th><th>Date</th><th>Detail</th><th>Amount</th><th>Status</th></tr>
            </thead>
		<tbody>
            @php
            foreach($installments as $row):
            $status = ($row->status==0)?"<span style='background:red; color:#FFF; padding:5px'>Pending</span>":"<span style='background:green; color:#FFF; padding:5px'>Verified</span>";
            echo "<tr>
	                    <td>$row->id</td>
	
						<td>".date('d-M-Y h:i a', strtotime($row->date))."</td>

                        <td>$row->detail</td>

                        <td>$row->amount</td>" 
                        @endphp
                        <td>
                        @if($row->status==1)
                                    <a href="{{url('admin/order_installments/status/0')}}/{{$row->id}}/{{ $row->order_id }}"><button type="button" class="btn btn-primary">Verified</button></a>
                                 @elseif($row->status==0)
                                    <a href="{{url("admin/order_installments/status/1")}}/{{$row->id}}/{{ $row->order_id  }}"><button type="button" class="btn btn-warning">Pending</button></a>
                                @endif
                        </td>

                @php
	                    
						
	                echo "</tr>";
            
            endforeach;
            @endphp
            
		</tbody>
		</table>
		</div>

	</div>
</div>
@endsection