@extends('layouts.master')

@section('content')

    <div class="row" style="display: block;">

        <div class="col-md-6 col-sm-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $staff_info->department  }} - {{ $staff_info->first_name }} {{ $staff_info->last_name }} - {{ $staff_info->staff_number }}</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">Gün </th>
                                <th class="column-title">Giriş Saati </th>
                                <th class="column-title">Çıkış Saati</th>
                                <th colspan="2" class="column-title no-link last"><span class="nobr">İşlem</span></th>
                            </tr>
                            </thead>

                            <tbody>

                            @if(isset($staff_day))

                                  @foreach($staff_day as $item)
                                      <tr class="even pointer" id="item-row{{$item->id}}">
                                          <td class=" ">{{ date('d.m.Y', strtotime($item->day)) }}</td>
                                          <td class=" ">{{ substr($item->checkin, 0, 5) }}</td>
                                          <td class=" ">{{ substr($item->checkout, 0, 5) }}</td>
                                          <td class="a-right a-right" style="width: 3%"><a href="/personel-takip/detail/staff-edit-day/{{ $item->id }}">Güncelle</a></td>
                                          <td class="last" style="width: 3%"><a href="javascript:checkDelete({{ $item->id }});">Sil</a>
                                          </td>
                                      </tr>
                                  @endforeach

                            @endif

                            </tbody>
                        </table>
                        <button class="btn btn-primary" id="addDay"> Gün Ekle </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $('#addDay').on('click', function () {
            window.location.href = "/personel-takip/detail/{{ $staff_info->id }}/add-day";
        });

        function checkDelete(id) {
            if (confirm('Really delete?')) {
                $.ajax({
                    type: "POST",
                    url: '/personel-takip/detail/delete-day',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': id
                    },
                    success: function(result) {
                        $('#item-row'+id).remove();
                    }
                });
            }
        }
    </script>

@endsection
