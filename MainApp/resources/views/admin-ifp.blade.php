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
                    <td>УДАЛИТЬ</td>
                </tr>
                @foreach ($IFPS as $IFP)
                <tr>
                    <td>{{ $IFP->user_id }}</td>
                    <td>{{ $IFP->full_name }}</td>
                    <td>{{ $IFP->email }}</td>
                    <td>{{ $IFP->service }}</td>
                    <td>{{ $IFP->status }}</td>
                    <td><a href="{{ route('admin-ifp-edit-page', ['id' => $IFP->id ]) }}"><button class="btn">📝</button></a></td>
                    <td><button id='delete_{{ $IFP->id }}' class="btn">🗑️</button></td>
                    @csrf
                    <script>
                        $(document).ready(function() {
                            var CSRF_TOKEN = $('input[name="_token"]').val();
                            $('#delete_{{ $IFP->id }}').click(function() {
                                $.ajax({
                                    url: "{{ route('admin-ifp-delete') }}",
                                    type: 'POST',
                                    data: {
                                        _token: CSRF_TOKEN,
                                        'id': '{{ $IFP->id }}',
                                    },
                                    success: function(result) {
                                        window.location.reload();
                                    },
                                    error: function(result) {
                                        console.log(result);
                                    }
                                });
                            });
                        });
                    </script>  
                </tr>
                @endforeach
            </table>
        </div>
    </main>
    <div id="footer">
        <div class="container">
            <p class="text-muted credit" style="color:#fff">{{ $IFPS->links() }}</p>
        </div>
    </div>
</div>
@endsection