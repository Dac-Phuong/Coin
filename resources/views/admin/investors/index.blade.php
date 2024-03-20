@extends('admin.layouts.master')
@section('main')
    <div class="container-xxl flex-grow-1 container-p-y p-0">
        <livewire:admin.investors.list-investor/>
        <!-- BEGIN modal -->
        <livewire:admin.investors.detail-investor/>
        <livewire:admin.investors.create-investor/>
        <livewire:admin.investors.update-investor/>
        <!--  END modal -->
    </div>
@endsection
