@extends('layouts.app')

@section('title-block')
USER
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
                    <td>ФИО</td>
                    <td>EMAIL</td>
                    <td>ТЕЛЕФОН</td>
                    <td>РЕДАКТИРОВАТЬ</td>
                </tr>
                <tr>
                    <form action="{{ route('admin-user-edit') }}" method="post" enctype="multipart/form-data">
                        <td><input readonly='true' value='{{ $USER->full_name }}' id='full_name_{{ $USER->id }}'></td>
                        <td><input readonly='true' value='{{ $USER->email }}' id='email_{{ $USER->id }}'></td>
                        <td><input readonly='true' value='{{ $USER->phone }}' id='phone_{{ $USER->id }}'></td>
                        <td><button id='btn_{{ $USER->id }}' class="btn">📝</button></td>
                    </form>
                    @csrf
                    <script>
                        $(document).ready(function() {
                            var CSRF_TOKEN = $('input[name="_token"]').val();
                            $('#btn_{{ $USER->id }}').click(function() {
                                if (!window.edit) {
                                    console.log(new FormData($('form')[0]));
                                    window.edit = true;
                                    $(this).text('✔');
                                    $('#full_name_{{ $USER->id }}').prop('readonly', false);
                                    $('#email_{{ $USER->id }}').prop('readonly', false);
                                    $('#phone_{{ $USER->id }}').prop('readonly', false);
                                    var cancelButton = $('<button>').addClass('btn btn-cancel').text('✖');
                                    cancelButton.click(function() {
                                        window.edit = false;
                                        $(this).remove();
                                        $('#btn_{{ $USER->id }}').text('📝');
                                        $('#full_name_{{ $USER->id }}').prop('readonly', true).val('{{ $USER->full_name }}');
                                        $('#email_{{ $USER->id }}').prop('readonly', true).val('{{ $USER->email }}');
                                        $('#phone_{{ $USER->id }}').prop('readonly', true).val('{{ $USER->phone }}');
                                    });

                                    $(this).parent().append(cancelButton);
                                }
                                else if ($(this).text() == '✔') {
                                    $.ajax({
                                        url: "{{ route('admin-user-edit') }}",
                                        type: 'POST',
                                        data: {
                                            _token: CSRF_TOKEN,
                                            'id': '{{ $USER->id }}',
                                            'full_name': $('#full_name_{{ $USER->id }}').val(),
                                            'email': $('#email_{{ $USER->id }}').val(),
                                            'phone': $('#phone_{{ $USER->id }}').val(),
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