
@extends('layout.layout')
@section('content')
  @vite('resources/js/data.js')
  <div class="grid grid-cols-12 gap-4 p-4">
    <div class="col-span-12 md:col-span-10 md:col-start-2 lg:col-span-8 lg:col-start-3 xl:col-span-6 xl:col-start-4">
      <div class="card bg-gray-300 text-primary-content">
        <div class="card-body p-5">
          <h2 class="card-title mb-4">Search Data</h2>
          <form>
            @csrf
            <div class="grid grid-cols-12 gap-2">
              <div class="col-span-12 md:col-span-6" id="divSelectPrefecture">
                <div class="skeleton h-12 w-full bg-gray-50 backdrop-blur-2xl border-0 rounded-lg bg-[linear-gradient(105deg,transparent_0%,transparent_40%,#f4f4f4_50%,transparent_60%,transparent_100%)] hidden"></div>
                <select class="select select-bordered w-full bg-white transition-all duration-200 ease-in-out" id="selectPrefecture">
                </select>
              </div>
              <div class="col-span-12 md:col-span-6" id="divSelectYear">
                <div class="skeleton h-12 w-full bg-gray-50 backdrop-blur-2xl border-0 rounded-lg bg-[linear-gradient(105deg,transparent_0%,transparent_40%,#f4f4f4_50%,transparent_60%,transparent_100%)] hidden"></div>
                <select class="select select-bordered w-full bg-white transition-all duration-200 ease-in-out" id="selectYear">
                </select>
              </div>
            </div>
          </form>
          <div class=" transition-all duration-300 ease-in-out" id="populationDiv">
            <div class="mt-8 transition-opacity duration-800 ease-in-out text-center opacity-0">
              <div id="populationTitle" class="text-2xl"></div>
              <div class="flex mt-4 text-xl font-bold items-center justify-center gap-2"><div id="populationValue"></div><span class="font-normal">people</span></div>
            </div>
          </div>
          <button class="btn btn-primary hover:bg disabled:bg-primary disabled:opacity-50" id="btnSearch">
            <i class="fa-solid fa-search"></i><div>Search population data</div>
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection
