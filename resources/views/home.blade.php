
@extends('layout.layout')
@section('content')
  <div class="grid grid-cols-1 gap-4 p-4">
    <div class="card bg-base-content text-primary-content">
      <div class="card-body">
        <h2 class="card-title">Card title!</h2>
          <form action="/file-upload" id="csvDropzone"
          class="dropzone bg-white border-white"
          id="my-awesome-dropzone">@csrf</form>
      </div>
    </div>
  </div>
@endsection
