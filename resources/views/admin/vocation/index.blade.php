@extends('admin.layouts.master')

@section('title')
    {{ __('Vocation Form Request') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">{{ __('Vocation Form Request') }}</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Vocation Form Request') }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.vocation.trash') }}" class="btn btn-warning btn-sm float-right"><i
                            class="fas fa-trash-alt"></i>{{ __('main.Recycle') }}</a>
                    </div>
                    <div class="card-body">
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('main.id') }}</th>
                                    <th>{{ __('main.Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('STD / Class') }}</th>
                                    <th>{{ __('Father Name') }}</th>
                                    <th>{{ __('Mother Name') }}</th>
                                    <th>{{ __('main.Mobile') }}</th>
                                    <th>{{ __('main.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vocations as $key => $vocation)
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{ $vocation->name }}</td>
                                        <td>{{ $vocation->email }}</td>
                                        <td>{{ $vocation->stdClass }}</td>
                                        <td>{{ $vocation->fatherName }}</td>
                                        <td>{{ $vocation->motherName }}</td>
                                        <td>{{ $vocation->cellNumber }}</td>
                                        
                                        <td> &nbsp;
                                            <a href="" class="btn btn-info btn-xs" data-toggle="modal" data-target="#exampleModalCenter"><i class="far fa-eye"></i></a>
                                            <a href="{{ route('admin.vocation.sendmail', $vocation->id) }}"
                                            title="{{ __('main.Show') }}" class="btn btn-success btn-xs">
                                            <i class="far fa-envelope"></i></a>
                                            <a href="{{ route('admin.vocation.delete', $vocation->id) }}"
                                                onclick="confirmDelete(event,{{ $vocation->id }})" title="{{ __('main.Delete') }}"
                                                class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered static-modal" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Vocation Request Details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach ($vocations as $key => $vocation)
                    <div class="row">
                        <div class="col-4">
                            <label class="text-bold">{{ __('main.Name') }}</label>
                            <p>{{ $vocation->name }}</p>
                        </div>
                        <div class="col-4">
                            <label class="text-bold">{{ __('STD / Class') }}</label>
                            <p>{{ $vocation->stdClass }}</p>
                        </div>
                        <div class="col-4">
                            <label class="text-bold">{{ __('Father Name') }}</label>
                            <p>{{ $vocation->fatherName }}</p>
                        </div>
                        <div class="col-4">
                            <label class="text-bold">{{ __('Mother Name') }}</label>
                            <p>{{ $vocation->motherName }}</p>
                        </div>
                        <div class="col-4">
                            <label class="text-bold">{{ __('School Name') }}</label>
                            <p>{{ $vocation->schoolName }}</p>
                        </div>
                        <div class="col-4">
                            <label class="text-bold">{{ __('Village Name') }}</label>
                            <p>{{ $vocation->villageName }}</p>
                        </div>
                        <div class="col-4">
                            <label class="text-bold">{{ __('No Of Sisters') }}</label>
                            <p>{{ $vocation->numberOfSisters }}</p>
                        </div>
                        <div class="col-4">
                            <label class="text-bold">{{ __('No Of Brothers') }}</label>
                            <p>{{ $vocation->numberOfBrothers }}</p>
                        </div>
                        <div class="col-4">
                            <label class="text-bold">{{ __('District') }}</label>
                            <p>{{ $vocation->district }}</p>
                        </div>
                        <div class="col-4">
                            <label class="text-bold">{{ __('Diocese') }}</label>
                            <p>{{ $vocation->diocese }}</p>
                        </div>
                        <div class="col-4">
                            <label class="text-bold">{{ __('State') }}</label>
                            <p>{{ $vocation->state }}</p>
                        </div>
                        <div class="col-4">
                            <label class="text-bold">{{ __('Home Address') }}</label>
                            <p>{{ $vocation->homeAddress }}</p>
                        </div>
                        <div class="col-4">
                            <label class="text-bold">{{ __('Mobile') }}</label>
                            <p>{{ $vocation->cellNumber }}</p>
                        </div>
                        <div class="col-6">
                            <label class="text-bold">{{ __('Email') }}</label>
                            <p>{{ $vocation->email }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
       
    </script>
@endsection
