@section('title')
F.A.Q.
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
    @include('sudo.includes.top-nav')
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">assignment</i>
                    </div>                
                    <h4 class="card-title">Вопросы и ответы</h4>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-shopping">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-left">Отправитель</th>
                                        <th class="text-description">Email</th>
                                        <th class="text-center">Вопрос</th>
                                        <th class="text-right">Ответ</th>
                                        <th class="text-center">Дата создания</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
                                    <tr>
                                        <td>
                                            {{ $question->id }}
                                        </td>
                                        <td>
                                            {{ $question->name }}
                                        </td>
                                        <td class="td-name">
                                            {{ $question->email }}
                                        </td>
                                        <td>
                                            {{ $question->content }}
                                        </td>
                                        <td>
                                            {{ $question->answer }}
                                        </td>
                                  <td>
                                    {{$question->created_at}}
                                </td>
                                <td>
                                 <form action="" method="POST">
                                     {{ csrf_field() }}
                                     <input type="submit" class="btn btn-danger" value="Удалить">
                                 </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-content" style="float:right;">
                <?php echo $questions->render(); ?>
            </div>
        </div>
    </div>
</div>
</div>
<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            <ul>
                <li>
                    <a href="{{route('sudo.pages.dashboard')}}">
                        Панель управления
                    </a>
                </li>
            </ul>
        </nav>
        <p class="copyright pull-right">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>
            ООО "Единая транспортная карта"
        </p>
    </div>
</footer>
</div>
@endsection