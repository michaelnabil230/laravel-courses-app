@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('dashboard.courses')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.welcome') }}">
                                    <i class="fa fa-home"></i>
                                    @lang('dashboard.dashboard')
                                </a>
                            </li>
                            <li class="breadcrumb-item active">@lang('dashboard.courses')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="margin-bottom: 15px">@lang('dashboard.courses')
                                    <small> {{ $courses->total() }}</small>
                                </h3>
                                <form action="{{ route('dashboard.courses.index') }}" method="get">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="search" class="form-control float-right"
                                            value="{{ request()->search }}" placeholder="@lang('dashboard.search')">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fa fa-search"></i>
                                                @lang('dashboard.search')
                                            </button>
                                            @can('create-courses')
                                                <a href="{{ route('dashboard.courses.create') }}" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>
                                                    @lang('dashboard.add')
                                                </a>
                                            @endcan
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>@lang('dashboard.name')</th>
                                                <th>@lang('dashboard.title')</th>
                                                <th>@lang('dashboard.trainer_name')</th>
                                                <th>@lang('dashboard.location_name')</th>
                                                <th>@lang('dashboard.price')</th>
                                                <th>@lang('dashboard.period')</th>
                                                <th>@lang('dashboard.students_count')</th>
                                                <th>@lang('dashboard.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($courses as $course)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $course->name }}</td>
                                                    <td>{{ $course->title }}</td>
                                                    <td>{{ $course->trainer->name }}</td>
                                                    <td>{{ $course->location->name }}</td>
                                                    <td>{{ number_format($course->price, 2) }}</td>
                                                    <td>{{ $course->start_at }} <br> {{ $course->end_at }}</td>
                                                    <td>{{ $course->students_count }}</td>
                                                    <td class="py-0 align-middle">
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="{{ route('dashboard.courses.students.index', $course->id) }}"
                                                                class="btn btn-info">
                                                                <i class="fa fa-eye"></i>
                                                                @lang('dashboard.students')
                                                            </a>
                                                            @can('update-courses')
                                                                <a href="{{ route('dashboard.courses.edit', $course->id) }}"
                                                                    class="btn btn-info">
                                                                    <i class="fa fa-edit"></i>
                                                                    @lang('dashboard.edit')
                                                                </a>
                                                            @endcan
                                                            @can('delete-courses')
                                                                <a href="#" class="btn delete btn-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                    @lang('dashboard.delete')</a>
                                                                <form
                                                                    action="{{ route('dashboard.courses.destroy', $course->id) }}"
                                                                    method="post" style="display: inline-block">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="15" class="text-center">
                                                        @lang('dashboard.no_data_found')
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $courses->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
