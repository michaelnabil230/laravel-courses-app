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
                                <a href="{{ route('dashboard.courses.index') }}">
                                    @lang('dashboard.courses')
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.courses.students.index', $course->id) }}">
                                    @lang('dashboard.students')
                                </a>
                            </li>
                            <li class="breadcrumb-item active">@lang('dashboard.add')</li>
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
                                <h3 class="card-title">@lang('dashboard.add')</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('dashboard.courses.students.store', $course->id) }}"
                                    method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label" for="students">
                                            @lang('dashboard.students')</label>
                                        <select name="student_id" id="students" placeholder="@lang('dashboard.students')"
                                            class="form-control @error('student_id') is-invalid @enderror">
                                            <option value="">@lang('dashboard.all_students')</option>
                                            @foreach ($students as $id => $name)
                                                <option value="{{ $id }}"
                                                    {{ old('student_id') == $id ? 'selected' : '' }}>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('student_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                            @lang('dashboard.add')
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
