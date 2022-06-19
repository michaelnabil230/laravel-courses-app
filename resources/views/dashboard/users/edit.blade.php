@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('dashboard.users')</h1>
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
                                <a href="{{ route('dashboard.users.index') }}">
                                    @lang('dashboard.users')
                                </a>
                            </li>
                            <li class="breadcrumb-item active">@lang('dashboard.edit')</li>
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
                                <h3 class="card-title">@lang('dashboard.edit')</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('dashboard.users.update', $user->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label class="control-label" for="name"> @lang('dashboard.name')</label>
                                        <input type="text" name="name" value="{{ $user->name }}"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            placeholder="@lang('dashboard.name')">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="email"> @lang('dashboard.email')</label>
                                        <input type="text" name="email" value="{{ $user->email }}"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            placeholder="@lang('dashboard.email')">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="password"> @lang('dashboard.password')</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="@lang('dashboard.password')">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="password_confirmation">
                                            @lang('dashboard.password_confirmation')</label>
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="password_confirmation" placeholder="@lang('dashboard.password_confirmation')">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                            @lang('dashboard.edit')
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
