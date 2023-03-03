@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="col">
                                    <h3 class="mb-0 title">Supply Requests</h3>
                                    <h5 class="mb-0" style="color:#db1212; font-size:16px;">Instructions: Before
                                        starting,
                                        see to It that all inventory are in the Storage Area</h5><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <!-- Projects table -->
                        <table class="table align-items-center table-flush" id="myTablesss">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="font-size:16px;">Action</th>
                                    <th scope="col" style="font-size:16px;">Room No.</th>
                                    <th scope="col" style="font-size:16px;">Item Name</th>
                                    <th scope="col" style="font-size:16px;">RequestedQuantity</th>
                                    <th scope="col" style="font-size:16px;">DateRequested</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $lists)
                                    <tr>
                                        <td>
                                            <button class="btn btn-sm btn-primary btn-lg" data-toggle="modal" data-target="#update{{$lists->id}}"><i class="bi bi-pencil-square"></i></button>
                                        </td>
                                        <td style="font-size:16px;">{{ $lists->Room_No }}</td>
                                        <td style="font-size:16px;">{{ $lists->name }}</td>
                                        <td style="font-size:16px;">{{ $lists->Quantity_Requested }}</td>
                                        <td style="font-size:16px;">{{ $lists->Date_Requested }}</td>
                                    </tr>




                                    <!--MODAL FOR Update-->
                                    <div class="modal fade" id="update{{$lists->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form method="POST" action="{{ url('/supply_request_approval') }}"
                                                enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="modal-content">
                                                    <div class="modal-header"></div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="Stockdetails">Room Number : </label>
                                                                <input type="number" class="form-control"
                                                                    value="{{ $lists->Room_No }}"
                                                                    placeholder="Enter number..." readonly>
                                                                <input type="number" class="form-control"
                                                                    value="{{ $lists->Room_No }}"
                                                                    placeholder="Enter number..." name="roomno" hidden>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text" name="productid"
                                                                    value="{{ $lists->productid }}" hidden>
                                                                <input type="hidden" name="id" value="{{$lists->id}}">
                                                                <input type="hidden" name="attendant" value="{{$lists->Attendant}}">
                                                                <input type="hidden" name="category" value="{{$lists->Category}}">
                                                                <input type="hidden" name="date_requested" value="{{$lists->Date_Requested}}">
                                                                <input type="hidden" name="qty_owned" value="{{$lists->Quantity}}">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="Stockdetails">Item Name : </label>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $lists->name }}"
                                                                    placeholder="Enter number..." readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="Stockdetails">Quantity Owned: </label>
                                                                <input type="number" class="form-control"
                                                                    value="{{ $lists->Quantity}}"
                                                                    placeholder="Enter number..." readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="Stockdetails">Requested Quantity: </label>
                                                                <input type="number" class="form-control"
                                                                    name="Quantity_Requested"
                                                                    value="{{ $lists->Quantity_Requested }}"
                                                                    placeholder="Enter number..." readonly>
                                                            </div>
                                                        </div>
                                                        <label>Status: </label>
                                                        <select class="form-control" name="status" id="stats" required>
                                                        <option value="" selected="true" disabled="disabled">Select</option>
                                                            <option value="Approved">Approved</option>
                                                            <option value="Denied">Denied</option>
                                                        </select>

                                                        <div class="row" style="display:none;" id="qty">
                                                            <div class="col">
                                                                <label for="Stockdetails">Quantity to Give: </label>
                                                                <input type="number" class="form-control qt2" name="quantity"
                                                                    placeholder="Enter number..." value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-failed" data-dismiss="modal">Close</a>
                                                        <input type="submit" name="update" value="Update"
                                                            class="btn btn-success" />
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <style>
                .title {
                    text-transform: uppercase;
                    font-size: 25px;
                    letter-spacing: 2px;
                }

                .text-color {
                    font-size: 18px;
                    color: #6C6C6C;
                }
            </style>
            <script>
                $(document).ready(function() {
                    $("#stats").change(function() {
                        var selected = $("option:selected", this).val();
                        
                       if(selected == "Approved")
                       {
                            $('#qty').css({
                            'display': 'block'
                            });
                            $('.qt2').val(0);
                       } 
                       else if(selected == "Denied")
                       {
                            $('#qty').css({
                                'display': 'none'
                            });
                            $('.qt2').val(0);
                       }
                    });
                });
            </script>
        @endsection

        @push('js')
            <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
            <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
        @endpush