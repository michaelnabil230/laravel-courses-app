@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('dashboard.trainers')</h1>
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
                                <a href="{{ route('dashboard.trainers.index') }}">
                                    @lang('dashboard.trainers')
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
                                <form action="{{ route('dashboard.trainers.update', $trainer->id) }}" method="post"
                                    >
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label class="control-label" for="name"> @lang('dashboard.name')</label>
                                        <input type="text" name="name" value="{{ $trainer->name }}"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            placeholder="@lang('dashboard.name')">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="phone"> @lang('dashboard.phone')</label>
                                        <input type="number" name="phone" value="{{ $trainer->phone }}"
                                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            pattern="^(01)[0-2,5]{1}[0-9]{8}" placeholder="@lang('dashboard.phone')">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="note"> @lang('dashboard.note')</label>
                                        <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror"
                                            placeholder="@lang('dashboard.note')">{{ $trainer->note }}</textarea>
                                        @error('note')
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
