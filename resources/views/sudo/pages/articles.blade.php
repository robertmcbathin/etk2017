@section('title')
Новости
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
                    <h4 class="card-title">Новости <a href="{{route('sudo.articles.add.get')}}"><button class="btn btn-primary btn-sm">Добавить</button></a></h4>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-shopping">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-left">Заголовок</th>
                                        <th class="text-description">Описание</th>
                                        <th class="text-center">Кем создано</th>
                                        <th class="text-right">Опубликовано</th>
                                        <th class="text-center">Дата создания</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articles as $article)
                                    <tr>
                                        <td>
                                            <div class="img-container">
                                                <img src="http://etk21.ru{{$article->image}}">
                                            </div>
                                        </td>
                                        <td class="td-name">
                                            <a href="{{ route('sudo.articles.edit.get',['id' => $article->id]) }}">{{$article->title}}</a>
                                        </td>
                                        <td>
                                            <small>{{$article->description}}</small>
                                        </td>
                                        <td>
                                            {{$article->author}}
                                        </td>
                                        <td>
                                          <div class="togglebutton">
                                            <label>
                                              <input type="checkbox" checked="{{$article->published}}"  value="{{$article->published}}" name="publish_checkbox" disabled>
                                          </label>
                                      </div>
                                  </td>
                                  <td>
                                    {{$article->created_at}}
                                </td>
                                <td>
                                 <form action="{{route('sudo.articles.delete',['id' => $article->id])}}" method="POST">
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
                <?php echo $articles->render(); ?>
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