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
                        <h4 class="m-0 text-dark">{{ __('main.Recycle') }}</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.vocation.index') }}">{{ __('Vocation Form Request') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('main.Recycle') }}</li>
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
                    <div class="card-body">
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('main.id') }}</th>
                                    <th>{{ __('main.Name') }}</th>
                                    <th>{{ __('STD / Class') }}</th>
                                    <th>{{ __('Father Name') }}</th>
                                    <th>{{ __('Mother Name') }}</th>
                                    <th>{{ __('main.Mobile') }}</th>
                                    <th>{{ __('main.Creation Date') }}</th>
                                    <th>{{ __('main.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vocations as $key => $vocation)
                                    <tr>
                                    <td>{{ $key +1 }}</td>
                                        <td>{{ $vocation->name }}</td>
                                        <td>{{ $vocation->stdClass }}</td>
                                        <td>{{ $vocation->fatherName }}</td>
                                        <td>{{ $vocation->motherName }}</td>
                                        <td>{{ $vocation->cellNumber }}</td>
                                        <td>{{ $vocation->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('admin.vocation.recover', $vocation->id) }}"
                                                title="{{ __('main.Recover') }}" class="btn btn-warning btn-xs"><i
                                                    class="fas fa-recycle"></i></a>
                                            <form id="delete_{{ $vocation->id }}"
                                                action="{{ route('admin.vocation.destroy', $vocation->id) }}" method="post"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <a href="javascript:void(0)" onclick="validate({{ $vocation->id }})"
                                                    title="{{ __('main.Destroy') }}" class="btn btn-danger btn-xs"><i
                                                        class="far fa-times-circle"></i></a>
                                            </form>
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
@endsection

@section('script')

@endsection
