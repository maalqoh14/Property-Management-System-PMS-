@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    <script>
        $.noConflict();
        jQuery(document).ready(function($) {
            $('#myTable').DataTable();
        });
        // Code that uses other library's $ can follow here.
    </script>
    <div class="container-fluid mt--8">
        <div class="row align-items-center py-4">
            <div class="col-lg-12 col-12">
                <h6 class="h2 text-dark d-inline-block mb-0">Guest Folio</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Front Desk</li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">Guest Folio</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class=" col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive t1">
                                <table class="table align-items-center table-flush" id="myTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" style="font-size:15px;">Action</th>
                                            <th scope="col" style="font-size:15px;">Guest list</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $lists)
                                            <tr>
                                                <td>
                                                    <button class="btn btn-sm bg-green text-white" data-toggle="modal"
                                                        data-target="#views1{{ $lists->Booking_No }}" title="Add Charges">
                                                        Add charges
                                                        <i class="bi bi-plus-circle text-white"></i>
                                                    </button>
                                                </td>
                                                <td id="g1">
                                                    BOOKING NO.:
                                                    <span class="font-weight-bold">
                                                        {{ $lists->Booking_No }}
                                                    </span>
                                                    <br>
                                                    NAME:
                                                    <span class="font-weight-bold">
                                                        {{ $lists->Guest_Name }}
                                                    </span>
                                                    <br>
                                                    PAYMENT:
                                                    <span class="font-weight-bold">
                                                        {{ $lists->Payment }}
                                                    </span>
                                                    <br>
                                                    ROOM NUMBER:
                                                    <span class="font-weight-bold">
                                                        {{ $lists->Room_No }}
                                                    </span>
                                                    <br>
                                                    NUMBER OF PAX:
                                                    <span class="font-weight-bold">
                                                        {{ $lists->No_of_Pax }}
                                                    </span>
                                                    <br>
                                                    DATE OF ARRIVAL:
                                                    <span class="font-weight-bold">
                                                        {{ $lists->Check_In_Date }}
                                                    </span>
                                                    <br>
                                                    DATE OF DEPARTURE:
                                                    <span class="font-weight-bold">
                                                        {{ $lists->Check_Out_Date }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <div class="modal fade bd-example-modal-lg" id="views1{{ $lists->Booking_No }}"
                                                tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h2 class="modal-title" id="exampleModalLabel">Add Charges</h2>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span style="font-size: 20px;">Select charges</span>
                                                            <select class="form-control mt-2" onchange="others()"
                                                                name="Charges" id="charges">
                                                                <option value="200">Towel = ₱200</option>
                                                                <option value="150">Linen = ₱150</option>
                                                                <option value="200">Bed Pad = ₱200</option>
                                                                <option value="others">Others</option>
                                                            </select>
                                                            <input type="text" class="form-control mt-3"
                                                                placeholder="Enter Price" id="charges1" hidden>
                                                            <div class="col-md-12 mt-2">
                                                                <div class="card h-100 mb-4">
                                                                    <div class="card-header pb-0 px-3">
                                                                        <div class="row mb-3">
                                                                            <div class="col-md-6">
                                                                                <h3>{{ $lists->Guest_Name }}
                                                                                    Transactions</h3>
                                                                            </div>
                                                                            <div
                                                                                class="col-md-6 d-flex justify-content-end align-items-center">

                                                                                <i class="far fa-calendar-alt me-2 ml-2"
                                                                                    aria-hidden="true"></i>
                                                                                <small
                                                                                    class="ml-2">{{ $lists->Check_In_Date }}
                                                                                    - {{ $lists->Check_Out_Date }}
                                                                                    (Arrival/Departure)
                                                                                </small>
                                                                                <input type="hidden" id="date1"
                                                                                    value="{{ $lists->Check_In_Date }}">
                                                                                <input type="hidden" id="date2"
                                                                                    value="{{ $lists->Check_Out_Date }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body pt-4 p-3">
                                                                        <h5
                                                                            class="text-right text-uppercase text-body text-xs font-weight-bolder mb-3">
                                                                            Subtotal</h5>
                                                                        <ul class="list-group">
                                                                            <li
                                                                                class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="d-flex flex-column">
                                                                                        <h5 class="mb-1 text-dark text-sm">
                                                                                            Hotel room
                                                                                            #{{ $lists->Room_No }}
                                                                                        </h5>
                                                                                           <h5 class="text-sm"> {{ $lists->No_of_Pax }} pax,
                                                                                            <span id="days"></span> day/s</h5>
                                                                                    </div>
                                                                                </div>
                                                                                <h1 class="display-4">- ₱ {{ $lists->Payment }}</h1>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg bg-green">
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="d-flex flex-column">
                                                                                        <h3 class="mb-1 text-white">
                                                                                            Total Payment</h3>
                                                                                    </div>
                                                                                </div>
                                                                                <h1 class="text-white display-2">- $ 2,500
                                                                                </h1>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="button" class="btn bg-green text-white">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(e) {
            let date_invoice = document.getElementById("days");
            let d1 = document.getElementById("date1").value;
            let d2 = document.getElementById("date2").value;
            const dateOne = new Date(d1);
            const dateTwo = new Date(d2);
            const time = Math.abs(dateTwo - dateOne);
            const days = Math.ceil(time / (1000 * 60 * 60 * 24));
            date_invoice.innerHTML = days;
        });
    </script>
@endsection
@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush