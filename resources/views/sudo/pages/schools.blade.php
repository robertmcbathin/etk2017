@section('title')
Учебные заведения
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
          <div class="card-content">
            <h4 class="card-title">Список учебных заведений</h4>
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
              <div id="datatables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"><div id="datatables_filter" class="dataTables_filter"><label class="form-group is-empty"><input type="search" class="form-control input-sm" placeholder="Поиск не работает" aria-controls="datatables"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 196px;" aria-label="ID" aria-sort="ascending">ID</th>
                  <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 147px;" aria-label="Код">Код</th>
                  <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 287px;" aria-label="Наименование УЗ">Наименование</th>
                  <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 147px;" aria-label="Код группы">Код группы</th>
                  <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 141px;" aria-label="Действие">Действие</th></tr>
              </thead>
              <tfoot>
                <tr><th rowspan="1" colspan="1">ID</th><th rowspan="1" colspan="1">Код</th><th rowspan="1" colspan="1">Наименование</th><th rowspan="1" colspan="1">Код группы</th><th class="text-right" rowspan="1" colspan="1">Действие</th></tr>
              </tfoot>
              <tbody>
               @foreach ($schools as $school)
                <tr role="row" class="odd">
                  <td class="sorting_1" tabindex="0">{{ $school->id }}</td>
                  <td>{{ $school->code }}</td>
                  <td>{{ $school->name }}</td>
                  <td>{{ $school->id_privilege_group }}</td>
                  <td class="text-right">
                    <a href="#" class="btn btn-simple btn-info btn-icon like"><i class="material-icons">favorite</i></a>
                    <a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">dvr</i></a>
                    <a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="material-icons">close</i></a>
                  </td>
                </tr>
               @endforeach
              </tbody>
      </table>
</div>
</div>
<div class="row"><div class="col-sm-5"></div>
<div class="col-sm-7">
<div class="dataTables_paginate paging_full_numbers" id="datatables_paginate">
<?php echo $schools->render(); ?></div></div></div></div>
</div>
</div>
<!-- end content-->
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
<script>
  var token = '{{ Session::token() }}';
  var url = '{{ route('ajax.check_card_operations') }}';
</script>