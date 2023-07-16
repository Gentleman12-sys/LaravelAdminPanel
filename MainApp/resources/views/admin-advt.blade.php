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
                @foreach ($ADVTS as $ADVT)
                <tr>
                    <td>{{ $ADVT->name }}</td>
                    <td>{{ $ADVT->category }}</td>
                    <td>{{ $ADVT->created_at }}</td>
                    <td>{{ $ADVT->phone }}</td>
                    <td><a href="{{ route('admin-advt-edit-page', ['id' => $ADVT->id ]) }}"><button class="btn">📝</button></a></td>
                    <td><button id='delete_{{ $ADVT->id }}' class="btn">🗑️</button></td>
                    @csrf
                    <script>
                        $(document).ready(function() {
                            var CSRF_TOKEN = $('input[name="_token"]').val();
                            $('#delete_{{ $ADVT->id }}').click(function() {
                                $.ajax({
                                    url: "{{ route('admin-advt-delete') }}",
                                    type: 'POST',
                                    data: {
                                        _token: CSRF_TOKEN,
                                        'id': '{{ $ADVT->id }}',
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
            <p class="text-muted credit" style="color:#fff">{{ $ADVTS->links() }}</p>
        </div>
    </div>
</div>
@endsection