@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-6 col-sm-6 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $staff_info->department  }} - {{ $staff_info->first_name }} {{ $staff_info->last_name }} - {{ $staff_info->staff_number }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="/personel-takip/detail/add-day" method="post" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        <input type="hidden" name="staff_id" value="{{ $staff_info->id }}">
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="staff_day">İşe Geldiği Gün <span class="required">*</span></label>
                            <input type="text" id="staff_day" name="staff_day" class="form-control col-md-3 col-sm-3" value="" required="required">
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="checkin">Giriş Saati <span class="required">*</span></label>
                            <input type="text" id="checkin" name="checkin" class="form-control col-md-3 col-sm-3" value="" required="required">
                        </div>
                        <div class="item form-group">
                            <label for="checkout" class="col-form-label col-md-3 col-sm-3 label-align">Çıkış Saati <span class="required">*</span></label>
                            <input type="text" id="checkout" name="checkout" class="form-control col-md-3 col-sm-3" value="" required="required">
                        </div>



                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Kaydet</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $('#staff_day').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#checkin').datetimepicker({
            format : 'HH:mm'
        })
        $('#checkout').datetimepicker({
            format : 'HH:mm'
        })
    </script>

@endsection
