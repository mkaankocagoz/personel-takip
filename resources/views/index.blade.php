@extends('layouts.master')

@section('content')

    <div class="row" style="display: block;">

        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Personel Listesi</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">Adı </th>
                                <th class="column-title">Soyadı </th>
                                <th class="column-title">Personel Numarası </th>
                                <th class="column-title">Çalıştığı Birim </th>
                                <th colspan="3" class="column-title no-link last"><span class="nobr">İşlem</span></th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($staffList as $item)

                                <tr class="even pointer" id="item-row{{$item->id}}">
                                    <td class=" ">{{ $item->first_name }}</td>
                                    <td class=" ">{{ $item->last_name }}</td>
                                    <td class=" ">{{ $item->staff_number }}</td>
                                    <td class=" ">{{ $item->department }}</td>
                                    <td class="" style="width: 5%"><a href="{{ route('staffDetail', ['id'=>$item->id]) }}">Görüntüle</a>
                                    <td class=" last" style="width: 3%"><a href="/personel-takip/{{ $item->id }}/edit">Düzenle</a>
                                    <td class=" last" style="width: 3%"><a href="javascript:checkDelete({{ $item->id }});">Sil</a></td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        <button class="btn btn-primary" id="addStaff"> Personel Ekle </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $('#addStaff').on('click', function () {
            window.location.href = "/personel-takip/create";
        });

        function checkDelete(id) {
            if (confirm('Really delete?')) {
                $.ajax({
                    type: "DELETE",
                    url: '/personel-takip/' + id,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(result) {
                        $('#item-row'+id).remove();
                    }
                });
            }
        }
    </script>

@endsection
