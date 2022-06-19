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
                                <form action="{{ route('dashboard.users.store') }}" method="post"
                                    >
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label" for="name"> @lang('dashboard.name')</label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            placeholder="@lang('dashboard.name')">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="phone"> @lang('dashboard.phone')</label>
                                        <input type="number" name="phone" value="{{ old('phone') }}"
                                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            pattern="^966[0-9]{9}" placeholder="@lang('dashboard.phone')">
                                        @error('phone')
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
