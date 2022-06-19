@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('dashboard.students')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.welcome') }}">
                                    <i class="fa fa-home"></i>
                                    @lang('dashboard.dashboard')
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.students.index') }}">
                                    @lang('dashboard.students')
                                </a>
                            </li>
                            <li class="breadcrumb-item active">@lang('dashboard.show')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.show')</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label" for="name"> @lang('dashboard.name')</label>
                                    <input type="text" disabled value="{{ $student->name }}" class="form-control"
                                        id="name">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="phone"> @lang('dashboard.phone')</label>
                                    <input disabled value="{{ $student->phone }}" class="form-control " id="phone">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="birthday"> @lang('dashboard.birthday')</label>
                                    <input type="date" disabled disabled name="birthday"
                                        value="{{ $student->birthday }}" class="form-control" id="birthday">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="age"> @lang('dashboard.age')</label>
                                    <input type="date" disabled disabled name="age"
                                        value="{{ $student->birthday->age }}" class="form-control" id="age">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="note"> @lang('dashboard.note')</label>
                                    <textarea name="note" disabled id="note" class="form-control">{{ $student->note }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card card-info card-outline">
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
                                                    <td class="py-0 align-middle">
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="{{ route('dashboard.courses.students.index', $course->id) }}"
                                                                class="btn btn-info">
                                                                <i class="fa fa-eye"></i>
                                                                @lang('dashboard.students')
                                                            </a>
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
