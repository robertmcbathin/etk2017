@section('title')
Детализация поездок
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
  @include('sudo.includes.top-nav')
  <div class="content">
    <div class="container-fluid">
      <div class="col-md-12">
        @if (Session::has('request_accepted'))
        <div class="row">
         <div class="alert alert-success">
          <button type="button" aria-hidden="true" class="close">
            <i class="material-icons">close</i>
          </button>
          <span>
            {{ Session::pull('request_accepted') }}
          </span>
        </div>
      </div>
      @endif
      @if (Session::has('add-report-ok'))
      <div class="row">
       <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close">
          <i class="material-icons">close</i>
        </button>
        <span>
          {{ Session::pull('add-report-ok') }}
        </span>
      </div>
    </div>
    @endif
    @if (Session::has('add-report-error'))
    <div class="row">
     <div class="alert alert-danger">
      <button type="button" aria-hidden="true" class="close">
        <i class="material-icons">close</i>
      </button>
      <span>
        {{ Session::pull('add-report-error') }}
      </span>
    </div>
  </div>
  @endif
  <div class="card">
    <div class="card-header card-header-icon" data-background-color="purple">
      <i class="material-icons">assignment</i>
    </div>                
    <div class="card-content">
      <div class="table-responsive">
        <table class="table table-shopping">
         <thead>
          <tr>
            <th>#</th>
            <th>Номер карты</th>
            <th>Начало периода</th>
            <th>Окончание периода</th>
            <th>Причина</th>
            <th class="text-right">Статус</th>
            <th class="text-right">Срок</th>
            <th class="text-right">Действие</th>
          </tr>
        </thead>
        @foreach ($requests as $request)
        <tr>
          <td>{{$request->id}}</td>
          <td>{{$request->card_number}}</td>
          <td>{{$request->date_start}}</td>
          <td>{{$request->date_end}}</td>
          <td>{{$request->reason}}</td>
          @if ($request->status == 1)
          <td class="text-right"><span class="label label-warning">Новый</span></td>
          @endif
          @if ($request->status == 2)
          <td class="text-right"><span class="label label-info">Принят к обработке</span></td>
          @endif
          @if ($request->status == 3)
          <td class="text-right"><span class="label label-success">Готов</span></td>
          @endif
          <td class="text-right">{{$request->estimated}}</td>
          <td class="td-actions text-right">
            @if ($request->status == 1)
            <form action="{{ route('sudo.pages.detailing-requests.accept') }}" method="POST">
              <input type="hidden" name="executed_by" value="{{ Auth::user()->id }}">
              <input type="hidden" name="request_id" value="{{ $request->id }}">
              {{csrf_field()}}
              <button type="submit" rel="tooltip" class="btn btn-info" data-original-title="" title="">
                <i class="material-icons">gavel</i>
                <div class="ripple-container"></div>
              </button>
            </form>
            @endif
            @if ($request->status == 2)
            <form action="{{ route('sudo.pages.detailing-requests.attach_file') }}" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="request_id" value="{{ $request->id }}">
              <input type="hidden" name="user_id" value="{{ $request->user_id }}">
              {{csrf_field()}}
              <div class="form-group form-file-upload is-empty is-fileinput">
                <input type="file" id="inputFile2" multiple="" name="report">
                <div class="input-group">
                  <input type="text" readonly="" class="form-control" placeholder="Прикрепить файл">
                  <span class="input-group-btn input-group-s">
                    <button  class="btn btn-just-icon btn-round btn-primary">
                      <i class="material-icons">attach_file</i>
                    </button>
                  </span>
                </div>
                <span class="material-input"></span>
              </div>
              <button type="submit" class="btn btn-fill btn-rose"><i class="material-icons">save</i> Сохранить<div class="ripple-container"></div></button>
            </form>
            @endif
            @if ($request->status == 3)
            <a class="btn btn-success" href="{{ $request->filepath }}" target="_blank">
              <span class="btn-label">
                <i class="material-icons">file_download</i>
              </span>
              Открыть файл
              <div class="ripple-container"></div></a>
              @endif
            </td>
          </tr>
          @endforeach
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
    <div class="card-content" style="float:right;">
      <?php echo $requests->render(); ?>
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