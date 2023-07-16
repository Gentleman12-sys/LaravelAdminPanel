@extends('layouts.app')

@section('title-block')
ADVT
@endsection

@section('head-block')
<script>
    window.edit = false
</script>
@endsection

@section('content-block')
<div class="container" style="min-width: 90%;;">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-1 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <img src="resources\company.png">
            <span class="fs-4">СИСТЕМА УПРАВЛЕНИЯ САЙТОМ</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">User name</a></li>
        </ul>
        <hr>
    </header>
    <div class="mb-5">
        <a href="{{ route('admin-user') }}">Список пользователей</a>
        <a href="{{ route('admin-advt') }}">Список объявлений</a>
        <a href="{{ route('admin-company') }}">Список компаний</a>
    </div>
    
    <main>
        <div class="rounded-1" style="background-color: #F5F5F5;">
            <table class="table text-center">
                <tr>
                    <td>НАЗВАНИЕ</td>
                    <td>КАТЕГОРИЯ</td>
                    <td>ДАТА СОЗД.</td>
                    <td>СТАТУС</td>
                    <td>РЕДАКТИРОВАТЬ</td>
                    <td>УДАЛИТЬ</td>
                </tr>
                <tr>
                    <td><input readonly='true' value='{{ $ADVT->name }}' id='name_{{ $ADVT->id }}'></td>
                    <td><input readonly='true' value='{{ $ADVT->category }}' id='category_{{ $ADVT->id }}'></td>
                    <td><input readonly='true' value='{{ $ADVT->created_at }}' id='created_at_{{ $ADVT->id }}'></td>
                    <td><input readonly='true' value='{{ $ADVT->status }}' id='status_{{ $ADVT->id }}'></td>
                    <td><button id='btn_{{ $ADVT->id }}' class="btn">📝</button></td>
                    @csrf
                    <script>
                        $(document).ready(function() {
                            var CSRF_TOKEN = $('input[name="_token"]').val();
                            $('#btn_{{ $ADVT->id }}').click(function() {
                                if (!window.edit) {
                                    window.edit = true;
                                    $(this).text('✔');
                                    $('#name_{{ $ADVT->id }}').prop('readonly', false);
                                    $('#category_{{ $ADVT->id }}').prop('readonly', false);
                                    $('#created_at_{{ $ADVT->id }}').prop('readonly', false);
                                    $('#status_{{ $ADVT->id }}').prop('readonly', false);
                                    var cancelButton = $('<button>').addClass('btn btn-cancel').text('✖');
                                    cancelButton.click(function() {
                                        window.edit = false;
                                        $(this).remove();
                                        $('#btn_{{ $ADVT->id }}').text('📝');
                                        $('#name_{{ $ADVT->id }}').prop('readonly', true).val('{{ $ADVT->name }}');
                                        $('#category_{{ $ADVT->id }}').prop('readonly', true).val('{{ $ADVT->category }}');
                                        $('#created_at_{{ $ADVT->id }}').prop('readonly', true).val('{{ $ADVT->created_at }}');
                                        $('#status_{{ $ADVT->id }}').prop('readonly', true).val('{{ $ADVT->status }}');
                                    });

                                    $(this).parent().append(cancelButton);
                                }
                                else if ($(this).text() == '✔') {
                                    $.ajax({
                                        url: "{{ route('admin-advt-edit') }}",
                                        type: 'POST',
                                        data: {
                                            _token: CSRF_TOKEN,
                                            'id': '{{ $ADVT->id }}',
                                            'name': $('#name_{{ $ADVT->id }}').val(),
                                            'category': $('#category_{{ $ADVT->id }}').val(),
                                            'status': $('#status_{{ $ADVT->id }}').val(),
                                        },
                                        success: function( result ) {
                                            window.location.reload();
                                        },
                                        error: function( result ) {
                                            console.log(result);
                                        }
                                    });
                                }
                            });
                        });
                    </script>  
                </tr>
            </table>
        </div>
    </main>
</div>
@endsection