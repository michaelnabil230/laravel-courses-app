@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('dashboard.locations')</h1>
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
                                <a href="{{ route('dashboard.locations.index') }}">
                                    @lang('dashboard.locations')
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
                                <form action="{{ route('dashboard.locations.store') }}" method="post">
                                    @csrf
                                    @foreach (config('translatable.locales') as $locale)
                                        <div class="form-group">
                                            <label class="control-label" for="{{ $locale }}_name">
                                                @lang('dashboard.' . $locale . '.name')
                                            </label>
                                            <input type="text" name="{{ $locale }}[name]"
                                                value="{{ old($locale . '.name') }}"
                                                class="form-control @error($locale . '.name') is-invalid @enderror"
                                                id="{{ $locale }}_name" placeholder="@lang('dashboard.' . $locale . '.name')">
                                            @error($locale . '.name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
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
