
@extends('layout.layout')
@section('content')
  <div class="grid grid-cols-12 gap-4 p-4">
    <div class="col-span-12 md:col-span-6 md:col-start-4 lg:col-span-4 lg:col-start-5 xl:col-span-4 xl:col-start-5">
      <div class="card bg-gray-300 text-primary-content">
        <div class="card-body p-5">
          <h2 class="card-title mb-4">Upload CSV</h2>
          <form>
              @csrf
              <input type="file"
                class="filepond"
                name="filepond"
                accept="text/csv"
                id="filepond"
              />
          </form>

          <button class="btn btn-primary mt-4 hover:bg disabled:bg-primary disabled:opacity-50" id="btnUpload">
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
            <div>Upload CSV</div>
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection
