@extends('layouts.app')

@section('title-block')
IFP
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
        <a href="{{ route('admin-ifp') }}">Список запросов на оплату</a>
    </div>
    
    <main>
        <div class="rounded-1" style="background-color: #F5F5F5;">
            <table class="table text-center">
                <tr>
                    <td>НОМЕР</td>
                    <td>ФИО</td>
                    <td>EMAIL</td>
                    <td>УСЛУГА</td>
                    <td>СТАТУС</td>
                    <td>РЕДАКТИРОВАТЬ</td>
                </tr>
                <tr>
                    <td><input readonly='true' value='{{ $IFP->user_id }}' id='user_id_{{ $IFP->id }}'></td>
                    <td><input readonly='true' value='{{ $IFP->full_name }}' id='full_name_{{ $IFP->id }}'></td>
                    <td><input readonly='true' value='{{ $IFP->email }}' id='email_{{ $IFP->id }}'></td>
                    <td><input readonly='true' value='{{ $IFP->service }}' id='service_{{ $IFP->id }}'></td>
                    <td><input readonly='true' value='{{ $IFP->status }}' id='status_{{ $IFP->id }}'></td>
                    <td><button id='btn_{{ $IFP->id }}' class="btn">📝</button></td>
                    @csrf
                    <script>
                        $(document).ready(function() {
                            var CSRF_TOKEN = $('input[name="_token"]').val();
                            $('#btn_{{ $IFP->id }}').click(function() {
                                if (!window.edit) {
                                    window.edit = true;
                                    $(this).text('✔');
                                    $('#user_id_{{ $IFP->id }}').prop('readonly', false);
                                    $('#full_name_{{ $IFP->id }}').prop('readonly', false);
                                    $('#email_{{ $IFP->id }}').prop('readonly', false);
                                    $('#service_{{ $IFP->id }}').prop('readonly', false);
                                    $('#status_{{ $IFP->id }}').prop('readonly', false);
                                    var cancelButton = $('<button>').addClass('btn btn-cancel').text('✖');
                                    cancelButton.click(function() {
                                        window.edit = false;
                                        $(this).remove();
                                        $('#btn_{{ $IFP->id }}').text('📝');
                                        $('#user_id_{{ $IFP->id }}').prop('readonly', true).val('{{ $IFP->user_id }}');
                                        $('#full_name_{{ $IFP->id }}').prop('readonly', true).val('{{ $IFP->full_name }}');
                                        $('#email_{{ $IFP->id }}').prop('readonly', true).val('{{ $IFP->email }}');
                                        $('#service_{{ $IFP->id }}').prop('readonly', true).val('{{ $IFP->service }}');
                                        $('#status_{{ $IFP->id }}').prop('readonly', true).val('{{ $IFP->status }}');
                                    });

                                    $(this).parent().append(cancelButton);
                                }
                                else if ($(this).text() == '✔') {
                                    $.ajax({
                                        url: "{{ route('admin-ifp-edit') }}",
                                        type: 'POST',
                                        data: {
                                            _token: CSRF_TOKEN,
                                            'id': '{{ $IFP->id }}',
                                            'user_id': $('#user_id_{{ $IFP->id }}').val(),
                                            'full_name': $('#full_name_{{ $IFP->id }}').val(),
                                            'email': $('#email_{{ $IFP->id }}').val(),
                                            'service': $('#service_{{ $IFP->id }}').val(),
                                            'status': $('#status_{{ $IFP->id }}').val(),
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