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
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.courses.index') }}">
                                    @lang('dashboard.courses')
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
                                <form action="{{ route('dashboard.courses.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label" for="trainers">
                                            @lang('dashboard.trainers')</label>
                                        <select name="trainer_id" id="trainers" placeholder="@lang('dashboard.trainers')"
                                            class="form-control @error('trainer_id') is-invalid @enderror">
                                            <option value="">@lang('dashboard.all_trainers')</option>
                                            @foreach ($trainers as $name => $id)
                                                <option value="{{ $id }}"
                                                    {{ old('trainer_id') == $id ? 'selected' : '' }}>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('trainer_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="locations">
                                            @lang('dashboard.locations')</label>
                                        <select name="location_id" id="locations" placeholder="@lang('dashboard.locations')"
                                            class="form-control @error('location_id') is-invalid @enderror">
                                            <option value="">@lang('dashboard.all_locations')</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}"
                                                    {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                                    {{ $location->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('location_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
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
                                        <div class="form-group">
                                            <label class="control-label" for="{{ $locale }}_title">
                                                @lang('dashboard.' . $locale . '.title')</label>
                                            <textarea name="{{ $locale }}[title]" id="{{ $locale }}_title"
                                                class="form-control @error($locale . '.title') is-invalid @enderror" placeholder="@lang('dashboard.' . $locale . '.title')">{{ old($locale . '.title') }}</textarea>
                                            @error($locale . '.title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                    <div class="form-group">
                                        <label class="control-label" for="price"> @lang('dashboard.price')</label>
                                        <input type="number" min="1" step="0.1" name="price"
                                            value="{{ old('price', 1) }}"
                                            class="form-control @error('price') is-invalid @enderror" id="price"
                                            placeholder="@lang('dashboard.price')">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="start_at"> @lang('dashboard.start_at')</label>
                                        <input type="date" name="start_at" value="{{ old('start_at') }}"
                                            class="form-control @error('start_at') is-invalid @enderror" id="start_at"
                                            placeholder="@lang('dashboard.start_at')">
                                        @error('start_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="end_at"> @lang('dashboard.end_at')</label>
                                        <input type="date" name="end_at" value="{{ old('end_at') }}"
                                            class="form-control @error('end_at') is-invalid @enderror" id="end_at"
                                            placeholder="@lang('dashboard.end_at')">
                                        @error('end_at')
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
